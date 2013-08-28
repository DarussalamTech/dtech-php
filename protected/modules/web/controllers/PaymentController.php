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
                'actions' => array('paymentmethod', 'confirmorder', 'statelist', 'customer0rderDetailMailer', 'admin0rderDetailMailer'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionpaymentMethod() {
        Yii::app()->user->SiteSessions;
        if ($_GET['step'] == 'billing') {
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

            $is_valid = $this->validateCreditCard($model, $creditCardModel);


            if ($model->validate() && $is_valid) {

                $creditCardModel->payment_method = $model->payment_method;

                switch ($model->payment_method) {
                    case "Credit Card": // credit card

                        $this->processCreditCard($model, $creditCardModel);
                        break;
                    case "Cash On Delievery": // manual
                        $this->processManual($creditCardModel);
                        break;
                    case "Pay Pal": //paypal
                        UserProfile::model()->saveShippingInfo($_POST['ShippingInfoForm']);
                        $this->redirect($this->createUrl("/web/paypal/buy"));
                        break;
                }
            }
        }

        $regionList = CHtml::listData(Region::model()->findAll(), 'id', 'name');
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
            if ($model->save()) {
                
            }
        }


        $regionList = CHtml::listData(Region::model()->findAll(), 'id', 'name');
        $this->render('//payment/payment_method_billing', array(
            'model' => $model,
            'regionList' => $regionList,
            'creditCardModel' => $creditCardModel,
            'error' => $error
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
            $userProfile_model->saveShippingInfo($_POST['ShippingInfoForm'], $error['order_id']);
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

        UserProfile::model()->saveShippingInfo($_POST['ShippingInfoForm'], $order_id);


        $this->customer0rderDetailMailer($_POST['ShippingInfoForm']);
        $this->admin0rderDetailMailer($_POST['ShippingInfoForm'], $order_id);
        Yii::app()->user->setFlash('orderMail', 'Dear Customer Thank you...Your Order has been ordered Successfully.');

        $this->redirect(array('/web/payment/confirmOrder'));
    }

    /*
     * method to send order detail to customer
     */

    public function customer0rderDetailMailer($customerInfo) {

        $email['From'] = Yii::app()->params['adminEmail'];
        $email['To'] = Yii::app()->user->name;
        $email['Subject'] = "Your Order Detail";
        $email['Body'] = $this->renderPartial('_order_email_template', array('customerInfo' => $customerInfo), true, false);
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
        $email['Body'] = $this->renderPartial('_order_email_template_admin', array('customerInfo' => $customerInfo, "order_id" => $order_id), true, false);
        $email['Body'] = $this->renderPartial('/common/_email_template', array('email' => $email), true, false);

        $this->sendEmail2($email);
    }

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

    public function actionconfirmOrder() {

        Yii::app()->user->SiteSessions;
        Yii::app()->theme = Yii::app()->session['layout'];
        Yii::app()->controller->layout = '//layouts/main';
        $this->render('//payment/confirm_order');
    }

}