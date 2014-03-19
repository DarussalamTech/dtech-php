<?php

/**
 * This is the model class for table "order".
 *
 * The followings are the available columns in table 'order':
 * @property integer $order_id
 * @property integer $user_id
 * @property string $total_price
 * @property string $shipping_price
 * @property string $order
 * @property string $order_date
 * @property string $status
 * @property string $user_id
 * @property string $dhl_history_id
 *
 * The followings are the available model relations:
 * @property User $user
 * @property OrderDetail[] $orderDetails
 */
class Order extends DTActiveRecord {

    /**
     * listing status will contain dropdown list for 
     * @var type 
     */
    public $listing_status, $notifyUser, $all_status,$service_charges,$grand_price;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Order the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'order';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('payment_method_id,user_id,total_price, order_date', 'required'),
            array('user_id', 'numerical', 'integerOnly' => true),
            array('create_time,create_user_id,update_time,update_user_id', 'required'),
            array('tax_amount,shipping_price,total_price', 'length', 'max' => 10),
            array('order_date', 'length', 'max' => 255),
            array('dhl_history_id,order_id,service_charges,notifyUser,transaction_id,status,city_id', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('order_id, user_id, total_price, order_date', 'safe', 'on' => 'search'),
        );
    }

    /**
     * Behaviour
     *
     */
    public function behaviors() {
        return array(
            'CSaveRelationsBehavior' => array(
                'class' => 'CSaveRelationsBehavior',
                'relations' => array(
                    'basicFeatures' => array("message" => "Please, fill required fields"),
                ),
            ),
            'CMultipleRecords' => array(
                'class' => 'CMultipleRecords'
            ),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'user' => array(self::BELONGS_TO, 'User', 'user_id'),
            'orderDetails' => array(self::HAS_MANY, 'OrderDetail', 'order_id'),
            'order_history' => array(self::HAS_MANY, 'OrderHistory', 'order_id'),
            'order_status' => array(self::BELONGS_TO, 'Status', 'status', 'condition' => 'module="Order"'),
            'paymentMethod' => array(self::BELONGS_TO, 'ConfPaymentMethods', 'payment_method_id'),
        );
    }

    /*
     * save the current city in order table
     * befor saving action
     * 
     */

    public function beforeSave() {
        $this->city_id = Yii::app()->session['city_id'];

        if (!$this->isAdmin) {
            $this->status = Status::model()->gettingPending();
        }
        return parent::beforeSave();
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'order_id' => Yii::t('model_labels', 'Order', array(), NULL, Yii::app()->controller->currentLang),
            'user_id' => Yii::t('model_labels', 'User', array(), NULL, Yii::app()->controller->currentLang),
            'total_price' => Yii::t('model_labels', 'Total Price', array(), NULL, Yii::app()->controller->currentLang),
            'shipping_price' => Yii::t('model_labels', 'Shipping Price', array(), NULL, Yii::app()->controller->currentLang),
            'order_date' => Yii::t('model_labels', 'Order Date', array(), NULL, Yii::app()->controller->currentLang),
            'update_time' => Yii::t('model_labels', 'Last modified', array(), NULL, Yii::app()->controller->currentLang),
            'status' => Yii::t('common', 'Status', array(), NULL, Yii::app()->controller->currentLang),
            'service_charges' => Yii::t('common', 'Current Service Charges', array(), NULL, Yii::app()->controller->currentLang),
            'tax_amount' => Yii::t('common', 'Tax Amount', array(), NULL, Yii::app()->controller->currentLang),
            'payment_method_id' => Yii::t('model_labels', 'Payment Method', array(), NULL, Yii::app()->controller->currentLang),
            'dhl_history_id' => Yii::t('model_labels', 'Dhl Order ', array(), NULL, Yii::app()->controller->currentLang),
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;
        /**
         * form is sending different format
         * dats y we are converting
         */
        $this->order_date = !empty($this->order_date) ? DTFunctions::dateFormatForSave($this->order_date) : "";

        $criteria->compare('order_id', $this->order_id);
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('total_price', $this->total_price, true);
        $criteria->compare('order_date', $this->order_date, true);
        $criteria->compare('status', $this->status, true);
        $criteria->compare('tax_amount', $this->tax_amount, true);
        $criteria->compare('shipping_price', $this->shipping_price, true);
        $criteria->compare('payment_method_id', $this->payment_method_id, true);
        $criteria->compare('dhl_history_id', $this->dhl_history_id, true);

        $criteria->compare('city_id', Yii::app()->request->getQuery("city_id"), true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array('defaultOrder' => "status='process',order_id DESC")
        ));
    }

    /**
     * set the values
     */
    public function afterFind() {
        $this->order_date = DTFunctions::dateFormatForView($this->order_date);
        $this->manangeAdminElements();
        $this->grand_price = number_format($this->total_price + $this->shipping_price+$this->tax_amount,2);
        parent::afterFind();
    }

    /**
     * 
     */
    public function afterSave() {
        $this->generateAudit();
        return parent::afterSave();
    }

    /**
     * manage admin elements for reporting
     * and admin order module
     */
    public function manangeAdminElements() {
        if ($this->isAdmin) {
            $this->all_status = Status::model()->gettingOrderStatus();
            $dropDownStatus = $this->all_status;
            $this->service_charges = $this->lastServiceCharges();
            /*             * *
             * current status shudnt be the part
             * of dropdown
             */
            unset($dropDownStatus[$this->status]);
            $dropDownStatus = $this->makeStatusBizRule($dropDownStatus);
            $this->listing_status = CHtml::activeDropDownList($this, 'status', $dropDownStatus);
        }
    }

    /*
     * Stock Managment Method 
     * Subtracting the order quantity form stock (product profile quantity)
     * and managing the stock
     */

    public function decreaseStock() {
        foreach ($this->orderDetails as $orderDet) {
            $stock = $orderDet->product_profile->quantity - $orderDet->quantity;

            ProductProfile::model()->updateByPk($orderDet->product_profile->id, array('quantity' => $stock));
        }
    }

    /*
     * Stock Managment Method 
     * Adding the order quantity to stock (product profile quantity)
     * and managing the stock
     * when order is declined
     */

    public function increaseStock() {
        foreach ($this->orderDetails as $orderDet) {
            $stock = $orderDet->product_profile->quantity + $orderDet->quantity;

            ProductProfile::model()->updateByPk($orderDet->product_profile->id, array('quantity' => $stock));
        }
    }

    /**
     * purpose of this function to call 
     * and save the order history
     */
    public function generateAudit() {
        $order_h = new OrderHistory;
        $order_h->order_id = $this->order_id;
        $order_h->user_id = Yii::app()->user->id;

        $order_h->status = $this->status;

        /**
         * for front end site
         */
        if ($this->isAdmin) {

            $order_h->is_notify_customer = $this->notifyUser;
        } else {
            $order_h->is_notify_customer = 1;
        }
        $order_h->save();
    }

    /**
     * some biz rules to avoid duplication
     * of orders stock entry
     * to avoid
     * @param $dropDownStatus
     * 
     */
    public function makeStatusBizRule($dropDownStatus) {

        switch ($this->all_status[$this->status]) {
            case "Cancelled":
                /**
                 * no shipping and completed here
                 */
                if (isset($dropDownStatus[array_search("Shipped", $this->all_status)]))
                    unset($dropDownStatus[array_search("Shipped", $this->all_status)]);
                if (isset($dropDownStatus[array_search("Completed", $this->all_status)]))
                    unset($dropDownStatus[array_search("Completed", $this->all_status)]);
                break;
            case "Refunded":
                /**
                 * no shipping and completed here
                 */
                if (isset($dropDownStatus[array_search("Shipped", $this->all_status)]))
                    unset($dropDownStatus[array_search("Shipped", $this->all_status)]);
                if (isset($dropDownStatus[array_search("Completed", $this->all_status)]))
                    unset($dropDownStatus[array_search("Completed", $this->all_status)]);

                break;
            case "Shipped":
                /**
                 * no shipping and completed here
                 */
                if (isset($dropDownStatus[array_search("Pending", $this->all_status)]))
                    unset($dropDownStatus[array_search("Pending", $this->all_status)]);
                if (isset($dropDownStatus[array_search("Process", $this->all_status)]))
                    unset($dropDownStatus[array_search("Process", $this->all_status)]);
                break;
            case "Completed":
                /**
                 * no Completed and completed here
                 */
                if (isset($dropDownStatus[array_search("Pending", $this->all_status)]))
                    unset($dropDownStatus[array_search("Pending", $this->all_status)]);
                if (isset($dropDownStatus[array_search("Process", $this->all_status)]))
                    unset($dropDownStatus[array_search("Process", $this->all_status)]);
                if (isset($dropDownStatus[array_search("Shipped", $this->all_status)]))
                    unset($dropDownStatus[array_search("Shipped", $this->all_status)]);
                break;
        }

        return $dropDownStatus;
    }
   /**
    * find max service charges 
   */
    public  function lastServiceCharges(){
        $criteria = new CDbCriteria;
        $criteria->select = "service_charges";
        $criteria->addCondition("order_id=".$this->order_id);
        $criteria->order = "id DESC";
        $order = OrderHistory::model()->find($criteria);
        
        return $order->service_charges;
    }

}