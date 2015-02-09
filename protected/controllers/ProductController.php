<?php

class ProductController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';
    public $filters;

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            // 'accessControl', // perform access control for CRUD operations
            'rights',
            'https + index + view + update + create + createFromTemplate + slider + createSlider +sliderSetting+removeSlider+language+toggleEnabled + createFromTemplate',
        );
    }

    public function allowedActions() {
        return '@';
    }

    public function beforeAction($action) {
        Yii::app()->theme = "abound";
        parent::beforeAction($action);
        unset(Yii::app()->clientScript->scriptMap['jquery.js']);
        $operations = array('create', 'update', 'index', 'delete');
        parent::setPermissions($this->id, $operations);

        return true;
    }

    /**
     * Initialize Left site filters
     */
    public function init() {
        parent::init();

        /* Set filters and default active */
        $this->filters = array(
            'parent_cateogry_id' => Categories::model()->getParentCategories(),
            'status' => array("1" => "Enabled", "0" => "Disabled", "" => "All"),
            'is_slider' => array("1" => "Enabled", "0" => "Disabled", "" => "All"),
            'is_featured' => array("1" => "Featured", "0" => "No Featured", "" => "All"),
        );

        if (Yii::app()->user->getIsSuperuser()) {
            $criteria = new CDbCriteria;
            $criteria->condition = ' t.c_status = :status AND site.site_headoffice<>0';
            $criteria->with = array("site" => array('joinType' => 'INNER JOIN'));
            $criteria->params = array(':status' => 1);

            $cityList = CHtml::listData(City::model()->findAll($criteria), 'city_id', 'city_name');
            $this->filters['city_id'] = $cityList;
        }
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $model = $this->loadModel($id);
        $this->manageChildrens($model);

        $this->addRelatedProducts($id);

        $this->render('view', array(
            'model' => $model,
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Product;

        $criteria = new CDbCriteria;
        $criteria->condition = ' t.c_status = :status AND site.site_headoffice<>0';
        $criteria->with = array("site" => array('joinType' => 'INNER JOIN'));
        $criteria->params = array(':status' => 1);

        $cityList = CHtml::listData(City::model()->findAll($criteria), 'city_id', 'city_name');

        $languageList = CHtml::listData(Language::model()->findAll(), 'language_id', 'language_name');
        $authorList = CHtml::listData(Author::model()->findAll(array('order' => 'author_name')), 'author_id', 'author_name');


        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Product'])) {
            $model->attributes = $_POST['Product'];
            $this->checkCilds($model);

            if ($model->save()) {
                $this->redirect(array('view', 'id' => $model->product_id));
            }
        }

        $this->render('create', array(
            'model' => $model,
            'cityList' => $cityList,
            'languageList' => $languageList,
            'authorList' => $authorList
        ));
    }

    /**
     * copy from template 
     * @param type $id
     */
    public function actionCreateFromTemplate($id) {
        $model = new Product;

        $template = ProductTemplate::model()->findFromPrimerkey($id);

        $model->attributes = $template->attributes;
        $model->parent_id = $id;
        unset($model->product_id);
        $model->city_id = Yii::app()->request->getQuery("to_city");
        //getting relation name
        $profiles = array();
        $relations = array(
            "books" => array("productProfile", "ProductProfile"),
            "quran" => array("quranProfile", "Quran"),
            "others" => array("other", "Other"),
        );
        $relation_arr = $relations["others"];
        if (isset($relations[strtolower($template->parent_category->category_name)])) {
            $relation_arr = $relations[strtolower($template->parent_category->category_name)];
        }

        foreach ($template->productTemplateProfile as $relation) {
            $pModel = new $relation_arr[1];
            $pModel->attributes = $relation->attributes;
            $profiles[] = $pModel;
        }

        $model->$relation_arr[0] = $profiles;


        $criteria = new CDbCriteria;
        $criteria->condition = ' t.c_status = :status AND site.site_headoffice<>0';
        $criteria->with = array("site" => array('joinType' => 'INNER JOIN'));
        $criteria->params = array(':status' => 1);

        $cityList = CHtml::listData(City::model()->findAll($criteria), 'city_id', 'city_name');

        $languageList = CHtml::listData(Language::model()->findAll(), 'language_id', 'language_name');
        $authorList = CHtml::listData(Author::model()->findAll(array('order' => 'author_name')), 'author_id', 'author_name');


        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Product'])) {
            $model->attributes = $_POST['Product'];
            $this->checkCilds($model);

            if ($model->save()) {
                $count = 0;

                foreach ($model->$relation_arr[0] as $profile) {
                    $productAvailable = new ProductAvailableTo;
                    $productAvailable->saveImages($template->productTemplateProfile[$count], $profile);
                    $count++;
                }
                $this->sendCreatedNotifications($model);
                Yii::app()->user->setFlash('status', "Product has been added to " . $model->city->city_name . " city");
                $this->redirect(array('view', 'id' => $model->product_id));
            }
        }

        $this->render('create', array(
            'model' => $model,
            'cityList' => $cityList,
            'languageList' => $languageList,
            'authorList' => $authorList
        ));
    }

    /**
     * send product created on on particular city notification
     * @param type $model
     */
    private function sendCreatedNotifications($model) {
        $criteria = new CDbCriteria;
        $criteria->condition = "city_id =:city_id AND role_id =:role_id";
        $criteria->params = array(":city_id" => $model->city_id, "role_id" => "2");
        $user = User::model()->get($criteria);
        $email['To'] = $user->user_email;
        $email['From'] = Yii::app()->user->User->user_email;

        $email['Subject'] = str_replace("s", "", $model->parent_category->category_name);
        $email['Subject'].=" [" . $model->product_name . "] has been added to your database ";

        $email['Body'] = " [" . $model->product_name . "] has been added to your database ";
        $email['Body'].= "<br/> Please click on following link to view after login<br/>";
        $link = Yii::app()->request->hostInfo . $this->createUrl("/product/view", array(
                    "id" => $model->product_id,
                    "city_id" => $model->city_id,
                    "country" => $model->city->country->short_name,
                    "city" => $model->city->short_name
                        ), "&", true
        );
        $email['Body'].= CHtml::link($link, $link);
        $email['Body'].= "<br/>";
        $email['Body'].= "<br/>";
        $email['Body'].= "Regards <br/>";
        $email['Body'].= Yii::app()->user->User->user_name;

        $email['Body'] = $this->renderPartial('/common/_email_template', array('email' => $email), true, false);

        $this->sendEmail2($email);

        $notification = new Notifcation;
        $notification->from = Yii::app()->user->id;
        $notification->to = $user->user_email;
        $notification->subject = $email['Subject'];
        $notification->is_read = 1;
        $notification->type = "sent";

        $notification->body = $email['Body'];
        $notification->related_id = $model->parent_id;
        $notification->related_to = get_class($model);
        $notification->save();

        $notification->saveToUserInbox();


        return true;
    }

    /*     * product_id
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */

    public function actionUpdate($id, $shipingcountry = "") {

        $model = $this->loadModel($id);

        if ($shipingcountry == "countries") {


            if (isset($_POST['Product'])) {
                $model->shippable_countries = isset($_POST['Product']['shippable_countries']) ? $_POST['Product']['shippable_countries'] : "";


                $countries = !empty($model->shippable_countries) ? implode(",", $model->shippable_countries) : "";

                $model->updateByPk($model->product_id, array("shippable_countries" => $countries));

                $this->redirect(array('view', 'id' => $model->product_id));
            } else {
                $model->shippable_countries = explode(",", $model->shippable_countries);
            }
            $this->render('_update_countries', array("model" => $model));
        } else {
            //gettign city list
            $criteria = new CDbCriteria;
            $criteria->condition = ' t.c_status = :status AND site.site_headoffice<>0';
            $criteria->with = array("site" => array('joinType' => 'INNER JOIN'));
            $criteria->params = array(':status' => 1);

            $cityList = CHtml::listData(City::model()->findAll($criteria), 'city_id', 'city_name');

            $languageList = CHtml::listData(Language::model()->findAll(), 'language_id', 'language_name');

            $authorList = CHtml::listData(Author::model()->findAll(array('order' => 'author_name')), 'author_id', 'author_name');

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);

            if (isset($_POST['Product'])) {
                $model->attributes = $_POST['Product'];

                if ($model->save()) {
                    $this->redirect(array('view', 'id' => $model->product_id));
                }
            }

            $this->render('update', array(
                'model' => $model,
                'cityList' => $cityList,
                'languageList' => $languageList,
                'authorList' => $authorList
            ));
        }
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $record = $this->loadModel($id);
        $delete = 1;

         /**
         * comment if condition if you want to Delete product any case
         * Asked Bt Waseem
         */

        if (count($record->productProfile) > 0) {

            foreach ($record->productProfile as $child) {
                if (count($child->cart_products) > 0) {
                    $delete = 0;
                    break;
                }
                if (count($child->orderDetails) > 0) {
                    $delete = 0;
                    break;
                }
            }
        }
      
        if ($delete == 1) {
            Yii::app()->db->createCommand("SET FOREIGN_KEY_CHECKS=0;")->execute();
            try {
                /*
                 * Checking if there is data in relavant child tables if yes first delete all them
                 */
                if (count($record->productCategories) > 0 || count($record->productProfile) > 0) {

                    /*
                     * Checking for product category is ther any
                     * record related to current product instance if 
                     * yes then delete them
                     */
                    if (count($record->productCategories) > 0) {
                        $criteria = new CDbCriteria();
                        $criteria->select = '*';
                        $criteria->condition = "product_id=$id";
                        $child_model = ProductCategories::model()->findAll($criteria);
                        foreach ($child_model as $child) {
                            $child->deleteByPk($child->product_category_id);
                        }
                    }

                    /*
                     * Checking for productImages is ther any
                     * record related to current product instance if 
                     * yes then delete them
                     */
                    if (count($record->productProfile) > 0) {
                        $criteria = new CDbCriteria();
                        $criteria->select = '*';
                        $criteria->condition = "product_id=$id";
                        $child_model = ProductProfile::model()->findAll($criteria);

                        foreach ($child_model as $child) {
                            foreach ($child->productImages as $image) {
                                ProductImage::model()->deleteByPk($image->id);
                            }
                            $child->deleteByPk($child->id);
                        }
                    }


                    $record->deleteByPk($record->product_id);
                    Yii::app()->db->createCommand("SET FOREIGN_KEY_CHECKS=1;")->execute();
                } else {
                    
                    $record->deleteByPk($record->product_id);
                    Yii::app()->db->createCommand("SET FOREIGN_KEY_CHECKS=1;")->execute();
                }



                Yii::app()->user->setFlash('success', "Product data with its related data has deleted successfully");
                 $this->redirect(array('index'));
            } catch (CDbException $e) {

                Yii::app()->user->setFlash('errorIntegrity', "Ooops ! Relational Error with any orders");
                $this->redirect(array('index'));
            }
        }
        else {
             Yii::app()->user->setFlash('errorIntegrity', "Product cannot be deleted because involve with orders and cart");
             $this->redirect(array('index'));
        }
    }

    /**
     * Manages all models.
     */
    public function actionIndex() {
        $this->init();
        $model = new Product('search');
        $model->unsetAttributes();  // clear any default values
        var_dump($model);die;
        $model->city_id = Yii::app()->request->getQuery('city_id');

        if (isset($_GET['Product']))
            $model->attributes = $_GET['Product'];

        $this->render('index', array(
            'model' => $model,
        ));
    }

    /**
     * Manages all models.
     * for sliders
     */
    public function actionSlider() {

        $this->init();
        $model = new Product('search');
        $cityList = CHtml::listData(City::model()->findAll(), 'city_id', 'city_name');

        $model->unsetAttributes();  // clear any default values

        $model->city_id = Yii::app()->request->getQuery('city_id');


        if (isset($_GET['Product']))
            $model->attributes = $_GET['Product'];

        $this->render('slider', array(
            'model' => $model,
            'cityList' => $cityList,
        ));
    }

    /**
     * create Slider for main website
     */
    public function actionCreateSlider($id = 0, $slider = "") {

        $cityList = CHtml::listData(City::model()->findAll(), 'city_id', 'city_name');
        $model = Slider::model()->find("product_id = " . $id);
        if (empty($model)) {
            $model = new Slider();
        } else {
            $old_img = $model->image;
        }
        $model->city_id = Yii::app()->request->getQuery('city_id');

        $product = Product::model()->findByPk($id);
        $model->product_id = $product->product_id;
        $model->product_name = $product->product_name;


        if (isset($_POST['Slider'])) {

            $model->attributes = $_POST['Slider'];

            //making instance of the uploaded image 
            $img_file = DTUploadedFile::getInstance($model, 'image');
            $model->image = $img_file;

            if (empty($model->image) && !empty($model->id)) {

                // conditon for if no image submited then old img should not be deleted
                $model->image = $old_img;
            }

            if ($model->save()) {
                $upload_path = DTUploadedFile::creeatRecurSiveDirectories(array("slider", $model->id));

                if (!empty($img_file)) {

                    if ($img_file->saveAs($upload_path . $img_file->name)) {
                        echo "uploaded";
                    }
                }
                $this->redirect(array('createSlider', 'id' => $id, "slider" => $model->id));
            }
        }

        $this->renderPartial('_slider', array(
            'model' => $model,
            'cityList' => $cityList,
                ), false, true);
    }

    /**
     * Remove Slider
     * from database
     * 
     */
    public function actionRemoveSlider($id) {
        Slider::model()->deleteByPk($id);
    }

    /**
     * Slider Settings
     * Time
     */
    public function actionSliderSetting() {

        $conf = ConfMisc::model()->find("param = 'slider_time'");

        $model = new SliderSetting();
        $model->time = $conf->value;
        if (isset($_POST['SliderSetting'])) {
            $model->attributes = $_POST['SliderSetting'];
            if ($model->validate()) {
                $conf->updateByPk($conf->id, array("value" => $model->time));
            }
        }
        $this->render("_slider_settings", array("model" => $model));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Product the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Product::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Product $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'product-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    /**
     *
     * @param <type> $mName
     * @param <type> $index
     */
    public function actionLoadChildByAjax($mName, $dir, $load_for, $index, $upload_index = "") {
        /* Get regarding model */
        $model = new $mName;

        $this->renderPartial($dir . '/_fields_row', array(
            'index' => $index,
            'model' => $model,
            "load_for" => $load_for,
            'dir' => $dir,
            'upload_index' => isset($_REQUEST['upload_index']) ? $_REQUEST['upload_index'] : "",
            'fields_div_id' => $dir . '_fields'), false, true);
    }

    /**
     *
     * @param <type> $id
     * @param <type> $mName
     * @param <type> $dir 
     */
    public function actionEditChild($id, $mName, $dir,$upload_index = 0) {
        /* Get regarding model */
        $model = new $mName;
        $render_view = $dir . '/_fields_row';
        $model = $model->findByPk($id);


        $this->renderPartial($render_view, array('index' => 1, 'model' => $model,
            "load_for" => "view", 'dir' => $dir, "displayd" => "block",
            'fields_div_id' => $dir . '_fields',
            'upload_index' => $upload_index,
                ), false, true);
    }

    /**
     * delete child by ajax
     * @param type $id
     * @param type $mName
     * @throws CHttpException 
     */
    public function actionDeleteChildByAjax($id, $mName) {

        if (Yii::app()->request->isAjaxRequest) {
            /* Get regarding model */
            $model = new $mName;

            $model = $model->findByPk($id);

            $model->deleteByPk($id);
        }
        else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * view image by
     * @param type $id
     * @param type $mName
     */
    public function actionViewImage($id) {
        $model = ProductProfile::model()->findByPk($id);
        $path = $this->createUrl("viewImage", array("id" => $id));
        $this->manageChild($model, "productImages", "productProfile", "", 0, $path);
        $this->manageChild($model, "productAttributes", "productProfile", "", 0, $path);


        $this->render("productImages/_grid", array(
            "id" => $id,
            "model" => $model,
            "dir" => "productImages"));
    }

    /**
     * update status of product
     * @param type $id
     */
    public function actionToggleEnabled($id) {

        $model = $this->loadModel($id);
        $this->layout = "";
        if ($model->status == 1) {
            $model->status = 0;
        } else {
            $model->status = 1;
        }

        Product::model()->updateByPk($id, array("status" => $model->status));
    }

    /*
     * managing recrods
     * at create
     */

    private function checkCilds($model) {
        /*
          if (isset($_POST['ProductImage'])) {
          $model->setRelationRecords('productImages', is_array($_POST['ProductImage']) ? $_POST['ProductImage'] : array());
          }
         */
        if (isset($_POST['ProductCategories'])) {
            $model->setRelationRecords('productCategories', is_array($_POST['ProductCategories']) ? $_POST['ProductCategories'] : array());
        }
        if (isset($_POST['ProductProfile'])) {
            $model->setRelationRecords('productProfile', is_array($_POST['ProductProfile']) ? $_POST['ProductProfile'] : array());
        }
        if (isset($_POST['Other'])) {
            $model->setRelationRecords('other', is_array($_POST['Other']) ? $_POST['Other'] : array());
        }
        if (isset($_POST['Quran'])) {
            $model->setRelationRecords('quranProfile', is_array($_POST['Quran']) ? $_POST['Quran'] : array());
        }

        if (isset($_POST['ProductDiscount'])) {
            $model->setRelationRecords('discount', is_array($_POST['ProductDiscount']) ? $_POST['ProductDiscount'] : array());
        }

        return true;
    }

    /**
     * will be used to manage child at 
     * view mode
     * @param type $model 
     */
    private function manageChildrens($model) {

        $this->manageChild($model, "productProfile", "product");
        $this->manageChild($model, "educationToys", "product");
        $this->manageChild($model, "quranProfile", "product");
        $this->manageChild($model, "other", "product");
        $this->manageChild($model, "productCategories", "product");
        $this->manageChild($model, "discount", "product");
    }

    /**
     * adding related products 
     * to show in frontend 
     * @param type $id
     */
    public function addRelatedProducts($id) {
        if (!empty($_POST['related_product'])) {

            $is_save = false;
            foreach ($_POST['related_product'] as $relProd) {
                $count = RelatedProduct::model()->count("product_id = " . $id . " AND related_product_id = " . $relProd);
                if ($count == 0) {
                    $relateModel = new RelatedProduct();
                    $relateModel->product_id = $id;
                    $relateModel->related_product_id = $relProd;
                    $relateModel->save();
                    $is_save = true;
                }
            }

            if ($is_save == true) {
                Yii::app()->user->setFlash('status', 'Related Products has been added');
            } else {
                Yii::app()->user->setFlash('status', 'Nothing has been added in related Products');
            }
            //deleting those were not checked
            $criteria = new CDbCriteria;
            $criteria->addNotInCondition('related_product_id', $_POST['related_product']);
            $criteria->addCondition('product_id =' . $id);

            RelatedProduct::model()->deleteAll($criteria);

            $this->redirect(array('view', 'id' => $id));
        }
    }

    /**
     * languages 
     * of all translations
     */
    public function actionLanguage($id, $lang_id = "") {
        $model = new ProductLang;
        if (!empty($lang_id)) {
            $model = ProductLang::model()->findByPk($lang_id);
        }

        if (isset($_POST['ProductLang'])) {
            $model->attributes = $_POST['ProductLang'];
            $model->product_id = $id;
            if ($model->save()) {
                $this->redirect($this->createUrl("/product/language", array("id" => $id)));
            }
        }
        $this->render("language", array("id" => $id, "model" => $model));
    }

    /**
     * Delete language translation
     * @param type $id
     */
    public function actionLanguageDelete($id) {
        $model = ProductLang::model()->findByPk($id);
        $model->delete();
        $this->redirect($this->createUrl("/product/language", array("id" => $model->product_id)));
    }

    /**
     * languages 
     * of all translations
     */
    public function actionProfileLanguage($id, $lang_id = "") {
        $model = new ProductProfileLang;
        if (!empty($lang_id)) {
            $model = ProductProfileLang::model()->findByPk($lang_id);
        }

        if (isset($_POST['ProductProfileLang'])) {
            $model->attributes = $_POST['ProductProfileLang'];
            $model->product_profile_id = $id;
            if ($model->save()) {
                $this->redirect($this->createUrl("/product/profileLanguage", array("id" => $id)));
            }
        }
        $this->render("languageProfile", array("id" => $id, "model" => $model));
    }

    /**
     * Delete language translation
     * @param type $id
     */
    public function actionProfileLanguageDelete($id) {
        $model = ProductProfileLang::model()->findByPk($id);
        $model->delete();
        $this->redirect($this->createUrl("/product/profileLanguage", array("id" => $model->product_id)));
    }

    /**
     * export algorithim for 
     * books of darussalam
     * @param type $category
     */
    public function actionExportProduct($category = '') {

        $select1 = "product.product_name,product.product_description,product.product_overview ,
                product_profile.item_code,product_profile.title,product_profile.price,product_profile.quantity,
                product_profile.isbn,product_profile.no_of_pages,
                bind.title as binding,
                printing.title as printing,
                dimen.title as paper,
                paper.title as dimension,product_profile.edition";



        if (!empty($category)) {
            header("Content-type: application/vnd.ms-excel");
            header("Content-Disposition: attachment;Filename=" . str_replace(" ", "_", $category) . ".xls");

            $cat_id = Yii::app()->db->createCommand()
                    ->select('category_id')
                    ->from('categories p1')
                    ->andWhere("p1.category_name=:name", array(':name' => $category))
                    ->andWhere("p1.city_id=:city_id", array(':city_id' => Yii::app()->request->getQuery('city_id')))
                    ->queryRow();

            $results = Yii::app()->db->createCommand()
                    ->select($select1)
                    ->from('product')
                    ->join('product_profile', 'product_profile.product_id = product.product_id ')
                    ->join('conf_products bind', 'bind.id = product_profile.binding ')
                    ->join('conf_products printing', 'printing.id = product_profile.printing ')
                    ->join('conf_products paper', 'paper.id = product_profile.paper ')
                    ->join('conf_products dimen', 'dimen.id = product_profile.dimension ')
                    ->andWhere("product.parent_cateogry_id=:id", array(':id' => $cat_id['category_id']))
                    ->andWhere("product.city_id=:city_id", array(':city_id' => Yii::app()->request->getQuery('city_id')))
                    ->queryAll();
        } else {
            header("Content-type: application/vnd.ms-excel");
            header("Content-Disposition: attachment;Filename=All_Category.xls");

            $results = Yii::app()->db->createCommand()
                    ->select($select1)
                    ->from('product')
                    ->join('product_profile', 'product_profile.product_id = product.product_id ')
                    ->join('conf_products bind', 'bind.id = product_profile.binding ')
                    ->join('conf_products printing', 'printing.id = product_profile.printing ')
                    ->join('conf_products paper', 'paper.id = product_profile.paper ')
                    ->join('conf_products dimen', 'dimen.id = product_profile.dimension ')
                    ->andWhere("product.city_id=:city_id", array(':city_id' => Yii::app()->request->getQuery('city_id')))
                    ->queryAll();
        }

        $this->renderPartial('_exportproduct', array('results' => $results));
    }

}
