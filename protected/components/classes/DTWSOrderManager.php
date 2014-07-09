<?php
    
    /**
     * @author naeem_choudhary
     * @package singleton Class
     * 
     * This will perform functionality of the Books_Order module that is 
     * initiated from the darussalamPublisher
     */
    class DTWSOrderManager 
    {
        /**
         * private self::$instance to ensure the object providing through this instance
         */
        private static $instance = null;
        
        /**
         * private constructor to ensure blockage of new object from outside world 
         */
        private function __construct() 
        {
        }
        
        /**
         * This will ensure that everytime live static instance of this singleton 
         * will be provided on demand
         * @return type self::$instance 
         */
        public static function getInstance()
        {
            if(self::$instance === null)
                return self::$instance = new DTWSOrderManager();
            else
                return self::$instance;
        }
        
        /**
         * This will provide the controller object that is currently in focus in the app
         * @return type parentController
         */
        public static function getController()
        {
            return Yii::app()->controller;
        }
        
        /**
         * This will first check that order is placed for which country
         * This will be called from the WSController, 
         * This will receive the request_list arguments and first check the
         * user is existing or new one, if new one then create user, send user login information to 
         * the that user and signin the new user, 
         * if user is existing that is identified based upon user email address, then 
         * it will signin that existing user and process Requested Order to particualar
         * Darussalam Store or Branch present in requested country or city
         * After order placement and email order detail to user and admin of request branch
         * of Darussalam this will logout the login user
         * 
         * @param type $request_list
         * @return $response this will be the success or failure json response
         */
        public static function placeOrderPub($request_list)
        {
            /* Here needs to check whether order is placed to particular PK and KSA email addresses or other email address */
            $emails = explode(',', $request_list['branch_emails']);

            if (strpos($request_list['branch_name'], 'Pakistan') != FALSE) {
                $order_city = 'Lahore';
            } elseif (strpos($request_list['branch_name'], 'KSA') != FALSE) {
                $order_city = 'Riyadh';
            } else {
                return self::emailOrderToOthers($request_list, $emails);
            }
            //if the user is already login the logout
            if (!empty(Yii::app()->user)) {
                Yii::app()->user->logout();
            }
            $criteria = new CDbCriteria();
            $criteria->condition = "user_email = :user_email";
            $criteria->params = array("user_email" => $request_list['email']);

            $existing_user = User::model()->find($criteria);
            $model = !empty($existing_user) ? $existing_user : self::createUser($request_list, $order_city);

            self::loginWithWs($model);


            if (!empty(Yii::app()->user) && self::saveShippingBillingAddress($request_list, $model, $order_city)) {
                $response = array('msg' => "Your Order has placed successfully!");
                Yii::app()->user->logout();
            } else {
                $response = array('msg' => "Error");
            }
            return $response;
        }
        
        /**
         * This will create and register the user as new one and email login credentials
         * to the specified email address
         * 
         * @param type $request_list
         * @param type $order_city
         * @return return User Model when user is created and registered successfully
         */
        public static function createUser($request_list, $order_city) {

           $model = new User;
           $model->site_id = 1;
           $model->role_id = '3';
           $model->status_id = Status::model()->getActive();
           $model->city_id = City::model()->getCityId($order_city)->city_id;

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
               $email['Body'] = self::getController()->renderPartial('/common/_email_template', array('email' => $email), true, false);

               self::getController()->sendEmail2($email);
               return $model;
           }

           return "";
       }

       /**
        * This will authenticate the existing or newly created user by accepting user
        * Model and on success authentication , it will sign-in the user
        * 
        * @param type $model
        * @return boolean mean user is authenticated
        * This will login the user with the username and email provided to it
        */
       public static function loginWithWs($model) {
           $is_authenticated = false;
           $duration = 0;
           $identity = new UserIdentity($model['user_email'], $model['user_password']);
           $is_authenticated = $identity->authenticateHashed();

           Yii::app()->user->login($identity, $duration);
           return $is_authenticated;
       }

       /**
        * This will save the user billing and shipping information and save order 
        * detail against that user in the orders module and notify the user and amdin 
        * of the darussalam that current order has placed successfully.
        * 
        * @param type $request_list
        * @param type $user_model
        * @param type $order_city
        * @return type
        */
       public static function saveShippingBillingAddress($request_list, $user_model, $order_city) {

           $full_name = self::get_separated_name($request_list['name']);
           $country_info = self::get_country_state_name($request_list);

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

           return self::finalizeOrderPlacement($request_list, $order_city);
       }

       /**
        * This is the last step in the order placement procedure on the darussalamPK
        * This will identify the destination or shipping city and calculate order information
        * tax, shipping cost and complete order detail and send order detail to the logged in user
        * as well as the Admin of the Darussalam so that  admin can process the Order
        * 
        * @param type $request_list
        * @param type $order_city
        * @return boolean
        */
       public static function finalizeOrderPlacement($request_list, $order_city) {

           $pro = Product::model()->findByPk($request_list['product_id_pk']);
           $books_range = array();

           $prod_weight = (double) (isset($pro->productProfile[0]->weight) ? $pro->productProfile[0]->weight : 0);

           $books_range['price_range'] = ($request_list['quantity'] * $pro->productProfile[0]->price);
           $books_range['weight_range'] = $prod_weight;

           $books_range['categories'][$pro->parent_cateogry_id] = $pro->parent_cateogry_id;

           $creditCardModel = new CreditCardForm();
           $city = City::model()->getCityId($order_city);
           Yii::app()->session['city_id'] = $city->city_id;


           //$request_list['city'] may be change in future when product will be purchased form 
           //multiple stores
           $is_source = 0;
           if (strtolower($request_list['city']) == "lahore" || strtolower($request_list['city']) == "lhr") {
               $is_source = 1; // haed office city of pakistan country
           } elseif (strtolower($request_list['city']) == "riyadh") {
               $is_source = 1; // haed office city Riyadh, of UAE country
           }

           $shipping_price_books = ShippingClass::model()->calculateShippingCost($books_range['categories'], $books_range['price_range'], "price", $is_source);

           $order_id = $creditCardModel->saveWebServiceOrder($shipping_price_books, $pro, $request_list, $city);


           $shippingInfo = UserProfile::model()->updateShippingInfo($order_id);
           $billingInfo = UserProfile::model()->updateBillingInfo($order_id);

           Yii::import('application.modules.web.controllers.PaymentController');

           Yii::app()->theme = "dtech_second";

           self::customer0rderDetailMailer($shippingInfo, $order_id);
           self::admin0rderDetailMailer($shippingInfo, $order_id, $city->city_id);

           return true;
       }

       /**
        * This method will send order detail to customer via email
        * 
        * @param type $customerInfo
        * @param type $order_id
        */
       public static function customer0rderDetailMailer($customerInfo, $order_id) {

           $email['From'] = Yii::app()->params['adminEmail'];

           $email['To'] = Yii::app()->user->user_email;
           $email['Subject'] = "Your Order Detail";
           $email['Body'] = self::getController()->renderPartial('//payment/_order_email_template2', array('customerInfo' => $customerInfo, 'order_id' => $order_id), true, false);
           $email['Body'] = self::getController()->renderPartial('/common/_email_template', array('email' => $email), true, false);

           self::getController()->sendEmail2($email);
       }

      /**
       * This method will send order detail to admin of the darussalam via email
       * @param type $customerInfo
       * @param type $order_id
       * @param type $city_id
       */
       public static function admin0rderDetailMailer($customerInfo, $order_id, $city_id) {

           $email['From'] = Yii::app()->params['adminEmail'];

           $email['To'] = User::model()->getCityAdmin(false, true, $city_id);

           $email['Subject'] = "New Order Placement";
           $email['Body'] = self::getController()->renderPartial('//payment/_order_email_template_admin', array('customerInfo' => $customerInfo, "order_id" => $order_id), true, false);
           $email['Body'] = self::getController()->renderPartial('/common/_email_template', array('email' => $email), true, false);


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


           self::getController()->sendEmail2($email);
       }

       /**
        * 
        * @param type $name
        * @return type array
        * 
        * This will formated name as, first_name, last_name
        */
       public static function get_separated_name($name) {
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
       public static function get_country_state_name($request_list) {
           /* country name */
           $model = Region::model()->findByPk($request_list['country_id']);
           $country_info['country'] = $model->name;

           /* state name */
           $model = Subregion::model()->findByPk($request_list['state_id']);
           $country_info['state'] = $model->name;

           return $country_info;
       }

       /**
        * This will send email having order description that an order is placed to their email
        * @param type $request_list
        * @param type $emails
        */
       public static function emailOrderToOthers($request_list, $emails) {
           $subject = "New Order Placement";
           $message = "<br /><br />An Order has placed to you store through darussalamPublisher<br /><br /> Thanks you ";


           $email['From'] = Yii::app()->params['adminEmail'];
           $email['To'] = $emails;
           $email['Subject'] = "New Order Detail from DaurssalamPublisher";
           $body = "An order has placed to your store through DarussalamPublisher.<br /><br /> Here is the Order Detail:";

           $body .= "Customer Name : " . $request_list['name'] . "<br />";
           $body .= "Customer Email : " . $request_list['email'] . "<br />";
           $body .= "Customer Address : " . $request_list['address'] . "<br />";
           $body .= "Customer Phone : " . $request_list['phone'] . "<br />";
           $body .= "Customer City : " . $request_list['city'] . "<br />";
           $body .= "Customer Country : " . $request_list['country'] . "<br />";
           $body .= "Product Name : " . $request_list['product_name_pk'] . "<br />";
           $body .= "Product Quantity : " . $request_list['quantity'] . "<br />";
           $body .= "Thank You";

           $email['Body'] = $body;

           self::getController()->sendEmail2($email);

           $email['Subject'] = "Your Order Detail ";

           //send email to user now
           $body = "Your order placed on  DarussalamPublisher.<br /><br /> Here is your the Order Detail:";

           $body .= "Customer Name : " . $request_list['name'] . "<br />";
           $body .= "Customer Email : " . $request_list['email'] . "<br />";
           $body .= "Customer Address : " . $request_list['address'] . "<br />";
           $body .= "Customer Phone : " . $request_list['phone'] . "<br />";
           $body .= "Customer City : " . $request_list['city'] . "<br />";
           $body .= "Customer Country : " . $request_list['country'] . "<br />";
           $body .= "Product Name : " . $request_list['product_name_pk'] . "<br />";
           $body .= "Product Quantity : " . $request_list['quantity'] . "<br />";
           $body .= "Thank You";

           $email['To'] = $request_list['email'];
           self::getController()->sendEmail2($email);
           
           return $response = array('msg' => "Your Order has placed successfully!");
       }
    }

?>
