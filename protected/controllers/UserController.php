<?php

class UserController extends Controller {

    public $layout = '//layouts/column2';

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            // 'accessControl', // perform access control for CRUD operations
            'rights',
            'https + index + view + update + create '
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
        $model = new User;

        $cityList = CHtml::listData(City::model()->findAll(), 'city_id', 'city_name');


        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['User'])) {

            $model->attributes = $_POST['User'];
            $pass = $model->user_password;

            $model->site_id = !empty($model->site_id) ? $model->site_id : Yii::app()->session['site_id'];


            if ($model->save()) {
                /**
                 * will send the email to create user
                 */
                $this->sendUserCreateEmail($model, $pass);
                $this->redirect(array('view', 'id' => $model->user_id));
            }
        }

        $this->render('create', array(
            'model' => $model,
            'cityList' => $cityList,
        ));
    }

    /**
     * user creation email
     */
    public function sendUserCreateEmail($model, $password) {
        $subject = "Your user is created  at " . Yii::app()->name;
        $message = "";
        if ($model->status_id == 2) {
            $message = "
                                    Your account is created  <br /><br />" .
                    $this->createAbsoluteUrl('/web/user/activate', array('key' => $model->activation_key, 'user_id' => $model->user_id, 'city_id' => $model->city_id));
        } else {
            
        }
        /**
         * 
         */
        if ($model->role_id == "2") {
            $message.= "<br/><span>You are System User of " . $model->city->city_name . "</span><br/>";
        }
        $message.= "<span>Your Username is : " . $model->user_name . "</span><br /><br /> Thanks you ";
        $message.= "<span>Your Password is : " . $password . "</span><br /><br /> Thanks you ";

        $email['From'] = Yii::app()->params['adminEmail'];
        $email['To'] = $model->user_email;
        $email['Subject'] = $subject;
        $body = "Thank you for registering your account on " . Yii::app()->name . " with following credentials , please validate your email <br/>" . $message;

        $email['Body'] = $body;
        $email['Body'] = $this->renderPartial('/common/_email_template', array('email' => $email), true, false);

        $this->sendEmail2($email);
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = UserUpdate::model()->findByPk($id);

        $cityList = CHtml::listData(City::model()->findAll(), 'city_id', 'city_name');

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['UserUpdate'])) {
            $model->attributes = $_POST['UserUpdate'];
            $model->site_id = !empty($model->site_id) ? $model->site_id : Yii::app()->session['site_id'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->user_id));
        }

        $this->render('update', array(
            'model' => $model,
            'cityList' => $cityList,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $model = $this->loadModel($id);

        Yii::app()->db->createCommand("SET FOREIGN_KEY_CHECKS=0;")->execute();

        $model->deleteByPk($id);
        Yii::app()->db->createCommand("SET FOREIGN_KEY_CHECKS=1;")->execute();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
    }

    /**
     * Manages all models.
     */
    public function actionIndex() {

        $model = new User('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['User'])) {
            $model->attributes = $_GET['User'];
        }
        $this->render('index', array(
            'model' => $model,
        ));
    }

    public function actionToggleEnabled($id) {
        $model = $this->loadModel($id);
        $this->layout = "";
        if ($model->status_id == 1) {
            $model->status_id = 2;
        } else {
            $model->status_id = 1;
        }
        echo $id;
        User::model()->updateByPk($id, array("status_id" => $model->status_id));
    }

   

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return User the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = User::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param User $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'user-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    /**
     * send new invitation email to users
     * to send email for activation of their
     * account
     */
    public function actionSendInvitation() {

        $dbusers = Yii::app()->db->createCommand()
                ->select('user_name,user_email,user_id')
                ->from("user")
                ->where("source='outside'")
                ->queryAll();

        $users = array_chunk($dbusers, 15, true);

        $this->render("send_invitation", array("users" => $users));
    }

    public function actionSendEmailinvitation() {
        if (!empty($_POST['ids'])) {


            $emails = explode("|", $_POST['ids']);

            foreach ($emails as $_id) {
                $model = User::model()->findFromPrimerkey($_id);

                if (!empty($model)) {

                    $dt = new DTFunctions();
                    $activation_code = $dt->getRanddomeNo(15);
                    $model->updateByPk($model->user_id, array("activation_key" => $activation_code));


                    $url = $this->createAbsoluteUrl('/web/user/activate', array(
                        'key' => $activation_code,
                        'user_id' => $model->user_id,
                        'city_id' => $model->city_id,
                        'lang' => $this->currentLang
                    ));


                    $email['From'] = Yii::app()->params['adminEmail'];
                    $email['To'] = $model->user_email;
                    $email['Subject'] = "Your New Activation Link on " . Yii::app()->name;
                    $body = $this->renderPartial("_sendInvitation", array('model' => $model, "url" => $url), true, false);

                    $email['Body'] = $body;

                    $email['Body'] = $this->renderPartial('/common/_email_template_pk', array('email' => $email), true, false);


                    $this->sendEmail2($email);
                }
            }
        }
    }

}
