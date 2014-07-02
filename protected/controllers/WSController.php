<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class WSController extends Controller {

    public $layout = '';

    public function actionIndex() {

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
        }
        else if ($_REQUEST['record_set'] == 'product_catalogue') {
            // If the request is set to product category 
            //containg all books return by the Model

            $allBooks = ProductWS::model()->getWsAllBooksByCatalogue($_REQUEST['page'], $_REQUEST['limit'], $_REQUEST['category'], $_REQUEST['author'], $_REQUEST['search'], $_REQUEST['lang']);
        } else if ($_REQUEST['record_set'] == 'book_order') {
            /* This will get book order info and place order in current system */

            $response = $this->placeOrderFromPublisher($_REQUEST);
            echo $response;
            die;
        }

        $this->layout = "";

        echo CJSON::encode($allBooks, true);
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
        $criteria = new CDbCriteria();
        $criteria->condition = "user_email = :user_email";
        $criteria->params = array("user_email" => $request_list['email']);        
        
        $existing_user = User::model()->find($criteria);
        $model =  $existing_user ? $existing_user : $this->createUser($request_list);
        
        if($this->loginWithWs($model)) {
            $this->saveShippingBillingAddress($request_list,$model);
        }
        
        // when we have to save product id and product name i the order table
        /*
         * *
         * *
         */
        
        Yii::app()->user->logout();
        //CVarDumper::dump(Yii::app()->user,10,true);

        $response = array('msg' => "Your Order has placed successfully!");
        return CJSON::encode($response);
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
        if ($model->save()) {

            //Sending email part - For Successfully created user

            $subject = "Your user on darussalampk has been created ";
            $message = "<br /><br />You can login by going darussalampk.com <br /><br /> Thanks you ";

            $email['From'] = Yii::app()->params['adminEmail'];
            $email['To'] = $model->user_email;
            $email['Subject'] = "Your Account and Login Information";
            $body = "You are now registered on " . Yii::app()->name . ", please login with your email <br/>" . $message;

            $email['Body'] = $body;
            $email['Body'] = $this->renderPartial('/common/_email_template', array('email' => $email), true, false);

            $this->sendEmail2($email);
        }
        return $model;
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
    public function saveShippingBillingAddress($request_list,$user_model) {
        
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

        $shipping_info['ShippingInfoForm'] = array(
            'shipping_first_name' => $full_name['first_name'],
            'shipping_last_name' => $full_name['last_name'],
            'shipping_address1' => $request_list['address'],
            'shipping_address2' => $request_list['address'],
            'shipping_country' => $country_info['country'],
            'shipping_state' => $country_info['state'],
            'shipping_city' => $request_list['city'],
            'shipping_zip' => '',
            'shipping_phone' => $request_list['phone'],
            'shipping_mobile' => $request_list['phone'],
        );
        
        if (isset($shipping_info['ShippingInfoForm'])) {
            $model->attributes = $shipping_info['ShippingInfoForm'];
            
            $shipping_id = UserProfile::model()->saveShippingInfo($shipping_info['ShippingInfoForm']);
        }
        
        return $this->finalizeOrderPlacement();
    }

    /**
     *  This is the last step in the order placement procedure on the darussalamPK
     */
    public function finalizeOrderPlacement()
    {
        $creditCardModel = new CreditCardForm();    
        $order_id = $creditCardModel->saveOrder("");

        $shippingInfo = UserProfile::model()->updateShippingInfo($order_id);
        $billingInfo = UserProfile::model()->updateBillingInfo($order_id);

        $this->customer0rderDetailMailer($shippingInfo, $order_id);
        $this->admin0rderDetailMailer($shippingInfo, $order_id);
        
        return true;
    }
    
    /**
     * 
     * @param type $name
     * @return type array
     * 
     * This will formated name as, first_name, last_name
     */
    public function get_separated_name($name)
    {
        $arr  = explode(' ', $name);
	if(count($arr) <2)
	{
            $arr[] = 'Dear';
            $first_name = $arr[1];
            $last_name = $arr[0];
	}
	else
	{
            $first_name = $arr[0];
            $last_name = $arr[1];		
	}
        return array('first_name'=>$first_name,'last_name'=>$last_name);
    }
    
    /**
     * 
     * @param type $request_list
     * 
     * This will get country_id and state_id and return their names
     */
    public function get_country_state_name($request_list)
    {
        /* country name */
        $criteria = new CDbCriteria();
        $criteria->condition = "id = :id";
        $criteria->params = array("id"=>$request_list['country_id']);
        $model = Region::model()->find($criteria);
        $country_info['country'] = $model['attributes']['name'];
        
        /* state name */
        $criteria = new CDbCriteria();
        $criteria->condition = "id = :id";
        $criteria->params = array("id"=>$request_list['state_id']);
        $model = Subregion::model()->find($criteria);
        $country_info['state'] = $model['attributes']['name'];
        
        return $country_info;
    }
}

?>
