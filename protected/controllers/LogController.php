<?php

class LogController extends Controller {

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
            'https + index + view',
        );
    }

    public function allowedActions() {
        return '@';
    }

    public function beforeAction($action) {
        Yii::app()->theme = "admin";
        parent::beforeAction($action);

        $operations = array('view', 'index',);
        parent::setPermissions($this->id, $operations);

        return true;
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $model = $this->loadModel($id);
        $this->render('view', array(
            'model' => $model,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionIndex() {
        $model = new Log('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Log']))
            $model->attributes = $_GET['Log'];

        $this->render('index', array(
            'model' => $model,
        ));
    }

    /**
     * generate htaccess rule
     */
    public function actionHtAccess() {
        $criteria = new CDbCriteria;
        $criteria->condition = "htaccess_rule <> NULL AND htaccess_rule !=''";
        $model = Log::model()->findAll($criteria);
        $txt_data = "";
        foreach($model as $data){
            $txt_data.= $data->htaccess_rule."\n";
        }
        
        CVarDumper::dump($txt_data,10,true);
    }

    /**
     * generate robote txt rule
     */
    public function actionRobote() {
        $criteria = new CDbCriteria;
        $criteria->condition = "robots_txt_rule <> NULL AND robots_txt_rule !=''";
        $model = Log::model()->findAll($criteria);
        $txt_data = "";
        foreach($model as $data){
            $txt_data.= $data->robots_txt_rule."\n";
        }
        
        CVarDumper::dump($txt_data,10,true);
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Log the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Log::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Log $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'log-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
