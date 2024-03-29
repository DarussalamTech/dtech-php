<?php

class SiteController extends Controller {

    /**
     * Declares class-based actions.
     */
    public function actions() {
        Yii::app()->theme = "abound";
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xEDEDED,
                'foreColor' => 0x2f251c,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     * New landing page
     */
    public function actionIndex() {

        /**
         * in case when sit has its own default city
         */
        if (!empty(Yii::app()->session['site_headoffice']) && Yii::app()->session['site_headoffice'] != 0) {
            $_REQUEST['city_id'] = Yii::app()->session['site_headoffice'];
            //country switching code
            $model = new LandingModel();
            $this->countryLanding($model);

            $this->redirect($this->createUrl("/site/storeHome"));
        } else {
            $model = new LandingModel();
            $this->countryLanding($model);

            Yii::app()->controller->layout = "";
            Yii::app()->theme = 'dtech_second';
            Yii::app()->user->SiteSessions;

            $this->renderPartial("//site/landing_page", array("model" => $model));
        }
    }

    /**
     * configure app
     */
    public function actionConfigureSite() {
        $host = Yii::app()->request->hostInfo . "/" . Yii::app()->baseUrl;
        $site = SelfSite::model()->getSiteInfo($host);
        $columns = array("site_id" => $site['site_id']);

        Yii::app()->db->createCommand()->update("country", $columns);
        Yii::app()->db->createCommand()->update("user", $columns);
        Yii::app()->db->createCommand()->update("layout", $columns);
    }

    /**
     *  partucular store 
     *  here will be available
     *  from session
     *  
     */
    public function actionStoreHome() {

        /**
         * comming from home screen
         */
        if (!empty($_POST['onoffswitch']) && $_POST['onoffswitch'] == "1") {

            /**
             * save session if is comming from 
             * landing page
             */
            $session_model = new Session;

            if ($session_model->validate()) {

                if ($session_model->save()) {
                    
                }
            }

            if (empty($_POST['LandingModel']['city']) || $_POST['LandingModel']['city'] == "0") {
                $city_id = Session::model()->getCity();

                if ($city_id == "0" || $city_id == "") {
                    Yii::app()->user->setFlash("error", "Please Select country and city");
                    $this->redirect($this->createDtUrl("/site/index"));
                }
            }
        }

        Yii::app()->user->SiteSessions;



        $model = new LandingModel();
        $this->countryLanding($model);

        //to show home page only for this 
        Yii::app()->controller->layout = '//layouts/column1';
        /**
         * loading store home
         */
        $this->render('//site/storehome', array(
        ));
    }

    /**
     * filling featured box for home page
     * on home page
     * tabs are available
     * for Featured
     * Latest
     * Best Seller
     */
    public function actionFillFeaturedBox() {
        Yii::app()->user->SiteSessions;
        if (isset($_POST['value'])) {

            $limit = 6;
            switch ($_POST['value']) {
                case "Featured":
                    $order_detail = new OrderDetail;
                    $dataProvider = $order_detail->featuredBooks($limit);
                    $products = $order_detail->getFeaturedProducts($dataProvider);
                    break;
                case "Latest":

                    $dataProvider = Product::model()->allProducts(array(), $limit);
                    $products = Product::model()->returnProducts($dataProvider);
                    break;
                case "Best Seller":
                    $order_detail = new OrderDetail;
                    $dataProvider = $order_detail->bestSellings($limit);
                    $products = $order_detail->getBestSelling($dataProvider);
                    break;
            }
            $this->renderPartial(
                    "//product/featured_box", array(
                "dataProvider" => $dataProvider,
                "products" => $products,
            ));
        }
    }

    /**
     * use to change the store and on ajax call
     * and redirect ot particular path
     */
    public function actionStorechange($city_id = 0) {


        $city_id = $_REQUEST['city_id'];
        $city = City::model()->findByPk($city_id);
        $countries = Country::model()->findByPk($city['country_id']);
        $country_short_name = $countries['short_name'];
        $city_short_name = $city['short_name'];

        $layout_id = $city['layout_id'];
        $layout = Layout::model()->findByPk($layout_id);
        $layout_name = $layout['layout_name'];

        Yii::app()->session['layout'] = $layout_name;
        Yii::app()->session['country_short_name'] = $country_short_name;
        Yii::app()->session['city_short_name'] = $city_short_name;
        Yii::app()->session['city_id'] = $city['city_id'];
        Yii::app()->theme = Yii::app()->session['layout'];
        /**
         * in case of no ajax
         */
        if (isset($_REQUEST['no_ajax'])) {
            $this->redirect($this->createUrl('/site/storehome', array('country' => Yii::app()->session['country_short_name'], 'city' => Yii::app()->session['city_short_name'], 'city_id' => Yii::app()->session['city_id'])));
        }
        echo CJSON::encode(array('redirect' => $this->createUrl('/site/storehome', array('country' => Yii::app()->session['country_short_name'], 'city' => Yii::app()->session['city_short_name'], 'city_id' => Yii::app()->session['city_id']))));
    }

    /*
     * Method to handle landing page 
     * country wise application loading
     */

    public function countryLanding($model) {


        if (isset($_POST['LandingModel'])) {
            $model->attributes = $_POST['LandingModel'];
            if (empty($model->country)) {

                if ($_REQUEST['onoffswitch'] == 1) {
                    
                }


                Yii::app()->user->SiteSessions;
                $this->redirect($this->createUrl('/site/storeHome'));
            }

            if (!empty($model->city)) {
                $_REQUEST['city_id'] = $model->city;
                Yii::app()->user->SiteSessions;
                $this->redirect($this->createUrl('/site/storeHome'));
            }
            /**
             * if city id is null then no frenchise
             */ else {
                $this->redirect($this->createUrl('/error/nofrenchise'));
            }
        } else {
            // $this->redirect($this->createUrl('/error/nofrenchise'));
        }
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    /**
     * genreate email message
     * for registration 
     */
    public function actionMailer() {
        $email['From'] = Yii::app()->params['adminEmail'];
        $email['To'] = 'itsgeniusstar@gmail.com';
        if (!empty($_REQUEST['email'])) {
            $email['To'] = $_REQUEST['email'];
        }

        $email['Subject'] = "Congratz! You are now registered on " . Yii::app()->name;
        $body = "You are now registered on " . Yii::app()->name . ", please validate your email";
        // $body.=" going to this url: <br /> \n" . $model->getActivationUrl();
        $email['Body'] = $body;

        $email['Body'] = $this->renderPartial('/common/_email_template', array('email' => $email), true, false);

        CVarDumper::dump($email, 10, true);

        // $email['Body'] = $this->renderPartial('/common/_email_template');
        $this->sendEmail2($email);
    }

    /**
     * Displays the contact page
     */
    public function actionContact() {
        Yii::app()->user->SiteSessions;
        // Yii::app()->controller->layout = '//layouts/main';
        $model = new ContactForm;
        
        if (isset($_POST['ContactForm'])) {
            $model->attributes = $_POST['ContactForm'];
            if ($model->validate()) {
                if ($model->customer_copy_check == 1) {
                    /*
                     * module to send 
                     * email copy to customer itself
                     * if the button is checked
                     */
                    $email['To'] = $model->email;
                    /*$email['From'] = User::model()->getCityAdmin();
                    $email['Reply'] = User::model()->getCityAdmin();*/
                    $email['From'] = User::model()->getCityAdmin(false,false,0,true);
                    $email['Reply'] = User::model()->getCityAdmin(false,false,0,true);
                    $email['Message_type'] = $model->message_type;
                    $email['Subject'] = "[" . $email['Message_type'] . "] " . ' Contact Notification From ' . Yii::app()->name;
                    $email['Body'] = $model->body;
                    $email['Body'] = $this->renderPartial('/common/_email_template', array('email' => $email), true, false);
                    $this->sendEmail2($email);
                }
                
                //$email['To'] = User::model()->getCityAdmin(false, true);
                $email['To'] = User::model()->getMainContactEmails(); //sending email to all main emails
                $email['From'] = $model->email;
                $email['Reply'] = $model->email;
                $email['FromName'] = $model->name;
                $email['Message_type'] = $model->message_type;
                $email['Subject'] = "[" . $email['Message_type'] . "] " . $model->subject . ' From Mr/Mrs: ' . $model->name;

                $email['Body'] = '<strong> From Email address: </strong>' . $email['From'] . "<br>" . $model->body;
                $email['Body'] = $this->renderPartial('/common/_email_template', array('email' => $email), true, false);

                $this->sendEmail2($email);
                Yii::app()->user->setFlash('contact', 'Thank you for contacting us. We will respond to you as soon as possible.');
                $this->redirect($this->createUrl('/site/contact', array('country' => Yii::app()->session['country_short_name'], 'city' => Yii::app()->session['city_short_name'], 'city_id' => Yii::app()->session['city_id'])));
            }
        }

        $this->render($this->slash . '/site/contact', array('model' => $model));
    }

    /*
     * implementing the filter class
     * to handle secure login
     * https login
     */

    public function filters() {
        return array(
            'https +login+LoginAdmin', // Force https, but only on login pages
            'http + index'
        );
    }

    /**
     * Displays the login page
     */
    public function actionLogin() {
        if (!Yii::app()->user->isGuest) {
            $this->redirect($this->createUrl('/web/userProfile/index'));
        }

        Yii::app()->controller->layout = "//layouts/column2";
        Yii::app()->user->SiteSessions;

        if (empty(Yii::app()->theme)) {
            $this->redirect($this->createUrl("/site/index"));
        }

        $model = new LoginForm;
        $ip = getenv("REMOTE_ADDR");
        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login()) {

                Yii::app()->session['isSuper'] = 0;

                if (Yii::app()->user->isSuperAdmin) {
                    $_REQUEST['city_id'] = Yii::app()->user->user->city_id;

                    Yii::app()->user->SiteSessions;
                    Yii::app()->session['isSuper'] = 1;
                    $this->isAdminSite = true;

                    $this->redirect($this->createUrl('/user/index'));
                } else if (Yii::app()->user->isAdmin) {

                    $_REQUEST['city_id'] = Yii::app()->user->user->city_id;

                    Yii::app()->user->SiteSessions;
                    $this->isAdminSite = true;
                    $this->redirect($this->createUrl('/product/index'));
                } else if (Yii::app()->user->isCustomer) {
                    $cart = new Cart();
                    $cart->addCartByUser();
                    $wishlist = new WishList();
                    $wishlist->addWishlistByUser();
                }


                /**
                 * for pop up login
                 * when user want to login 
                 */
                if (!empty($model->route)) {
                    $this->redirect($model->route);
                } else {
                    $this->redirect(Yii::app()->user->returnUrl);
                }
            }
        }
        $model->password = "";
        // display the login form

        $this->render('//site/login', array('model' => $model));
    }

    /**
     * admin login for detail
     */
    public function actionLoginAdmin() {
        if (!Yii::app()->user->isGuest) {
            $this->redirect($this->createUrl('/product/index'));
        }
        //Yii::app()->controller->layout = "//layouts/login_admin";
        Yii::app()->theme = "abound";

        $model = new LoginForm;

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login()) {

                $allowed_actions = RightsModule::getAllowedActions();


                /**
                 * for pop up login
                 * when user want to login 
                 */
                if (!empty($model->route) && $model->route != Yii::app()->request->getUrl()) {
                    die('here');
                    $this->redirect($model->route);
                } else {
                    if (Yii::app()->user->isSuperAdmin) {
                        $_REQUEST['city_id'] = Yii::app()->user->user->city_id;
                        Yii::app()->user->SiteSessions;
                        Yii::app()->session['isSuper'] = 1;
                        $this->redirect($this->createUrl('/user/index'));
                    }else if (Yii::app()->user->isAdmin) {

                        $_REQUEST['city_id'] = Yii::app()->user->user->city_id;
                        Yii::app()->user->SiteSessions;
                        
                        $this->redirect($this->createUrl('/product/index'));
                    }
                    else if (!empty($allowed_actions)) {
                        $_REQUEST['city_id'] = Yii::app()->user->user->city_id;
                        Yii::app()->user->SiteSessions;
                        $url = reset($allowed_actions);

                        if (strpos($url, '*') !== false) {
                            $controller = lcfirst(substr($url, 0, -2));                           
                            $this->redirect($this->createUrl($controller . "/index"));
                        } else {
                            $controller = explode('.', $url);
                            if ($controller[1] != 'View') {
                                $this->redirect($this->createUrl('/' . lcfirst($controller[0]) . '/' . lcfirst($controller[1])));
                            }
                        }
                    }
                }
            }
        }
        // display the login form
        $this->render('//site/login', array('model' => $model));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout() {
        unset(Yii::app()->user->isSuper);
        if (Yii::app()->user->isSuperAdmin || Yii::app()->user->isAdmin) {
             Yii::app()->user->logout();
            $this->redirect($this->createUrl('/site/loginAdmin'));
        } else {
             Yii::app()->user->logout();
            $this->redirect(Yii::app()->homeUrl);
        }
    }

    /**
     * authroize dot net test
     */
    public function actionTestauth() {

        Yii::import('application.extensions.anet_php_sdk.*');

        //Yii::import('ext.anet_php_sdk.*');
        Yii::import('application.extensions.anet_php_sdk.AuthorizeNetException');
        $author = new AuthorizeNetException();


        define("AUTHORIZENET_API_LOGIN_ID", "9f84PWNhV9");
        define("AUTHORIZENET_TRANSACTION_KEY", "7A4Wfgq47Uv6zU93");
        define("AUTHORIZENET_SANDBOX", true);


        $sale = new AuthorizeNetAIM;
        $sale->amount = "5.99";
        $sale->card_num = '370000000000002';
        $sale->exp_date = '04/15';

        $sale->setFields(
                array(
                    'amount' => "5.99",
                    'card_num' => '4007000000027',
                    'exp_date' => '0415',
                    'first_name' => "Syed Ali ",
                    'last_name' => "Abbas",
                    'address' => "test",
                    'city' => "Lahore",
                    'state' => "Punjab",
                    'country' => "Pakistan",
                    'zip' => "5444",
                    'email' => "itsgeniusstar@gmail.com",
                    'card_code' => "123",
                )
        );

        $response = $sale->authorizeAndCapture();
        if ($response->approved) {
            $transaction_id = $response->transaction_id;
        }

        echo "<pre>";
        print_r($response);
        echo "</pre>";

        die;
    }

    public function actionTestHybrid() {
        Yii::import('application.extensions.hybridauth.Hybrid.Hybrid_Auth');
        Yii::import('application.extensions.hybridauth.Hybrid.Hybrid_Endpoint');
        Hybrid_Endpoint::process();
    }

    /**
     * change language
     */
    public function actionChangeLang() {
        $url = Yii::app()->request->getUrlReferrer();


        if (isset($_POST['lang_h'])) {
            /**
             * get old language
             */
            $prev_lang = !empty(Yii::app()->session['current_lang']) ? Yii::app()->session['current_lang'] : $this->currentLang;

            /**
             * setting new language
             */
            Yii::app()->session['current_lang'] = $_POST['lang_h'];
            $url = str_replace("/" . $prev_lang . "/", "/" . Yii::app()->session['current_lang'] . "/", $url);
        }

        $this->redirect($url);
    }

}
