<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class WSController extends Controller {

    public $layout = '';

    public function actionIndex() {
        $this->layout = "";
        if (!isset($_REQUEST['record_set'])) {

            echo CJSON::encode(array("No Selection"));
            return true;
        }
        if ($_REQUEST['record_set'] == 'product') {

            $allBooks = ProductWS::model()->getWsAllBooks();
            $this->layout = "";
            echo CJSON::encode($allBooks);
        } else if ($_REQUEST['record_set'] == 'product_category') {
            // If the request is set to product category 
            //containg all books return by the Model
            $pages = 0;

            if ($_REQUEST['pages_2000'] != 0)
                $pages = 2000;
            else if ($_REQUEST['pages_1000'] != 0)
                $pages = 1000;
            else if ($_REQUEST['pages_500'] != 0)
                $pages = 500;
            else if ($_REQUEST['pages_200'] != 0)
                $pages = 200;
            else if ($_REQUEST['pages_100'] != 0)
                $pages = 100;
            else
                $pages = 0;



            $allBooks = ProductWS::model()->getWsAllBooksByCategory(
                    $_REQUEST['page'], $_REQUEST['category'], $_REQUEST['popular'], $_REQUEST['largest_price'], $_REQUEST['lowest_price'], $pages, $_REQUEST['lowrangeprice'], $_REQUEST['highrangeprice'], $_REQUEST['asc'], $_REQUEST['desc']
            );

            echo CJSON::encode($allBooks);
        }
        else if ($_REQUEST['record_set'] == 'product_catalogue') {
            // If the request is set to product category 
            //containg all books return by the Model

            $allBooks = ProductWS::model()->getWsAllBooksByCatalogue($_REQUEST['page'], $_REQUEST['limit'], $_REQUEST['category'], $_REQUEST['author'], $_REQUEST['search'], $_REQUEST['lang']);
            echo CJSON::encode($allBooks);
        } else if ($_REQUEST['record_set'] == 'book_order') {
            
           // CVarDumper::dump($_REQUEST,10,true);
            //die;
            /* This will get book order info and place order in current system */
            $response = $this->placeOrderFromPublisher($_REQUEST);
                       
            echo CJSON::encode($response);
        }
    }

    /*
     * Iphone service to Send All categories
     * in Daraussalam Database
     * 
     */

    public function actionAllCategories() {
        $criteria = new CDbCriteria();
        $criteria->select = "category_id,category_name";
        $categories = Categories_WS::model()->findAll($criteria);

        $cats = array();
        foreach ($categories as $cat) {
            $cats[] = array(
                "category_id" => $cat->category_id,
                "category_name" => $cat->category_name,
            );
        }

        try {
            $ret_array = array();
            $ret_array['error'] = '';
            $ret_array['data'] = $cats;
            $ret_array['count'] = count($cats);
            echo CJSON::encode($ret_array);
        } Catch (Exception $e) {
            echo CJSON::encode(array("error" => $e->getCode()));
        }
    }

    public function actionGetCategories() {
        $criteria = new CDbCriteria();
        $criteria->select = "category_id,category_name";
        $criteria->condition = "t.parent_id= 57";
        $categories = Categories_WS::model()->findAll($criteria);

        $cats = array();
        foreach ($categories as $cat) {
            $cats[] = array(
                "category_id" => $cat->category_id,
                "category_name" => $cat->category_name,
            );
        }

        try {
            $ret_array = array();
            $ret_array['error'] = '';
            $ret_array['data'] = $cats;
            $ret_array['count'] = count($cats);
            echo CJSON::encode($ret_array);
        } Catch (Exception $e) {
            echo CJSON::encode(array("error" => $e->getCode()));
        }
    }

    /*
     * Iphon service to Send All categories
     * in Daraussalam Database
     * 
     */

    public function actionRequestedCategory($category_id = 0) {

        $requested_cat = ProductWS::model()->getWsRequestByCategory($category_id);
        try {

            $requested_product_arr = array();
            $requested_product_arr['error'] = '';
            $requested_product_arr['data'] = $requested_cat;
            $requested_product_arr['count'] = count($requested_cat);

            echo CJSON::encode($requested_product_arr);
        } catch (Exception $e) {

            echo CJSON::encode(array("error" => $e->getCode()));
        }
    }

    /**
     *   This will do login user to the system and then place requested order 
     *   by saving book information in the billing info,shipping info and 
     *   update the user by calling processManual function
     */
    public function placeOrderFromPublisher($request_list) {
        
        //CVarDumper::dump($request_list,10,true);
        //CVarDumper::dump(ErrorController::STATE_INPUT_NAME,10,true);
      
        //if the user is already login the logout
        if (!empty(Yii::app()->user)) {
            Yii::app()->user->logout();
        }
        $criteria = new CDbCriteria();
        $criteria->condition = "user_email = :user_email";
        $criteria->params = array("user_email" => $request_list['email']);

        $existing_user = User::model()->find($criteria);
        $model = !empty($existing_user) ? $existing_user : $this->createUser($request_list);

        $this->loginWithWs($model);
        
        
        if (!empty(Yii::app()->user) && $this->saveShippingBillingAddress($request_list, $model)) {
            $response = array('msg' => "Your Order has placed successfully!");
            Yii::app()->user->logout();
        } else {
            $response = array('msg' => "Error");
        }
        return $response;
    }

    /**
     * 
     */
    public function createUser($request_list) {

        $model = new User;
        $model->site_id = 1;
        $model->role_id = '3';
        $model->status_id = Status::model()->getActive();
        $model->city_id = City::model()->getCityId("Lahore")->city_id;

        $password = sha1(mt_rand(10000, 99999) . time() . $model->user_email);

        $model->user_email = $request_list['email'];
        $model->user_name = $request_list['email'];
        $model->user_password = $password;
        $model->user_password2 = $password;
        $model->agreement_status = 1;

        if ($model->save()) {

            //Sending email part - For Successfully created user

            $subject = "Your user on darussalampk has been created ";
            $message = "<br /><br />You can login by going darussalampk.com <br /><br /> Thanks you ";
            $message.= "<br/><br/> Your password is : " . $password;

            $email['From'] = Yii::app()->params['adminEmail'];
            $email['To'] = $model->user_email;
            $email['Subject'] = "Your Account and Login Information";
            $body = "You are now registered on " . Yii::app()->name . ", please login with your email <br/>" . $message;

            $email['Body'] = $body;
            $email['Body'] = $this->renderPartial('/common/_email_template', array('email' => $email), true, false);

            $this->sendEmail2($email);
            return $model;
        }

        return "";
    }

    /**
     * 
     * @param type $model
     * @return boolean
     * This will login the user with the username and email provided to it
     */
    public function loginWithWs($model) {
        $is_authenticated = false;
        $duration = 0;
        $identity = new UserIdentity($model['user_email'], $model['user_password']);
        $is_authenticated = $identity->authenticateHashed();

        Yii::app()->user->login($identity, $duration);
        return $is_authenticated;
    }

    /**
     * 
     * @param type $request_list
     * This will save the billing and shipping information and save order 
     * against the user and notify the user the his/her order has placed
     */
    public function saveShippingBillingAddress($request_list, $user_model) {

        $full_name = $this->get_separated_name($request_list['name']);
        $country_info = $this->get_country_state_name($request_list);

        /* Saving Billing Information */
        $model = new UserOrderBilling;
        $billing_info['UserOrderBilling'] = array(
            'user_id' => $user_model->user_id,
            'order_id' => 0,
            'billing_prefix' => 'Mr.',
            'billing_first_name' => $full_name['first_name'],
            'billing_last_name' => $full_name['last_name'],
            'billing_address1' => $request_list['address'],
            'billing_address2' => $request_list['address'],
            'billing_country' => $country_info['country'],
            'billing_state' => $country_info['state'],
            'billing_city' => $request_list['city'],
            'billing_zip' => '',
            'billing_phone' => $request_list['phone'],
            'billing_mobile' => $request_list['phone'],
        );

        if (isset($billing_info['UserOrderBilling'])) {
            $model->attributes = $billing_info['UserOrderBilling'];
            $model->user_id = Yii::app()->user->id;
        }
        $model->save();


        /* Saving Shipping Information */

        $model = new ShippingInfoForm();
        //$model->setAttributeByDefault();

        $creditCardModel = new CreditCardForm;
        $phone = str_replace(' ', '+', $request_list['phone']);

        $shipping_info['ShippingInfoForm'] = array(
            'shipping_first_name' => $full_name['first_name'],
            'shipping_prefix' => 'Mr.',
            'shipping_last_name' => $full_name['last_name'],
            'shipping_address1' => $request_list['address'],
            'shipping_address2' => $request_list['address'],
            'shipping_country' => $country_info['country'],
            'shipping_state' => $country_info['state'],
            'shipping_city' => $request_list['city'],
            'shipping_zip' => '',
            'shipping_phone' => $phone,
            'shipping_mobile' => $phone,
            'payment_method' => "Cash On Delievery",
        );

        if (isset($shipping_info['ShippingInfoForm'])) {
            $model->attributes = $shipping_info['ShippingInfoForm'];

            $shipping_id = UserProfile::model()->saveShippingInfo($shipping_info['ShippingInfoForm']);
        }

        return $this->finalizeOrderPlacement($request_list);
    }

    /**
     *  This is the last step in the order placement procedure on the darussalamPK
     */
    public function finalizeOrderPlacement($request_list) {

        $pro = Product::model()->findByPk($request_list['product_id_pk']);
        $books_range = array();

        $prod_weight = (double) (isset($pro->productProfile[0]->weight) ? $pro->productProfile[0]->weight : 0);

        $books_range['price_range'] = ($request_list['quantity'] * $pro->productProfile[0]->price);
        $books_range['weight_range'] = $prod_weight;

        $books_range['categories'][$pro->parent_cateogry_id] = $pro->parent_cateogry_id;

        $creditCardModel = new CreditCardForm();
        $city = City::model()->getCityId("Lahore");
        Yii::app()->session['city_id'] = $city->city_id;


        //$request_list['city'] may be change in future when product will be purchased form 
        //multiple stores
        $is_source = 0;
        if (strtolower($request_list['city']) == "lahore" || strtolower($request_list['city']) == "lhr") {
            $is_source = 1; // haed office city of pakistan country
        }

        $shipping_price_books = ShippingClass::model()->calculateShippingCost($books_range['categories'], $books_range['price_range'], "price", $is_source);

        $order_id = $creditCardModel->saveWebServiceOrder($shipping_price_books, $pro, $request_list, $city);


        $shippingInfo = UserProfile::model()->updateShippingInfo($order_id);
        $billingInfo = UserProfile::model()->updateBillingInfo($order_id);

        Yii::import('application.modules.web.controllers.PaymentController');

        Yii::app()->theme = "dtech_second";

        $this->customer0rderDetailMailer($shippingInfo, $order_id);
        $this->admin0rderDetailMailer($shippingInfo, $order_id, $city->city_id);

        return true;
    }

    /*
     * method to send order detail to customer
     */

    public function customer0rderDetailMailer($customerInfo, $order_id) {

        $email['From'] = Yii::app()->params['adminEmail'];

        $email['To'] = Yii::app()->user->user->user_email;
        $email['Subject'] = "Your Order Detail";
        $email['Body'] = $this->renderPartial('//payment/_order_email_template2', array('customerInfo' => $customerInfo, 'order_id' => $order_id), true, false);
        $email['Body'] = $this->renderPartial('/common/_email_template', array('email' => $email), true, false);

        $this->sendEmail2($email);
    }

    /*
     * method to send order detail to Admin
     */

    public function admin0rderDetailMailer($customerInfo, $order_id, $city_id) {

        $email['From'] = Yii::app()->params['adminEmail'];

        $email['To'] = User::model()->getCityAdmin(false, true, $city_id);
     
        $email['Subject'] = "New Order Placement";
        $email['Body'] = $this->renderPartial('//payment/_order_email_template_admin', array('customerInfo' => $customerInfo, "order_id" => $order_id), true, false);
        $email['Body'] = $this->renderPartial('/common/_email_template', array('email' => $email), true, false);


        $notification = new Notifcation;
        $notification->from = Yii::app()->user->id;
        $notification->to = $email['To'];
        $notification->subject = $email['Subject'];
        $notification->is_read = 0;
        $notification->type = "inbox";

        $notification->body = $email['Body'];
        $notification->related_id = $order_id;
        $notification->related_to = "Order";
        $notification->save();


        $this->sendEmail2($email);
    }

    /**
     * 
     * @param type $name
     * @return type array
     * 
     * This will formated name as, first_name, last_name
     */
    public function get_separated_name($name) {
        $arr = explode(' ', $name);
        if (count($arr) < 2) {
            $arr[] = 'Dear';
            $first_name = $arr[1];
            $last_name = $arr[0];
        } else {
            $first_name = $arr[0];
            $last_name = $arr[1];
        }
        return array('first_name' => $first_name, 'last_name' => $last_name);
    }

    /**
     * 
     * @param type $request_list
     * 
     * This will get country_id and state_id and return their names
     */
    public function get_country_state_name($request_list) {
        /* country name */
        $model = Region::model()->findByPk($request_list['country_id']);
        $country_info['country'] = $model->attributes['name'];

        /* state name */
        $model = Subregion::model()->find($request_list['state_id']);
        $country_info['state'] = $model->attributes['name'];

        return $country_info;
    }

}

?>
