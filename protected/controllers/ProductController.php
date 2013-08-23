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
        );
    }

    public function allowedActions() {
        return '@';
    }

    public function beforeAction($action) {
        Yii::app()->theme = "admin";
        parent::beforeAction($action);

        $operations = array('create', 'update', 'index', 'delete');
        parent::setPermissions($this->id, $operations);

        return true;
    }

    /**
     * Initialize Project Report
     */
    public function init() {
        parent::init();

        /* Set filters and default active */
        $this->filters = array(
            'parent_cateogry_id' => Categories::model()->getParentCategories(),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $model = $this->loadModel($id);
        $this->manageChildrens($model);
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

        $cityList = CHtml::listData(City::model()->findAll(), 'city_id', 'city_name');
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

    /*     * product_id
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */

    public function actionUpdate($id) {

        $model = $this->loadModel($id);



        $cityList = CHtml::listData(City::model()->findAll(), 'city_id', 'city_name');
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

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Manages all models.
     */
    public function actionIndex() {
        $this->init();
        $model = new Product('search');
        $model->unsetAttributes();  // clear any default values

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
    public function actionCreateSlider($id = 0 ,$slider ="") {

        $cityList = CHtml::listData(City::model()->findAll(), 'city_id', 'city_name');
        $model = Slider::model()->find("product_id = ".$id);
        if(empty($model)){
            $model = new Slider();
        }
        else {
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
                    $img_file->saveAs($upload_path . $img_file->name);
                }
                
                $this->redirect(array('createSlider', 'id' => $id,"slider"=>$model->id));
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
    public function actionRemoveSlider($id){
        Slider::model()->deleteByPk($id);
       
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
    public function actionEditChild($id, $mName, $dir) {
        /* Get regarding model */
        $model = new $mName;
        $render_view = $dir . '/_fields_row';
        $model = $model->findByPk($id);


        $this->renderPartial($render_view, array('index' => 1, 'model' => $model,
            "load_for" => "view", 'dir' => $dir, "displayd" => "block",
            'fields_div_id' => $dir . '_fields',
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
        if (isset($_POST['EducationToys'])) {
            $model->setRelationRecords('educationToys', is_array($_POST['EducationToys']) ? $_POST['EducationToys'] : array());
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

}
