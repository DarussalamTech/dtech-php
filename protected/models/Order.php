<?php

/**
 * This is the model class for table "order".
 *
 * The followings are the available columns in table 'order':
 * @property integer $order_id
 * @property integer $user_id
 * @property string $total_price
 * @property string $order_date
 * @property string $status
 *
 * The followings are the available model relations:
 * @property User $user
 * @property OrderDetail[] $orderDetails
 */
class Order extends DTActiveRecord
{

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Order the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'order';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('payment_method_id,user_id, total_price, order_date', 'required'),
            array('user_id', 'numerical', 'integerOnly' => true),
            array('create_time,create_user_id,update_time,update_user_id', 'required'),
            array('activity_log', 'safe'),
            array('total_price', 'length', 'max' => 10),
            array('order_date', 'length', 'max' => 255),
            array('transaction_id,status','safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('order_id, user_id, total_price, order_date', 'safe', 'on' => 'search'),
        );
    }

    /**
     * Behaviour
     *
     */
    public function behaviors()
    {
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
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'user' => array(self::BELONGS_TO, 'User', 'user_id'),
            'orderDetails' => array(self::HAS_MANY, 'OrderDetail', 'order_id'),
            'paymentMethod' => array(self::BELONGS_TO, 'ConfPaymentMethods', 'payment_method_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'order_id' => 'Order',
            'user_id' => 'User',
            'total_price' => 'Total Price',
            'order_date' => 'Order Date',
            'status' => 'Status',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('order_id', $this->order_id);
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('total_price', $this->total_price, true);
        $criteria->compare('order_date', $this->order_date, true);
        $criteria->compare('status', $this->status, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}