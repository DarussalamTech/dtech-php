<?php

class UserProfileController extends Controller {

    public $layout = '//layouts/column2';

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */

    /**
     * @return array action filters
     */
    public function filters() {
        return array('accessControl'); // perform access control for CRUD operations
    }

    public function beforeAction($action) {

        Yii::app()->theme = "abound";
        parent::beforeAction($action);

        return true;
    }

    public function accessRules() {

        return array(
            array('allow',
                'actions' => array('changePassword', 'profile'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionProfile() {

        $model = User::model()->findByPk(Yii::app()->user->id);
        $this->render('profile', array('model' => $model));
    }

    /**
     * Change Password
     */
    public function actionChangePassword() {

        $model = new ChangePassword;
        if (Yii::app()->user->id) {
            if (isset($_POST['ChangePassword'])) {
                $model->attributes = $_POST['ChangePassword'];
                if ($model->validate()) {
                    if ($model->updatePassword()) {
                        /*
                         * here we will add sending email module to inform user for password change..
                         */
                        $this->redirect($this->createUrl('/userProfile/changePassword'));
                    }
                }
            }
            $this->render('change_password', array('model' => $model));
        }
    }

}
