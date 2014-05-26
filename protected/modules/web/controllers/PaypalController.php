<?php

/**
 * Paypall controller class Paypall payment method
 */
class PaypalController extends Controller {

    /**
     * request is here to recive her for buy of paypall like payment quantity , total
     */
    public function actionBuy() {
        Yii::app()->user->SiteSessions;
        $paymentInfo = array();
        // set total price here
        $totalPrice = (double) Yii::app()->session['total_price'] + (double) Yii::app()->session['shipping_price'];
        $paymentInfo['Order']['theTotal'] = $totalPrice;
        $paymentInfo['Order']['description'] = Yii::app()->session['description'];
        $paymentInfo['Order']['quantity'] = Yii::app()->session['quantity'];

        /**
         * fetching information from db
         */
        $criteria = new CDbCriteria();
        $criteria->addCondition("name = 'Pay Pal'");
        $model = ConfPaymentMethods::model()->find($criteria);


        Yii::app()->Paypal->apiUsername = $model->key;
        Yii::app()->Paypal->apiPassword = $model->secret;
        Yii::app()->Paypal->apiSignature = $model->signature;
        Yii::app()->Paypal->apiLive = ($model->sandbox) == "Enable" ? false : true;

        // CVarDumper::dump($paymentInfo,10,true);
        Yii::app()->Paypal->returnUrl = Yii::app()->request->hostInfo . $this->createUrl("/web/paypal/confirm");
        Yii::app()->Paypal->cancelUrl = Yii::app()->request->hostInfo . $this->createUrl("/web/paypal/cancel");


        $amount_xml = ConfPaymentMethods::model()->convertToDollar($totalPrice);


        //in case of payment error in conversion
        //error hre
        if (isset($amount_xml->errors)) {
            $error['status'] = true;
            $error['message'] = $amount_xml->reason;
            echo $error['message'];
            Yii::app()->end();
        }
        //currency will be converted to 
        if (isset($amount_xml['convert_webxcurrency']['convert_webxcurrency']['exch_amount'])) {

            $paymentInfo['Order']['theTotal'] = ceil((double) $amount_xml['convert_webxcurrency']['convert_webxcurrency']['exch_amount']);
        }



        // call paypal 
        $result = Yii::app()->Paypal->SetExpressCheckout($paymentInfo);
        //Detect Errors 
        //CVarDumper::dump($result, 10, true);

        if (!Yii::app()->Paypal->isCallSucceeded($result)) {

            if (Yii::app()->Paypal->apiLive === true) {
                //Live mode basic error message
                $error = 'We were unable to process your request. Please try again later';
            } else {
                //Sandbox output the actual error message to dive in.
                $error = $result['L_LONGMESSAGE0'];
            }
            echo $error;
            Yii::app()->end();
        } else {
            // send user to paypal 

            $token = urldecode($result["TOKEN"]);

            $payPalURL = Yii::app()->Paypal->paypalUrl . $token;
            $this->redirect($payPalURL);
        }
    }

    /**
     * here is confirming process of payypall will be redirect to success
     */
    public function actionConfirm() {
        Yii::app()->user->SiteSessions;
        $token = trim($_GET['token']);
        $payerId = trim($_GET['PayerID']);


        $result = Yii::app()->Paypal->GetExpressCheckoutDetails($token);


        $totalPrice = (double) Yii::app()->session['total_price'] + (double) Yii::app()->session['shipping_price'];

        $result['PAYERID'] = $payerId;
        $result['TOKEN'] = $token;

        $amount_xml = ConfPaymentMethods::model()->convertToDollar($totalPrice);


        //in case of payment error in conversion
        //error hre
        if (isset($amount_xml->errors)) {
            $error['status'] = true;
            $error['message'] = $amount_xml->reason;
            echo $error['message'];
            Yii::app()->end();
        }
        //currency will be converted to 
        if (isset($amount_xml['convert_webxcurrency']['convert_webxcurrency']['exch_amount'])) {

            $result['ORDERTOTAL'] = ceil((double) $amount_xml['convert_webxcurrency']['convert_webxcurrency']['exch_amount']);
        }

        //Detect errors 
        if (!Yii::app()->Paypal->isCallSucceeded($result)) {
            if (Yii::app()->Paypal->apiLive === true) {
                //Live mode basic error message
                $error = 'We were unable to process your request. Please try again later';
            } else {
                //Sandbox output the actual error message to dive in.
                $error = $result['L_LONGMESSAGE0'];
            }
            echo $error;
            Yii::app()->end();
        } else {

            $paymentResult = Yii::app()->Paypal->DoExpressCheckoutPayment($result);
            //Detect errors  
            if (!Yii::app()->Paypal->isCallSucceeded($paymentResult)) {
                if (Yii::app()->Paypal->apiLive === true) {
                    //Live mode basic error message
                    $error = 'We were unable to process your request. Please try again later';
                } else {
                    //Sandbox output the actual error message to dive in.
                    $error = $paymentResult['L_LONGMESSAGE0'];
                }
                echo $error;
                Yii::app()->end();
            } else {
                //payment was completed successfully
                $creditCardModel = new CreditCardForm;
                /**
                 * 1 ID is belong to pay pall
                 */
                $creditCardModel->payment_method = "Pay Pal";
                $order_id = $creditCardModel->saveOrder($result['TOKEN']);
                //$order_id = 117;


                /**
                 * Saving information in user biling model
                 * Now by retrieving information of most new record
                 */
                if (!empty(Yii::app()->session['billing_id'])) {
                    $model = UserOrderBilling::model()->findByPk(Yii::app()->session['billing_id']);
                } else {
                    $criteria = new CDbCriteria();
                    $criteria->select = "id";
                    $criteria->addCondition("user_id = " . Yii::app()->user->id);
                    $criteria->order = "id DESC";
                    $model = UserOrderBilling::model()->find($criteria);
                }

                $model->updateByPk($model->id, array("order_id" => $order_id));
                /**
                 * Saving information in userShipping model
                 * Now by retrieving information of most new record
                 */
                if (!empty(Yii::app()->session['shipping_id'])) {
                    $model = UserOrderShipping::model()->findByPk(Yii::app()->session['shipping_id']);
                } else {
                    $criteria = new CDbCriteria();
                    $criteria->select = "id";
                    $criteria->addCondition("user_id = " . Yii::app()->user->id);
                    $criteria->order = "id DESC";
                    $model = UserOrderShipping::model()->find($criteria);
                }

                $model->updateByPk($model->id, array("order_id" => $order_id));
                //sending email
                $this->customer0rderDetailMailer($model, $order_id);
                $this->admin0rderDetailMailer($model, $order_id);
                Yii::app()->user->setFlash('orderMail', 'Thank you...');

                $this->render('//paypall/confirm');
            }
        }
    }

    /**
     * method to send email to user
     * @param type $customerInfo
     * @param type $order_idmeth
     */
    public function customer0rderDetailMailer($customerInfo, $order_id) {

        $email['From'] = Yii::app()->params['adminEmail'];
        $email['To'] = Yii::app()->user->name;
        $email['Subject'] = "Your Order Detail";
        $email['Body'] = $this->renderPartial('//payment/_order_email_template2', array('customerInfo' => $customerInfo, 'order_id' => $order_id), true, false);
        $email['Body'] = $this->renderPartial('/common/_email_template', array('email' => $email), true, false);
        $this->sendEmail2($email);
    }

    /*
     * method to send order detail to Admin
     */

    public function admin0rderDetailMailer($customerInfo, $order_id) {

        $email['From'] = Yii::app()->params['adminEmail'];

        $email['To'] = User::model()->getCityAdmin(false, true);
        $email['Subject'] = "New Order Placement";
        $email['Body'] = $this->renderPartial('//payment/_order_email_template_admin', array('customerInfo' => $customerInfo, "order_id" => $order_id), true, false);
        $email['Body'] = $this->renderPartial('/common/_email_template', array('email' => $email), true, false);

        $this->sendEmail2($email);
    }

    /**
     * Cancel will be redirect here
     */
    public function actionCancel() {
        Yii::app()->user->SiteSessions;
        //The token of tuhe cancelled payment typically used to cancel the payment within your application
        $token = $_GET['token'];

        $this->render('//paypall/cancel');
    }

    /**
     * A test method for payment gateway of paypall
     */
    public function actionDirectPayment() {
        $paymentInfo = array('Member' =>
            array(
                'first_name' => 'zahid',
                'last_name' => 'nadeem',
                'billing_address' => '132kv grid station US ',
                'billing_address2' => 'uk street',
                'billing_country' => 'US',
                'billing_city' => 'Brooklyn',
                'billing_state' => 'NY',
                'billing_zip' => '11218'
            ),
            'CreditCard' =>
            array(
                'card_number' => '4167201658741074',
                'expiration_month' => '4',
                'expiration_year' => '2018',
                'cv_code' => '123',
                'credit_type' => 'Visa'
            ),
            'Order' =>
            array('theTotal' => 12.00)
        );

        /*
         * On Success, $result contains [AMT] [CURRENCYCODE] [AVSCODE] [CVV2MATCH]  
         * [TRANSACTIONID] [TIMESTAMP] [CORRELATIONID] [ACK] [VERSION] [BUILD] 
         *  
         * On Fail, $ result contains [AMT] [CURRENCYCODE] [TIMESTAMP] [CORRELATIONID]  
         * [ACK] [VERSION] [BUILD] [L_ERRORCODE0] [L_SHORTMESSAGE0] [L_LONGMESSAGE0]  
         * [L_SEVERITYCODE0]  
         */

        $result = Yii::app()->Paypal->DoDirectPayment($paymentInfo);

        //Detect Errors 
        if (!Yii::app()->Paypal->isCallSucceeded($result)) {
            if (Yii::app()->Paypal->apiLive === true) {
                //Live mode basic error message
                $error = 'We were unable to process your request. Please try again later';
            } else {
                //Sandbox output the actual error message to dive in.
                $error = $result['L_LONGMESSAGE0'];
            }
            echo $error;
        } else {
            //Payment was completed successfully, do the rest of your stuff
        }

        Yii::app()->end();
    }

}