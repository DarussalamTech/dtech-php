<?php

class SiteController extends Controller {

    /**
     * Declares class-based actions.
     */
    public function actions() {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
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
        Yii::app()->controller->layout = "";
        Yii::app()->user->SiteSessions;
        Yii::app()->theme = 'landing_page_theme';

        $model = new LandingModel();
        $this->countryLanding($model);
        $this->render('landing_page', array("model" => $model));
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
        Yii::app()->user->SiteSessions;
        $order_detail = new OrderDetail;
        $limit = 3;
        /** featured products * */
        $dataProvider = $order_detail->featuredBooks($limit);
        $featured_products = $order_detail->getFeaturedProducts($dataProvider);

        /**
         * best selling
         */
        $dataProvider = $order_detail->bestSellings($limit);
        $bestSellings = $order_detail->getBestSelling($dataProvider);

        $segments_footer_cats = Categories::model()->getCategoriesInSegment(5);
        $this->render('storehome', array(
            'product' => $featured_products,
            'best_sellings' => $bestSellings,
            'segments_footer_cats' => $segments_footer_cats,
        ));
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
        echo CJSON::encode(array('redirect' => $this->createUrl('/site/storehome', array('country' => Yii::app()->session['country_short_name'], 'city' => Yii::app()->session['city_short_name'], 'city_id' => Yii::app()->session['city_id']))));
    }

    /*
     * Method to handle landing page 
     * country wise application loading
     */

    public function countryLanding($model) {


        if (isset($_POST['LandingModel'])) {
            $model->attributes = $_POST['LandingModel'];

            if (!empty($model->city)) {
                $_REQUEST['city_id'] = $model->city;
                Yii::app()->user->SiteSessions;
                $this->redirect($this->createUrl('/site/storehome'));
            }
            /**
             * if city id is null then no frenchise
             */ else {
                $this->redirect($this->createUrl('/site/storehome'));
            }
            if (!empty($model->country)) {
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
        $email['To'] = 'ubaidullah@darussalampk.com';
        $email['Subject'] = "Congratz! You are now registered on " . Yii::app()->name;
        $body = "You are now registered on " . Yii::app()->name . ", please validate your email";
        // $body.=" going to this url: <br /> \n" . $model->getActivationUrl();
        $email['Body'] = $body;

        CVarDumper::dump($email, 10, true);

        // $email['Body'] = $this->renderPartial('/common/_email_template');
        $this->sendEmail2($email);
    }

    /**
     * Displays the contact page
     */
    public function actionContact() {
        Yii::app()->user->SiteSessions;
        Yii::app()->controller->layout = '//layouts/main';
        $model = new ContactForm;
        if (isset($_POST['ContactForm'])) {
            $model->attributes = $_POST['ContactForm'];
            if ($model->validate()) {
                $email['To'] = Yii::app()->params['adminEmail'];
                $email['From'] = $model->email;
                $email['Subject'] = $model->subject . 'From Mr/Mrs: ' . $model->name;
                $email['Body'] = $model->body;
                $email['Body'] = $this->renderPartial('/common/_email_template', array('email' => $email), true, false);

                $this->sendEmail2($email);
                Yii::app()->user->setFlash('contact', 'Thank you for contacting us. We will respond to you as soon as possible.');
                $this->redirect($this->createUrl('/site/contact', array('country' => Yii::app()->session['country_short_name'], 'city' => Yii::app()->session['city_short_name'], 'city_id' => Yii::app()->session['city_id'])));
            }
        }
        $this->render('contact', array('model' => $model));
    }

    /**
     * Displays the login page
     */
    public function actionLogin() {
        Yii::app()->controller->layout = '//layouts/main';
        Yii::app()->user->SiteSessions;
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
                    Yii::app()->session['isSuper'] = 1;

                    $this->redirect($this->createUrl('/user/index'));
                }
                if (Yii::app()->user->isAdmin) {
                    $this->redirect($this->createUrl('/product/index'));
                }
                if (Yii::app()->user->isCustomer) {
                    $cart = new Cart();
                    $cart->addCartByUser();
                    $wishlist = new WishList();
                    $wishlist->addWishlistByUser();
                }

                //$this->redirect(Yii::app()->user->returnUrl);
                $this->redirect(Yii::app()->user->returnUrl);
            }
        }
        // display the login form
        $this->render('login', array('model' => $model));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout() {
        unset(Yii::app()->user->isSuper);
        Yii::app()->user->logout();

        $this->redirect(Yii::app()->homeUrl);
    }

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

    public function actionIphone() {
        $books = array(
            "English" => array(
                array(
                    "id" => "1",
                    "name" => "Enjoy Your Life",
                    "description" => "Enjoy Your life",
                    "price" => "10",
                ),
                array(
                    "id" => "2",
                    "name" => "Description of Paradise",
                    "description" => "Description of Paradise",
                    "price" => "20",
                ),
            ),
            "Urdu" => array(
                array(
                    "id" => "3",
                    "name" => "آپ زندگی کا لطف",
                    "description" => "آپ زندگی کا لطف",
                    "price" => "10",
                ),
                array(
                    "id" => "4",
                    "name" => "جنت کی تفصیل",
                    "description" => "جنت کی تفصیل",
                    "price" => "20",
                ),
            ),
            "Chinese" => array(
                array(
                    "id" => "3",
                    "name" => "享受你的生活",
                    "description" => "享受你的生活",
                    "price" => "10",
                ),
                array(
                    "id" => "4",
                    "name" => "天堂的描述",
                    "description" => "天堂的描述",
                    "price" => "20",
                ),
            ),
        );
        $this->layout = "";

        echo CJSON::encode($books);
    }

}