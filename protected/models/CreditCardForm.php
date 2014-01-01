<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class CreditCardForm extends CFormModel {

    public $first_name;
    public $payment_method;
    public $last_name;
    public $card_number1;
    public $card_number2;
    public $card_number3;
    public $card_number4;
    public $cvc;
    public $exp_month;
    public $exp_year;
    private $_identity;

    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules() {
        return array(
            // username and password are required
            array('first_name, last_name ,card_number1,card_number2,
                            card_number3,card_number4,cvc,exp_month,exp_year,
                           ', 'required'),
            array('card_number1,card_number2,card_number3,card_number4', 'numerical', 'integerOnly' => true),
            array('card_number1,card_number2,card_number3,card_number4', 'length', 'max' => 4),
            array('payment_method', 'safe'),
                // rememberMe needs to be a boolean
                //array('rememberMe', 'boolean'),
                // password needs to be authenticated
                //array('password', 'authenticate'),
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels() {
        return array(
                //'rememberMe'=>'Remember me next time',
        );
    }

    /**
     * Function for credit card payment using authorize.net api
     * @param type $model credit card model
     * @param  type $model user for shipping
     * @return type
     * 370000000000002
     * 6759649826438453
     * 4007000000027
     * 4112530021797363   000
     */
    public function CreditCardPayment($shippingModel, $model) {

        Yii::import('application.extensions.anet_php_sdk.AuthorizeNetException');

        $criteria = new CDbCriteria();
        $criteria->addCondition("name = 'Credit Card'");
        $conf_model = ConfPaymentMethods::model()->find($criteria);

        /**
         * fetching information from db
         */
        define("AUTHORIZENET_API_LOGIN_ID", $conf_model->key);
        define("AUTHORIZENET_TRANSACTION_KEY", $conf_model->secret);
        define("AUTHORIZENET_SANDBOX", ($conf_model->sandbox) == "Enable" ? true : false);

       

        $author_rize = new AuthorizeNetException();
        $sale = new AuthorizeNetAIM;
        $fields = array(
            'amount' => (double) Yii::app()->session['total_price'] + (double) Yii::app()->session['shipping_price'],
            'card_num' => $model->card_number1 . $model->card_number2 . $model->card_number3 . $model->card_number4,
            'exp_date' => $model->exp_month . $model->exp_year,
            'first_name' => $model->first_name,
            'last_name' => $model->last_name,
            'address' => $shippingModel->shipping_address1,
            'city' => $shippingModel->shipping_city,
            'state' => $shippingModel->shipping_state,
            'country' => "",
            'zip' => $shippingModel->shipping_zip,
            'email' => Yii::app()->user->name,
            'card_code' => "123",
        );
        //CVarDumper::dump($fields, 10, true);
        $sale->setFields($fields);
        
        //$fields['card_num'] = '4007000000027';
        //$fields['amount'] = 25;
        //$sale->setFields($fields);
        
        
     
        $response = $sale->authorizeAndCapture();
       
        if ($response->approved) {
            $transaction_id = $response->transaction_id;
            $order_id = $this->saveOrder($transaction_id);
            /**
             * saving order information
             */
            return array("order_id" => $order_id);

            //approved- Your order completed successfully
        } elseif ($response->declined) {
            $error['status'] = true;
            $error['message'] = $response->response_reason_text;
            //Declined
        } else {
            $error['status'] = true;
            $error['message'] = $response->response_reason_text;
            //error
        }


        return $error;
    }

    /**
     * show credit card errors
     */
    public function showCreditCardErrors($error) {

        if ($error['status']) {
            if ($error['message'] == "The credit card number is invalid.") {
                $this->addError("card_number1", $error['message']);
            } else if ($error['message'] == "The credit card has expired.") {
                $this->addError("exp_month", $error['message']);
            } else {
                $this->addError("card_number1", $error['message']);
            }
        }
    }

    /**
     * save Order
     */
    public function saveOrder($transaction_id = "") {
        $error['status'] = false;
        $error['message'] = 'Payment successfully';



        //payment was completed successfully
        $order = new Order;
        $order->user_id = Yii::app()->user->id;
        $order->total_price = Yii::app()->session['total_price'];
        $order->shipping_price = Yii::app()->session['shipping_price'];
        $order->tax_amount = Yii::app()->session['tax_amount'];
        $order->order_date = date('Y-m-d');
        $order->city_id = $_REQUEST['city_id'];
        $order->transaction_id = $transaction_id;


        $confM = ConfPaymentMethods::model()->find("name = '" . $this->payment_method . "'");
        $order->payment_method_id = $confM->id;
        $ordetail = array();
        $cart_model = new Cart();
        $cart = $cart_model->findAll('user_id=' . Yii::app()->user->id);

        foreach ($cart as $pro) {
            $ordetail['OrderDetail'][] = array(
                'product_profile_id' => $pro->product_profile_id,
                'quantity' => $pro->quantity,
                'cart_id' => $pro->cart_id,
                'product_price' => round($pro->productProfile->price, 2),
                'total_price' => round($pro->productProfile->price * $pro->quantity, 2),
            );
        }

        $order->setRelationRecords('orderDetails', is_array($ordetail['OrderDetail']) ? $ordetail['OrderDetail'] : array());

        if ($order->save()) {

            return $order->order_id;
        }

        return "";
    }

}
