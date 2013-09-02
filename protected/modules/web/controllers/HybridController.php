<?php

/**
 * 
 */
class HybridController extends Controller {

    /**
     * 
     * @param type $provider
     * @return boolean
     */
    public function actionLogin($provider = "facebook", $blog = "") {

        $this->initConfigurations();

        /**
         * in case of already login
         */
        if (!empty(Yii::app()->user->id)) {
            $this->redirect($this->createUrl("/site/index"));
        }


        /**
         * from social login
         */
        Yii::import('application.extensions.hybridauth.Hybrid.Hybrid_Auth');

        Yii::import('application.extensions.hybridauth.DTSocialHandler');



        $config = realPath(Yii::app()->basePath . '/extensions/hybridauth/config.php');

        /**
         * To preserve
         */
        $logINmodel = new LoginForm;

        if (isset($_POST['LoginForm'])) {
            $logINmodel->attributes = $_POST['LoginForm'];

            if (!empty($logINmodel->route)) {
                Yii::app()->user->returnUrl = $logINmodel->route;
            }
        }

        try {
            $hybridauth = new Hybrid_Auth($config);

            $adapter = $hybridauth->authenticate($provider);

            $user_profile = $adapter->getUserProfile();

            /**
             * 
             */
            $dtSocial = new DTSocialHandler();

            if (!empty($user_profile->email)) {
                $user = $dtSocial->manageUser($user_profile, $provider);
                $this->autoLogin($user);
                /**
                 * saving cart information
                 */
                $cart = new Cart();
                $cart->addCartByUser();
                $wishlist = new WishList();
                $wishlist->addWishlistByUser();

                $this->redirect(Yii::app()->user->returnUrl);
            } else {

                $user = $dtSocial->manageNonEmailUser($user_profile, $provider);

                if (!empty($user)) {
                    $this->autoLogin($user);
                    /**
                     * saving cart information
                     */
                    $cart = new Cart();
                    $cart->addCartByUser();
                    $wishlist = new WishList();
                    $wishlist->addWishlistByUser();
                    $this->redirect(Yii::app()->user->returnUrl);
                } else {
                    Yii::app()->user->setFlash('hybrid', "Please signup , your social network didn't provide the email");
                    $this->redirect($this->createUrl("/web/user/register", array("provider" => $provider)));
                }
            }



            //$this->autoLogin($user_profile);
        } catch (Exception $e) {
            die("<b>got an error!</b> " . $e->getMessage());
        }
    }

    /**
     * auto login 
     * @param type $user
     * @return boolean
     */
    public function autoLogin($user) { //accepts a user object
        $identity = new UserIdentity($user->user_email, "");
        $identity->authenticateWith();
        if ($identity->errorCode == UserIdentity::ERROR_NONE) {
            $duration = 3600 * 24 * 30; // 30 days
            Yii::app()->user->login($identity, $duration);

            return true;
        } else {
            echo $identity->errorCode;
            return false;
        }
    }

    public function actionRegisterSocial($provider) {
        Yii::app()->controller->layout = '//layouts/main';

        $model = new HybridLogin;
        if (isset($_POST['HybridLogin'])) {
            $model->attributes = $_POST['HybridLogin'];
            if ($model->validate()) {
                $this->saveAndsendEmail($model);
                //$this->redirect($this->createUrl("site/login"));
            }
        }
        $this->render("email", array("model" => $model));
    }

    public function saveAndsendEmail($emailModel) {
        //Sending email part - For activation
        $model = Yii::app()->session['social_user_info'];
        $model->user_email = $emailModel->email;


        if ($model->save()) {
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
        }
    }

    public function initConfigurations() {
        $criteria = new CDbCriteria();
        $criteria->addCondition("city_id='" . Yii::app()->session['city_id'] . "'");
        $selected = array("fb_key", "fb_secret", "google_key", "google_secret", "twitter_key", 'twitter_secret', 'linkedin_key', 'linkedin_secret');
        $criteria->addInCondition("param", $selected);
        $conf = ConfMisc::model()->findAll($criteria);
        if (!empty($conf)) {
            foreach ($conf as $data) {
                Yii::app()->params[$data->param] = $data->value;
            }
        }
    }

}

?>
