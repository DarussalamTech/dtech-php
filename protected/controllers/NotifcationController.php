<?php

class NotifcationController extends Controller {

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
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'copy', 'admin', 'delete', 'index', 'view'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Initialize Left site filters
     */
    public function init() {
        parent::init();

        /* Set filters and default active */
        $this->filters = array(
            'type' => array("inbox" => "Inbox", "sent" => "Sent",),
        );
    }

    /**
     * 
     * @param type $action
     * @return boolean
     */
    public function beforeAction($action) {
        Yii::app()->theme = "admin";
        parent::beforeAction($action);
        return true;
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $model = $this->loadModel($id);
        if ($model->is_read == 0) {
            $model->updateByPk($id, array("is_read" => 1));
        }
        $this->render('view', array(
            'model' => $model,
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Notifcation;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Notifcation'])) {
            $model->attributes = $_POST['Notifcation'];
            //because it is going to sent
            $model->is_read = 1;
            if ($model->save()) {
                //send to all users 

                $model->saveToUserInbox();
                Yii::app()->user->setFlash('status', "Your Notification has been sent");
                
                if (!empty($model->email_sent)) {
                    $this->sendNotification($model);
                }

                $this->redirect(array('view', 'id' => $model->id));
            }
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
    public function actionCopy($id) {
        $load_model = $this->loadModel($id);

        $model = new Notifcation;
        $model->attributes = $load_model->attributes;
        if (isset($_POST['Notifcation'])) {
            $model->attributes = $_POST['Notifcation'];
            //because it is going to sent
            $model->is_read = 1;
            if ($model->save()) {
                //send to all users 
                $model->saveToUserInbox();
                Yii::app()->user->setFlash('status', "Your Notification has been sent");
             
                if (!empty($model->email_sent)) {
                  
                    $this->sendNotification($model);
                }

                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * 
     * @param type $model
     */
    public function sendNotification($model) {

        $email['To'] = explode(",",$model->to);
        $email['From'] = User::model()->findFromPrimerkey($model->from)->user_email;
        $email['Subject'] = $model->subject;

        $email['Body'] = $model->body;
        $email['Body'] = $this->renderPartial('/common/_email_template', array('email' => $email), true, false);
       
        $this->sendEmail2($email);
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
        $model = new Notifcation('search');
        $model->unsetAttributes();  // clear any default values


        if (isset($_GET['Notifcation'])) {
            $model->attributes = $_GET['Notifcation'];
            if($model->from !=""){
                $model->from = User::model()->get("user_email = '".$model->from."'")->user_id;
            }
        }
        if ($model->type == "" || $model->type == "inbox") {
            $model->type = "inbox";
            $model->to = Yii::app()->user->user->user_email;
        } else if ($model->type == "sent") {
            $model->from = Yii::app()->user->id;
        }
        $this->render('index', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Notifcation the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Notifcation::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Notifcation $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'notifcation-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
