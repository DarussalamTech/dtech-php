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
     * DTECH8gY!0o.
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

        $total_amount = (double) Yii::app()->session['total_price'] + (double) Yii::app()->session['shipping_price'] + (double) Yii::app()->session['tax_amount'];
        $amount_xml = ConfPaymentMethods::model()->convertToDollar($total_amount);

        //in case of payment error in conversion
        if (isset($amount_xml['errors'])) {
            $error['status'] = true;
            $error['message'] = $amount_xml['reason'];
            return $error;
        }
        //currency will be converted to 
        if (isset($amount_xml['convert_webxcurrency']['convert_webxcurrency']['exch_amount'])) {
            $total_amount = $amount_xml['convert_webxcurrency']['convert_webxcurrency']['exch_amount'];
        }


        $author_rize = new AuthorizeNetException();
        $sale = new AuthorizeNetAIM;
        $fields = array(
            'amount' => $total_amount,
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
        if (isset(Yii::app()->session['currency_amount'])) {
            $order->currency_amount = Yii::app()->session['currency_amount'];
        }
        //saving dhl_history_id for international
        $order->dhl_history_id = Yii::app()->session['shipping_rate_id'];
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

    /**
     * save web service order
     * @return string
     */
    public function saveWebServiceOrder($shiping_price, $product, $request,$cityModel) {
        $error['status'] = false;
        $error['message'] = 'Payment successfully';
        $grand_total = 0;

 

        Yii::app()->session['total_price'] = round($product->productProfile[0]->price * $request['quantity'], 2);

        //payment was completed successfully
        $order = new Order;
        $order->user_id = Yii::app()->user->id;
        $order->total_price = Yii::app()->session['total_price'];
        $order->shipping_price = $shiping_price;

        $grand_total = $grand_total + ($product->productProfile[0]->price * $request['quantity']);
        $grand_total = ($grand_total + (double) $shiping_price);
        $tax_rate = ConfTaxRates::model()->getTaxRate($grand_total);

        Yii::app()->session['total_price'] = round($grand_total, 2);
        Yii::app()->session['quantity'] = $request['quantity'];
        Yii::app()->session['description'] = "";

        Yii::app()->session['shipping_price'] = round($shiping_price, 2);
        Yii::app()->session['shipping_rate_id'] = 0;
        Yii::app()->session['tax_amount'] = round($tax_rate, 2);

     
        Yii::app()->session['currency'] = $cityModel->currency->symbol;

        $criteria = new CDbCriteria;
        $criteria->order = "id DESC";
        $criteria->addCondition("user_id = " . Yii::app()->user->id);
        $userShipping = UserOrderShipping::model()->find($criteria);

        $useCurrency = "";
        if (!empty($userShipping->country->currency_code) && $userShipping->country->currency_code != Yii::app()->session['currency']) {
            $useCurrency = $userShipping->country->currency_code;
        }
        $converted_total = 0;
        if ($useCurrency != "") {
            $converted_total = ConfPaymentMethods::model()->convertCurrency(($grand_total + (double) $tax_rate), Yii::app()->session['currency'], $useCurrency);
            Yii::app()->session['currency_amount'] = round($converted_total, 2);
             $order->currency_amount = Yii::app()->session['currency_amount'];
        }
        $order->tax_amount = $tax_rate;
        if (isset(Yii::app()->session['currency_amount'])) {
           
        }
        //saving dhl_history_id for international
        $order->dhl_history_id = Yii::app()->session['shipping_rate_id'];
        $order->order_date = date('Y-m-d');
        $order->city_id = $cityModel->city_id;
        $order->transaction_id = "";


        $confM = ConfPaymentMethods::model()->getPaymentMethod($cityModel->city_id,"Cash on Delievery");
        
        $order->payment_method_id = $confM->id;


        $ordetail['OrderDetail'][] = array(
            'product_profile_id' => $product->productProfile[0]->id,
            'quantity' => $request['quantity'],
            'product_price' => round($product->productProfile[0]->price, 2),
            'total_price' => round($product->productProfile[0]->price * $request['quantity'], 2),
        );

        $order->setRelationRecords('orderDetails', is_array($ordetail['OrderDetail']) ? $ordetail['OrderDetail'] : array());

        if ($order->save()) {

            return $order->order_id;
        }

        return "";
    }

}
