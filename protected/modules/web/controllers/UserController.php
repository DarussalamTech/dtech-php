<?php

class UserController extends Controller {
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */

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
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('register', 'activate', 'ProductReview', 'forgot'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('updateprofile', 'ChangePass', 'CustomerHistory', 'OrderDetail'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionRegister() {

        $model = new User;
        Yii::app()->user->SiteSessions;

        if (isset($_POST['User'])) {

            $model->attributes = $_POST['User'];

            if ($model->site_id == NULL && $model->role_id == NULL && $model->status_id == NULL) {
                $model->site_id = Yii::app()->session['site_id'];
                $model->role_id = '3';
                $model->status_id = '0';
                $model->city_id = Yii::app()->session['city_id'];
            }

            $model->activation_key = sha1(mt_rand(10000, 99999) . time() . $model->user_email);
            $activation_url = $this->createUrl('web/user/activate', array('key' => $model->activation_key));

            if ($model->save()) {

                //Sending email part - For activation

                $subject = "Your Activation Link";
                $message = "
                                    Please click this below to activate your account <br /><br />" .
                        $this->createAbsoluteUrl('/web/user/activate', array('key' => $model->activation_key, 'user_id' => $model->user_id, 'city_id' => $model->city_id)) .
                        "<br /><br /> Thanks you 
                                ";

                $email['From'] = Yii::app()->params['adminEmail'];
                $email['To'] = $model->user_email;
                $email['Subject'] = "Your Activation Link";
                $body = "You are now registered on " . Yii::app()->name . ", please validate your email <br/>" . $message;
                // $body.=" going to this url: <br /> \n" . $model->getActivationUrl();
                $email['Body'] = $body;
                $email['Body'] = $this->renderPartial('/common/_email_template', array('email' => $email), true, false);

                $this->sendEmail2($email);
                Yii::app()->user->setFlash('registration', 'Thank you for Registration...Please activate your account by visiting your email account.');
                $this->redirect(array('site/login'));  ///take him to login page....
            }
        }

        $this->render('//user/register', array(
            'model' => $model,
        ));
    }

    public function actionActivate() {
        $user_id = $_GET['user_id'];
        $activation_key = $_GET['key'];
        $city_id = $_GET['city_id'];
        $criteria = new CDbCriteria;
        $criteria->select = '*';
        $criteria->condition = "user_id='" . $user_id . "' AND city_id='" . $city_id . "'";
        $obj = User::model()->findAll($criteria);
        if ($obj != NULL) {
            if ($obj[0]->status_id == '1') {
                //already activated
                Yii::app()->user->setFlash('login', 'Your account already activated. Please try login or if you miss your login information then go to forgot password section. Thank You');
                $this->redirect(array('site/login'));
            } else if ($obj[0]->activation_key != $activation_key) {
                Yii::app()->user->setFlash('login', 'Your activation key not registered. Please resend activation key and activate your account. Thank You');
                $this->redirect(array('site/login'));
            }
            $modelUser = new User;
            $modelUser->updateByPk($user_id, array('status_id' => '1'));

            Yii::app()->user->setFlash('login', 'Thank You ! Login Please...Your account has been activated....Now Login');
            $this->redirect(array('site/login'));
        } else {
            Yii::app()->user->setFlash('login', 'User not exist. Please signup and get activation link again.');
            $this->redirect(array('site/login'));
        }
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

    public function actionUpdateProfile($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->user_id));
        }

        $this->render('update_profile', array(
            'model' => $model,
        ));
    }

    public function actionForgot() {
        Yii::app()->user->SiteSessions;
        if (isset($_POST['User'])) {
            $record = User::model()->find(array(
                'select' => '*',
                'condition' => "user_email='" . $_POST['User']['user_email'] . "'"
                    )
            );
            if ($record === null) {
                Yii::app()->user->setFlash('incorrect_email', 'Email does not exists...Please try correct email address');
            } else {

                $pass_new = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 7)), 0, 9);
                $body = "Your New Password : " . $pass_new;
                $email['From'] = Yii::app()->params->adminEmail;
                $email['To'] = $record->user_email;
                $email['Subject'] = "Your New Password";
                $email['Body'] = $body;
                $email['Body'] = $this->renderPartial('/common/_email_template', array('email' => $email), true, false);
                $this->sendEmail2($email);

                $user_id = $record->user_id;
                $role_id = $record->role_id;
                if ($role_id != 1) {
                    $modelUser = new User;
                    $pass_new = md5($pass_new);
                    if ($modelUser->updateByPk($user_id, array('user_password' => "$pass_new"))) {
                        //User::updateAll(array('email=>'), $condition='', $params=array());

                        Yii::app()->user->setFlash('password_reset', 'Your passowrd has been sent to your Email.Please get your new password form your email account');
                    }
                } else {
                    Yii::app()->user->setFlash('superAdmin', 'Sorry we can not change your password  ');
                }
            }
        }

        $this->render('//user/forgot_password', array('model' => User::model()));
    }

    /*
     * 
     * @return method for change user password.
     */

    public function actionChangePass() {
        Yii::app()->user->SiteSessions;
        //Yii::app()->controller->layout = '//layouts/main';
        $model = new ChangePassword;
        if (Yii::app()->user->id) {
            if (isset($_POST['ChangePassword'])) {
                $model->attributes = $_POST['ChangePassword'];
                if ($model->validate()) {
                    if ($model->updatePassword()) {
                        /*
                         * here we will add sending email module to inform user for password change..
                         */
                        $this->redirect($this->createUrl('/web/user/changePass'));
                    }
                }
            }
            $this->render('//user/change_password', array('model' => $model));
        }
    }

    public function actionProductReview() {

        $modelComment = new ProductReviews;

        if (isset($_POST['ProductReviews'])) {
            $modelComment->attributes = $_POST['ProductReviews'];
            $modelComment->added_date = time();
            $modelComment->is_approved = '1';
            $modelComment->user_id = Yii::app()->user->id;

            if (!isset($_POST['ratingUser'])) {
                $modelComment->rating = 5;
            } else {
                $modelComment->rating = $_POST['ratingUser'];
            }



            if ($modelComment->save()) {
                $this->redirect($this->createUrl('/web/product/productDetail', array('country' => Yii::app()->session['country_short_name'], 'city' => Yii::app()->session['city_short_name'], 'city_id' => Yii::app()->session['city_id'], 'product_id' => $modelComment->product_id)));
            } else {
                echo CHtml::errorSummary($modelComment);
                $this->redirect($this->createUrl('/web/product/productDetail', array('country' => Yii::app()->session['country_short_name'], 'city' => Yii::app()->session['city_short_name'], 'city_id' => Yii::app()->session['city_id'], 'product_id' => $modelComment->product_id)));
            }

//        $this->render('update_profile', array(
//            'model' => $modelComment,
//        ));
        }
    }

    public function actionCustomerHistory() {
        Yii::app()->user->SiteSessions;
        $ip = Yii::app()->request->getUserHostAddress();
        $history = User::model()->customerHistory();
        $this->render('//user/customer_history', array('cart' => $history));
    }

    public function actionOrderDetail($id) {

        Yii::app()->user->SiteSessions;
        $model = new OrderDetail('Search');
        $model->unsetAttributes();  // clear any default values
        $model->order_id = $id;
        if (isset($_GET['Order'])) {
            $model->attributes = $_GET['Order'];
        }
        $this->renderPartial('//user/_order_detail', array(
            'model' => $model,
        ));
        Yii::app()->end();
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

}

