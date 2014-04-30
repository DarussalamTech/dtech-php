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
            'https + index + view + update + create + delete + 
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
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
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
    public function loadModel($id) {
        $model = ProductTemplate::model()->findFromPrimerkey($id);

        $city = City::model()->getCityId('Super');
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
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
    private function sendNotifications($model){
        $email['To'] = explode(",", $model->to);
        $email['From'] = User::model()->findFromPrimerkey($model->from)->user_email;
        $email['Subject'] = $model->subject;

        $email['Body'] = $model->body;
        $email['Body'] = $this->renderPartial('/common/_email_template', array('email' => $email), true, false);

        $this->sendEmail2($email);
    }

}
