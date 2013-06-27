<?php

class ConfigurationsController extends Controller {

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
     * Conf default page.
     */
    public function actionIndex() {
        $this->render('index');
    }

    /**
     * Load Configuration
     * 
     * @param <string> $m (Model name without Conf)
     * @param <int> $id
     */
    public function actionLoad($m, $id = 0, $module = '', $type = '') {


        /* Complete Model name */
        $model_name = 'Conf' . $m;

        $model = new $model_name;


        if ($id != 0) {
            if ($type != "") {
                $criteria = new CDbCriteria();
                if (array_key_exists('misc_type', $model->attributes)) {
                    $criteria->addCondition("misc_type = '" . $type . "'");
                } else if (array_key_exists('type', $model->attributes)) {
                    $criteria->addCondition("type = '" . $type . "'");
                }
            }

            $model = $model->findByPk($id, $criteria);
        }


        /* if form is posted */
        if (isset($_POST[$model_name])) {
            /* Assign attributes */
            $model->attributes = $_POST[$model_name];
            /* Save record */
            if ($model->save()) {
                if (isset($model->misc_type)) {
                    $this->redirect(array('load', 'm' => $m, 'module' => $module, "type" => $model->misc_type));
                } else if (isset($model->type)) {
                    $this->redirect(array('load', 'm' => $m, 'module' => $module, "type" => $model->type));
                } else {
                    $this->redirect(array('load', 'm' => $m, 'module' => $module));
                }
            };
        }


        $this->render($model->confViewName, array('model' => $model, 'm' => $m, 'module' => $module));
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {


        if (isset($_POST['ajax']) && $_POST['ajax'] === 'project-form') {
            //echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    /**
     * Set comments for appSettng action 
     */
    public function actionAppSettings() {
        /* Complete Model name */
        $model = new ConfMisc();

        $this->render("appSettings/index", array('model' => $model));
    }

    public function actionDelete($m, $id = 0, $module = '', $type = '') {
        $model_name = 'Conf' . $m;

        $model = $model_name::model()->findByPk($id);
        $model->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('load'));
    }

}
