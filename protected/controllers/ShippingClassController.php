<?php

class ShippingClassController extends Controller {

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
            'rights',
            'postOnly + delete', // we only allow deletion via POST request
            'https + index + view + update + create + delete + toggleEnabled',
        );
    }

    /**
     * 
     * @return string
     */
    public function allowedActions() {
        return '@';
    }

    public function beforeAction($action) {
        parent::beforeAction($action);
        Yii::app()->theme = "abound";
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
            'destination_city' => array(Yii::app()->session['city_id'] => "Same as source", "0" => "Out of Source", "" => "All"),
            'is_fix_shpping' => array(1 => "Yes", "No" => "No", "" => "All"),
            'is_pirce_range' => array(1 => "Yes", "0" => "No", "" => "All"),
            'is_weight_based' => array(1 => "Yes", "0" => "No", "" => "All"),
            'class_status' => array(1 => "Enable", "0" => "Disable", "" => "All"),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new ShippingClass;
        $model->is_no_selected = 1;
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['ShippingClass'])) {
            $model->attributes = $_POST['ShippingClass'];


            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['ShippingClass'])) {
            $model->attributes = $_POST['ShippingClass'];

            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
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
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
    }

    /**
     * Manages all models.
     */
    public function actionIndex() {
        $model = new ShippingClass('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['ShippingClass']))
            $model->attributes = $_GET['ShippingClass'];

        $this->render('index', array(
            'model' => $model,
        ));
    }

    /**
     * update status of product
     * @param type $id
     */
    public function actionToggleEnabled($id) {

        $model = $this->loadModel($id);
        $this->layout = "";
        if ($model->class_status == 1) {
            $model->class_status = 0;
        } else {
            $model->class_status = 1;
        }

        $model->updateByPk($id, array("class_status" => $model->class_status));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return ShippingClass the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = ShippingClass::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param ShippingClass $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'shipping-class-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
