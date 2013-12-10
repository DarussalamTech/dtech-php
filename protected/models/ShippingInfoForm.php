<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class ShippingInfoForm extends CFormModel {

    public $shipping_prefix;
    public $shipping_first_name;
    public $shipping_last_name;
    public $shipping_address1;
    public $shipping_address2;
    public $shipping_country;
    public $shipping_city;
    public $shipping_state;
    public $shipping_zip;
    public $shipping_phone;
    public $shipping_mobile;
    public $payment_method;
    public $_calculate_shipping,$_shipping_cost;
    private $_identity;
    public $_states = array();

    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules() {
        return array(
            // username and password are required
            array('_shipping_cost,payment_method,shipping_first_name, shipping_last_name,
                   shipping_address1,shipping_country,
                   shipping_city, shipping_state, shipping_zip, shipping_phone', 'required'),
            array('shipping_phone', 'length', 'max' => 10),
            array('shipping_phone', 'numerical', 'integerOnly' => true),
            array('shipping_phone, shipping_mobile', 'match', 'pattern'=>'/^[0-9-+]+$/'),
            array('_calculate_shipping,_states,payment_method', 'safe'),
                // rememberMe needs to be a boolean
                //array('rememberMe', 'boolean'),
                // password needs to be authenticated
                //array('password', 'authenticate'),
        );
    }

    /**
     * Declares attribute labels.
     */

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'shipping_prefix' => Yii::t('model_labels', 'Prefix', array(), NULL, Yii::app()->controller->currentLang),
            'shipping_first_name' => Yii::t('model_labels', 'First Name', array(), NULL, Yii::app()->controller->currentLang),
            'shipping_last_name' => Yii::t('model_labels', 'Last Name', array(), NULL, Yii::app()->controller->currentLang),
            'shipping_address1' => Yii::t('model_labels', 'Address 1', array(), NULL, Yii::app()->controller->currentLang),
            'shipping_address2' => Yii::t('model_labels', 'Address 2', array(), NULL, Yii::app()->controller->currentLang),
            'shipping_country' => Yii::t('model_labels', 'Country', array(), NULL, Yii::app()->controller->currentLang),
            'shipping_city' => Yii::t('model_labels', 'City', array(), NULL, Yii::app()->controller->currentLang),
            'shipping_state' => Yii::t('model_labels', 'State', array(), NULL, Yii::app()->controller->currentLang),
            'shipping_zip' => Yii::t('model_labels', 'Zip Code', array(), NULL, Yii::app()->controller->currentLang),
            'shipping_phone' => Yii::t('model_labels', 'Phone', array(), NULL, Yii::app()->controller->currentLang),
            'payment_method' => Yii::t('model_labels', 'Payment Method', array(), NULL, Yii::app()->controller->currentLang),
            '_calculate_shipping' => Yii::t('model_labels', 'Calculate Shipping', array(), NULL, Yii::app()->controller->currentLang),
        );
    }

    public function beforeValidate() {

        $this->_states = $this->getStates();
        parent::beforeValidate();
        return true;
    }

    /**
     * get States for particular country
     */
    public function getStates() {
        $stateList = array();
        if (!empty($this->shipping_country)) {
            /*
             * PCM
             */
            $stateList = Subregion::model()->findAll('region_id="' . $this->shipping_country . '"');

            $stateList = CHtml::listData($stateList, 'name', 'name');
        }
        return $stateList;
    }

    /**
     * assign attribue before any action to
     * this form of current user
     */
    public function setAttributeByDefault() {
        $userinfo = UserProfile::model()->findByPk(Yii::app()->user->id);
        // in this case when user has set bit that
        // user want to use orignial address to 1
        
        /**
         * in this case when user has its own 
         * billing address then it will be same address as shipping
         */
        if(!empty($_REQUEST['billing'])){
            $billing = UserOrderBilling::model()->findByPk($_REQUEST['billing']);
            
            $this->shipping_first_name = $billing->billing_first_name;
            $this->shipping_last_name = $billing->billing_last_name;
            $this->shipping_address1 = $billing->billing_address1;
            $this->shipping_address2 = $billing->billing_address2;
            $this->shipping_country = $billing->billing_country;
            $this->shipping_state = $billing->billing_state;
            $this->shipping_city = $billing->billing_city;
            $this->shipping_zip = $billing->billing_zip;
            $this->shipping_phone = $billing->billing_phone;
        }
        else if (isset($userinfo->is_shipping_address) && $userinfo->is_shipping_address == 1) {
            $this->shipping_first_name = $userinfo->first_name;
            $this->shipping_last_name = $userinfo->last_name;
            $this->shipping_address1 = $userinfo->address;
            $this->shipping_country = $userinfo->country;
            $this->shipping_state = $userinfo->state_province;
            $this->shipping_city = $userinfo->city;
            $this->shipping_zip = $userinfo->zip_code;
            $this->shipping_phone = $userinfo->contact_number;
        } else {
            $criteria = new CDbCriteria();
            $criteria->addCondition("user_id = " . Yii::app()->user->id);
            $criteria->order = "id DESC";

            $user_order_shipping = UserOrderShipping::model()->find($criteria);

            if (!empty($user_order_shipping)) {
                $this->shipping_first_name = $user_order_shipping->shipping_first_name;
                $this->shipping_last_name = $user_order_shipping->shipping_last_name;
                $this->shipping_address1 = $user_order_shipping->shipping_address1;
                $this->shipping_address2 = $user_order_shipping->shipping_address2;
                $this->shipping_country = $user_order_shipping->shipping_country;
                $this->shipping_state = $user_order_shipping->shipping_state;
                $this->shipping_city = $user_order_shipping->shipping_city;
                $this->shipping_zip = $user_order_shipping->shipping_zip;
                $this->shipping_phone = $user_order_shipping->shipping_phone;
            }
        }
        $this->_states = $this->getStates();
    }

}
