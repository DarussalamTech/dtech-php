<?php

class PaymentController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
            /*
             * applying filters for
             * secure actions
             */
            'https + paymentMethod + validateCreditCard + processCreditCard + processManual +confirmOrder + calculateShipping + placeOrder + emailTest',
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('paymentmethod', 'confirmorder',
                    'statelist', 'bstatelist', 'sstatelist', 'calculateShipping',
                    'placeOrder', 'emailTest',
                    'customer0rderDetailMailer', 'admin0rderDetailMailer'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Selection of payment method here
     */
    public function actionpaymentMethod() {
        Yii::app()->user->SiteSessions;

        /**
         * if cart is empty then it redirect to home page
         */
        $cart = Cart::model()->getCartListCount();

        if ($cart['cart_total'] == null) {
            $this->redirect($this->createUrl("/site/storeHome"));
        }

        if (isset($_GET['step']) && $_GET['step'] == 'billing') {
            $this->handleBilling();
        } else {
            $this->handleShipping();
        }
    }

    /*
     * handling shipping information
     * when user have some order
     * 
     */

    public function handleShipping() {
        $error = array('status' => false);
        $model = new ShippingInfoForm();
        $model->setAttributeByDefault();

        $creditCardModel = new CreditCardForm;

        if (isset($_POST['ShippingInfoForm'])) {
            $model->attributes = $_POST['ShippingInfoForm'];

            if ($model->validate()) {
                UserProfile::model()->saveShippingInfo($_POST['ShippingInfoForm']);
                $this->redirect($this->createUrl("/web/payment/placeOrder"));
            }
        }
        $criteria = new CDbCriteria;
        if ($country_list = Cart::model()->getCartCountryList()) {

            $criteria->addInCondition("name", $country_list);
        }
        $criteria->order = "name ASC";
        $regionList = CHtml::listData(Region::model()->findAll($criteria), 'id', 'name');
        $this->render('//payment/payment_method', array(
            'model' => $model,
            'regionList' => $regionList,
            'creditCardModel' => $creditCardModel,
            'error' => $error
        ));
    }

    /*
     * handling Billing information
     * when user have some order
     * 
     */

    public function handleBilling() {
        $critera = new CDbCriteria();
        $critera->addCondition("user_id = " . Yii::app()->user->id);
        $critera->order = "id DESC";
        $model = UserOrderBilling::model()->find($critera);

        if (empty($model)) {
            $model = new UserOrderBilling;
        }
        if (isset($_POST['UserOrderBilling'])) {
            $model->attributes = $_POST['UserOrderBilling'];
            $model->user_id = Yii::app()->user->id;
            if ($model->save()) {
                Yii::app()->session['billing_prefix'] = $model->billing_prefix;
                Yii::app()->session['billing_first_name'] = $model->billing_first_name;
                Yii::app()->session['billing_last_name'] = $model->billing_last_name;
                if ($model->isSameShipping) {

                    $this->redirect($this->createUrl("/web/payment/paymentmethod", array("billing" => $model->id)));
                } else {
                    $this->redirect($this->createUrl("/web/payment/paymentmethod"));
                }
            }
        }
        $criteriaC = new CDbCriteria;
        $criteriaC->order = "name ASC";
        $regionList = CHtml::listData(Region::model()->findAll($criteriaC), 'id', 'name');
        $this->render('//payment/payment_method_billing', array(
            'model' => $model,
            'regionList' => $regionList,
        ));
    }

    /**
     * 
     * @param type $model
     * validate credit Card
     */
    public function validateCreditCard($model, $creditCardModel) {

        if ($model->payment_method == "Credit Card") {
            if (isset($_POST['CreditCardForm'])) {
                $creditCardModel->attributes = $_POST['CreditCardForm'];

                if ($creditCardModel->validate()) {
                    return true;
                } else {
                    return false;
                }
            }
        }

        return true;
    }

    /**
     * process credit card method
     */
    public function processCreditCard($model, $creditCardModel) {

        $error = $creditCardModel->CreditCardPayment($model, $creditCardModel);
        /**
         * if order id is exist then it means 
         * it has order information
         */
        if (!empty($error['order_id'])) {
            //save the shipping information of user
            $userProfile_model = UserProfile::model();

            $shippingInfo = $userProfile_model->updateShippingInfo($error['order_id']);


            $this->customer0rderDetailMailer($shippingInfo, $error['order_id']);
            $this->admin0rderDetailMailer($shippingInfo, $error['order_id']);
            Yii::app()->user->setFlash('orderMail', 'Thank you...');

            $this->redirect(array('/web/payment/confirmOrder'));
        } else {
            $creditCardModel->showCreditCardErrors($error);
        }
    }

    /**
     * 
     * @param type $model
     * @param type $creditCardModel
     */
    public function processManual($creditCardModel) {

        $order_id = $creditCardModel->saveOrder("");

        $shippingInfo = UserProfile::model()->updateShippingInfo($order_id);

        $this->customer0rderDetailMailer($shippingInfo, $order_id);
        $this->admin0rderDetailMailer($shippingInfo, $order_id);
        
        Yii::app()->user->setFlash('orderMail', 'Thank you...');
        
        $this->redirect(array('/web/payment/confirmOrder'));
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

    public function admin0rderDetailMailer($customerInfo, $order_id) {

        $email['From'] = Yii::app()->params['adminEmail'];

        $email['To'] = User::model()->getCityAdmin();
        $email['Subject'] = "New Order Placement";
        $email['Body'] = $this->renderPartial('//payment/_order_email_template_admin', array('customerInfo' => $customerInfo, "order_id" => $order_id), true, false);
        $email['Body'] = $this->renderPartial('/common/_email_template', array('email' => $email), true, false);

        $this->sendEmail2($email);
    }

    /**
     * state list for shipping
     */
    public function actionStatelist() {

        $shipping_card = new ShippingInfoForm();
        if (isset($_POST['ShippingInfoForm'])) {
            $shipping_card->attributes = $_POST['ShippingInfoForm'];
        }
        $stateList = $shipping_card->getStates();


        echo CHtml::tag('option', array('value' => ''), 'Select State', true);
        foreach ($stateList as $value => $name) {
            echo CHtml::tag('option', array('value' => $value), CHtml::encode($name), true);
        }
    }

    /**
     * state list for billing
     */
    public function actionBstatelist() {

        $billing_card = new UserOrderBilling();
        if (isset($_POST['UserOrderBilling'])) {
            $billing_card->attributes = $_POST['UserOrderBilling'];
        }
        $stateList = $billing_card->getStates();


        echo CHtml::tag('option', array('value' => ''), 'Select State', true);
        foreach ($stateList as $value => $name) {
            echo CHtml::tag('option', array('value' => $value), CHtml::encode($name), true);
        }
    }

    /**
     * state list for shipping
     */
    public function actionSstatelist() {

        $shipp_card = new UserOrderShipping();
        if (isset($_POST['UserOrderShipping'])) {
            $shipp_card->attributes = $_POST['UserOrderShipping'];
        }
        $stateList = $shipp_card->getStates();


        echo CHtml::tag('option', array('value' => ''), 'Select State', true);
        foreach ($stateList as $value => $name) {
            echo CHtml::tag('option', array('value' => $value), CHtml::encode($name), true);
        }
    }

    /**
     * shipping cost calculation
     */
    public function actionCalculateShipping() {
        Yii::app()->user->SiteSessions;

        $cart = Cart::model()->getCartLists();

        $this->renderPartial('//payment/_shipping_calculation', array('cart' => $cart));
    }

    /**
     * palce order will be final step
     * now 
     */
    public function actionPlaceOrder() {
        Yii::app()->user->SiteSessions;
        $cart = Cart::model()->getCartLists();
        $criteria = new CDbCriteria;
        $criteria->order = "id DESC";
        $criteria->addCondition("user_id = " . Yii::app()->user->id);
        $userShipping = UserOrderShipping::model()->find($criteria);
        $creditCardModel = new CreditCardForm;

        if (isset($_POST['UserOrderShipping'])) {
            $userShipping->attributes = $_POST['UserOrderShipping'];
            $is_valid = $this->validateCreditCard($userShipping, $creditCardModel);
            if ($is_valid) {

                $creditCardModel->payment_method = $userShipping->payment_method;

                switch ($userShipping->payment_method) {
                    case "Credit Card": // credit card

                        $this->processCreditCard($userShipping, $creditCardModel);
                        break;
                    case "Cash On Delievery": // manual
                        $this->processManual($creditCardModel);
                        break;
                    case "Pay Pal": //paypal

                        $this->redirect($this->createUrl("/web/paypal/buy"));
                        break;
                }
            }
        }




        $this->render('//payment/place_order', array(
            'cart' => $cart,
            'userShipping' => $userShipping,
            'creditCardModel' => $creditCardModel,
        ));
    }

    /**
     * confirm order
     */
    public function actionconfirmOrder() {

        Yii::app()->user->SiteSessions;
        Yii::app()->theme = Yii::app()->session['layout'];
        Yii::app()->controller->layout = '//layouts/main';
        $this->render('//payment/confirm_order');
    }

    /**
     * email test
     */
    public function actionEmailTest() {
        Yii::app()->user->SiteSessions;
        $shippingInfo = UserOrderShipping::model()->findByPk(76);
        $this->customer0rderDetailMailer($shippingInfo, 102);
        $this->admin0rderDetailMailer($shippingInfo, 102);
    }

}