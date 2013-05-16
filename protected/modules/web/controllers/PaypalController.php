<?php

class PaypalController extends Controller
{

    public function actionBuy()
    {

        $paymentInfo = array();
        // set 
        $paymentInfo['Order']['theTotal'] = Yii::app()->session['total_price'];
        $paymentInfo['Order']['description'] = Yii::app()->session['description'];
        $paymentInfo['Order']['quantity'] = Yii::app()->session['quantity'];

       // CVarDumper::dump($paymentInfo,10,true);
        Yii::app()->Paypal->returnUrl= Yii::app()->request->hostInfo.$this->createUrl("/web/paypal/confirm");
        Yii::app()->Paypal->cancelUrl= Yii::app()->request->hostInfo.$this->createUrl("/web/paypal/cancel");
     

        // call paypal 
        $result = Yii::app()->Paypal->SetExpressCheckout($paymentInfo);
        //Detect Errors 
        //CVarDumper::dump($result, 10, true);

        if (!Yii::app()->Paypal->isCallSucceeded($result))
        {

            if (Yii::app()->Paypal->apiLive === true)
            {
                //Live mode basic error message
                $error = 'We were unable to process your request. Please try again later';
            }
            else
            {
                //Sandbox output the actual error message to dive in.
                $error = $result['L_LONGMESSAGE0'];
            }
            echo $error;
            Yii::app()->end();
        }
        else
        {
            // send user to paypal 

            $token = urldecode($result["TOKEN"]);

            $payPalURL = Yii::app()->Paypal->paypalUrl . $token;
            $this->redirect($payPalURL);
        }
    }

    public function actionConfirm()
    {

        $token = trim($_GET['token']);
        $payerId = trim($_GET['PayerID']);


        $result = Yii::app()->Paypal->GetExpressCheckoutDetails($token);


        $result['PAYERID'] = $payerId;
        $result['TOKEN'] = $token;
        $result['ORDERTOTAL'] = Yii::app()->session['total_price'];

        //Detect errors 
        if (!Yii::app()->Paypal->isCallSucceeded($result))
        {
            if (Yii::app()->Paypal->apiLive === true)
            {
                //Live mode basic error message
                $error = 'We were unable to process your request. Please try again later';
            }
            else
            {
                //Sandbox output the actual error message to dive in.
                $error = $result['L_LONGMESSAGE0'];
            }
            echo $error;
            Yii::app()->end();
        }
        else
        {

            $paymentResult = Yii::app()->Paypal->DoExpressCheckoutPayment($result);
            //Detect errors  
            if (!Yii::app()->Paypal->isCallSucceeded($paymentResult))
            {
                if (Yii::app()->Paypal->apiLive === true)
                {
                    //Live mode basic error message
                    $error = 'We were unable to process your request. Please try again later';
                }
                else
                {
                    //Sandbox output the actual error message to dive in.
                    $error = $paymentResult['L_LONGMESSAGE0'];
                }
                echo $error;
                Yii::app()->end();
            }
            else
            {
                //payment was completed successfully
                $order = new Order;
                $order->user_id = Yii::app()->user->id;
                $order->total_price = Yii::app()->session['total_price'];
                $order->order_date = date('Y-m-d');

                $ordetail = array();
                $cart_model = new Cart();
                $cart = $cart_model->findAll('user_id=' . Yii::app()->user->id);

                foreach ($cart as $pro)
                {
                    $ordetail['OrderDetail'][] = array(
                        'product_profile_id' => $pro->product_profile_id,
                        'quantity' => $pro->quantity,
                        'cart_id' =>$pro->cart_id,
                        'product_price' => round($pro->productProfile->price, 2),
                        'total_price' => round($pro->productProfile->price * $pro->quantity, 2),
                    );
                }

                $order->setRelationRecords('orderDetails', is_array($ordetail['OrderDetail']) ? $ordetail['OrderDetail'] : array());

                $order->save();

                $this->render('confirm');
            }
        }
    }

    public function actionCancel()
    {
        //The token of tuhe cancelled payment typically used to cancel the payment within your application
        $token = $_GET['token'];

        $this->render('cancel');
    }

    public function actionDirectPayment()
    {
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
        if (!Yii::app()->Paypal->isCallSucceeded($result))
        {
            if (Yii::app()->Paypal->apiLive === true)
            {
                //Live mode basic error message
                $error = 'We were unable to process your request. Please try again later';
            }
            else
            {
                //Sandbox output the actual error message to dive in.
                $error = $result['L_LONGMESSAGE0'];
            }
            echo $error;
        }
        else
        {
            //Payment was completed successfully, do the rest of your stuff
        }

        Yii::app()->end();
    }

}