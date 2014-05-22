<?php

class ProductTemplateController extends Controller {

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
            'https + index + view + update + create + delete + viewImage +
                    viewProduct + makeAvailable +
                    loadChildByAjax + editChild + deleteChildByAjax',
        );
    }

    /**
     * 
     * @return string
     */
    public function allowedActions() {
        return '@';
    }

    /**
     * 
     * @param type $action
     * @return boolean
     */
    public function beforeAction($action) {
        Yii::app()->theme = "admin";
        parent::beforeAction($action);

        $operations = array('view');
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
            'is_featured' => array("1" => "Featured", "0" => "No Featured", "" => "All"),
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
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     * availibility in different stores
     */
    public function actionViewProduct($id, $template = 0) {
        $model = $this->loadModel($id, $template);
        $this->manageChildrens($model);
        $this->render('viewProduct', array(
            'model' => $model,
            'template' => $template
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new ProductTemplate;
        $authorList = CHtml::listData(Author::model()->findAll(array('order' => 'author_name')), 'author_id', 'author_name');


        if (isset($_POST['ProductTemplate'])) {
            $model->attributes = $_POST['ProductTemplate'];
            $this->checkCilds($model);
            $model->city_id = City::model()->getCityId('Super')->city_id;
            if ($model->save()) {
                $this->sendNotifications($model);

                $this->redirect(array('view', 'id' => $model->product_id));
            }
        }

        $this->render('create', array(
            'model' => $model,
            'authorList' => $authorList
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        $authorList = CHtml::listData(Author::model()->findAll(array('order' => 'author_name')), 'author_id', 'author_name');

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['ProductTemplate'])) {
            $model->attributes = $_POST['ProductTemplate'];
            $model->city_id = City::model()->getCityId('Super')->city_id;
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->product_id));
        }

        $this->render('update', array(
            'model' => $model,
            'authorList' => $authorList
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $record = $this->loadModel($id);
        $delete = 1;

        if (count($record->productTemplatesChilderns) > 0) {
            $delete = 0;
            
        }

        if (count($record->productProfile) > 0 && $delete ==1) {

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



                Yii::app()->user->setFlash('success', "Product Template data with its related data has deleted successfully");
                $this->redirect(array('index'));
            } catch (CDbException $e) {

                Yii::app()->user->setFlash('errorIntegrity', "Ooops ! Relational Error with any orders");
                $this->redirect(array('index'));
            }
        } else {
            Yii::app()->user->setFlash('errorIntegrity', "Product Template cannot be deleted because involve with differnt cities or orders and cart");
            $this->redirect(array('index'));
        }
    }

    /**
     * Manages all models.
     */
    public function actionIndex() {
        $model = new ProductTemplate('search');
        $model->unsetAttributes();  // clear any default values
        $city = City::model()->getCityId('Super');

        if (isset($_GET['ProductTemplate'])) {
            $model->attributes = $_GET['ProductTemplate'];
        }
        $model->city_id = $city->city_id;
        $this->render('index', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return ProductTemplate the loaded model
     * @throws CHttpException
     */
    public function loadModel($id, $template = 0) {
        $model = ProductTemplate::model()->findFromPrimerkey($id);

        //if the template is in condition then the product will be shown here

        $city = City::model()->getCityId('Super');
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        } else if ($template == 1) {
            return $model;
        } else if ($model->city_id != $city->city_id) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param ProductTemplate $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'product-template-form') {
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
        $model = ProductTemplateProfile::model()->findByPk($id);
        $path = $this->createUrl("viewImage", array("id" => $id));
        $this->manageChild($model, "productImages", "productProfile", "", 0, $path);
        $this->manageChild($model, "productAttributes", "productProfile", "", 0, $path);


        $this->render("productImages/_grid", array(
            "id" => $id,
            "model" => $model,
            "dir" => "productImages"));
    }

    /**
     * 
     * @param type $id
     */
    public function actionMakeAvailable($id, $to_city) {

        $model = new ProductAvailableTo();
        $model->template_product_id = $id;
        $model->to_city = $to_city;
        if (isset($_POST['ProductAvailableTo'])) {
            $model->attributes = $_POST['ProductAvailableTo'];
            if ($model->validate()) {
                $pmodel = $model->makeAvailableTo();
                if ($pmodel->hasErrors()) {
                    Yii::app()->user->setFlash('error_status', $pmodel->getErrors());
                } else {
                    $this->sendCreatedNotifications($pmodel, $model->message);
                    Yii::app()->user->setFlash('status', "Product has been added to " . $pmodel->city->city_name . " city");
                }
            }
        }

        $this->renderPartial("_available_to", array("model" => $model));
    }

    /*
     * managing recrods
     * at create
     */

    private function checkCilds($model) {

        if (isset($_POST['ProductTemplateProfile'])) {
            $model->setRelationRecords('productTemplateProfile', is_array($_POST['ProductTemplateProfile']) ? $_POST['ProductTemplateProfile'] : array());
        }
        return true;
    }

    /**
     * will be used to manage child at 
     * view mode
     * @param type $model 
     */
    private function manageChildrens($model) {

        $this->manageChild($model, "productTemplateProfile", "productTemplate");
    }

    /**
     * send notifications
     * @param type $model
     */
    private function sendNotifications($model) {
        $city_admins = User::model()->getCityAdmin(true);
        $city_admins = CHtml::listData($city_admins, "user_email", "user_email");
        $email['To'] = $city_admins;
        $email['From'] = Yii::app()->user->User->user_email;
        $email['Subject'] = str_replace("s", "", $model->parent_category->category_name);
        $email['Subject'].=" [" . $model->product_name . "] has been created by super admin as template ";
        $email['Body'] = " Hi admins <br/> Super admin has created a " . str_replace("s", "", $model->parent_category->category_name);
        $email['Body'].= " <br/> ";
        $email['Body'].= " [" . $model->product_name . "] has been created by super admin as template ";
        $email['Body'].= "<br/> Please click on following link to view <br/>";
        $link = $this->createAbsoluteUrl("/productTemplate/view", array("id" => $model->product_id));
        $email['Body'].= CHtml::link($link, $link);
        $email['Body'].= "<br/>";
        $email['Body'].= "<br/>";
        $email['Body'].= "Regards <br/>";
        $email['Body'].= Yii::app()->user->User->user_name;

        $email['Body'] = $this->renderPartial('/common/_email_template', array('email' => $email), true, false);

        $this->sendEmail2($email);

        $notification = new Notifcation;
        $notification->from = Yii::app()->user->id;
        $notification->to = implode(",", $city_admins);
        $notification->subject = $email['Subject'];
        $notification->is_read = 1;
        $notification->type = "sent";

        $notification->body = $email['Body'];
        $notification->related_id = $model->product_id;
        $notification->related_to = get_class($model);
        $notification->save();

        $notification->saveToUserInbox();
        Yii::app()->user->setFlash("success", "Template has been created successfully and message has been sent to all city admins");

        return true;
    }

    /**
     * send product created on on particular city notification
     * @param type $model
     */
    private function sendCreatedNotifications($model, $body) {
        $criteria = new CDbCriteria;
        $criteria->condition = "city_id =:city_id AND role_id =:role_id";
        $criteria->params = array(":city_id" => $model->city_id, "role_id" => "2");
        $user = User::model()->get($criteria);
        $email['To'] = $user->user_email;
        $email['From'] = Yii::app()->user->User->user_email;

        $email['Subject'] = str_replace("s", "", $model->parent_category->category_name);
        $email['Subject'].=" [" . $model->product_name . "] has been added to your database ";
        $email['Body'] = $body;
        $email['Body'].= "<br/>";
        $email['Body'].= " [" . $model->product_name . "] has been added to your database ";
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

}

