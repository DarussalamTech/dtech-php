<?php

class ZoneController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'rights',
            'postOnly + delete', // we only allow deletion via POST request
            'https + index + view + update + create + delete + uploadRates',
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
        $model = new Zone;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Zone'])) {
            $model->attributes = $_POST['Zone'];
            $this->checkCilds($model);
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

        if (isset($_POST['Zone'])) {
            $model->attributes = $_POST['Zone'];
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
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Manages all models.
     */
    public function actionIndex() {
        $model = new Zone('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Zone']))
            $model->attributes = $_GET['Zone'];

        $this->render('index', array(
            'model' => $model,
        ));
    }

    /**
     * Upload Rates
     */
    public function actionUploadRates() {
        $model = new ZoneImportRates();

        $criteria = new CDbCriteria;
        $criteria->condition = ' t.c_status = :status AND site.site_headoffice<>0';
        $criteria->with = array("site" => array('joinType' => 'INNER JOIN'));
        $criteria->params = array(':status' => 1);

        $cityList = CHtml::listData(City::model()->findAll($criteria), 'city_id', 'city_name');

        if (isset($_POST['ZoneImportRates'])) {
            $model->attributes = $_POST['ZoneImportRates'];
            //making instance of the uploaded image 
            $_file = DTUploadedFile::getInstance($model, 'upload_file');
            $model->upload_file = $_file;
            if ($model->validate()) {
                $upload_path = DTUploadedFile::creeatRecurSiveDirectories(array("ZoneImportRates"));
                if (!empty($_file)) {
                    $_file->saveAs($upload_path . str_replace(" ", "_", $_file->name));

                    Yii::app()->user->setFlash('rates_success', 'Rates Has been Imported successfully');
                    $model->importRates($upload_path . str_replace(" ", "_", $_file->name));
                    $this->redirect($this->createUrl("/zone/index"));
                }
            }
        }

        $this->render("uploadRates", array("model" => $model, 'cityList' => $cityList));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Zone the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Zone::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Zone $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'zone-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    /*
     * managing recrods
     * at create
     */

    private function checkCilds($model) {

        if (isset($_POST['ZoneRates'])) {
            $model->setRelationRecords('dhl_rates', is_array($_POST['ZoneRates']) ? $_POST['ZoneRates'] : array());
        }

        return true;
    }

    /**
     * will be used to manage child at 
     * view mode
     * @param type $model 
     */
    private function manageChildrens($model) {

        $this->manageChild($model, "dhl_rates", "zone_dhl");
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
            'fields_div_id' => $dir . '_fields'), false, true);
    }

    /**
     *
     * @param <type> $id
     * @param <type> $mName
     * @param <type> $dir 
     */
    public function actionEditChild($id, $mName = "", $dir = "") {

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
     * 
     * @param type $id
     * @param type $mName
     */
    public function actionViewHistory($id, $mName) {
        $criteria = new CDbCriteria;
        $criteria->addCondition("rate_id = " . $id);
        $dataProvider = new CActiveDataProvider("ZoneRatesHistory", array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => array(
                    'create_time' => 'DESC',
                ),
            ),
            'pagination' => array(
                'pageSize' => 40,
            ),
        ));
        $this->render("history", array("dataProvider" => $dataProvider));
    }

}
