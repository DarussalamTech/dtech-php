<?php

/**
 * This is the model class for table "order_history".
 *
 * The followings are the available columns in table 'order_history':
 * @property integer $id
 * @property string $comment
 * @property integer $user_id
 * @property integer $order_id
 * @property string $status
 * @property string $is_notify_customer
 * @property string $service_charges 	
 * @property string $create_time
 * @property string $create_user_id
 * @property string $update_time
 * @property string $update_user_id
 *
 * The followings are the available model relations:
 * @property Order $order
 */
class OrderHistory extends DTActiveRecord {

    public $include_comment;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return OrderHistory the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'order_history';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('user_id, order_id, status, create_time, create_user_id, update_time, update_user_id', 'required'),
            array('user_id, order_id', 'numerical', 'integerOnly' => true),
            array('service_charges', 'numerical', 'integerOnly' => true),
            array('status', 'length', 'max' => 9),
            array('create_user_id, update_user_id', 'length', 'max' => 11),
            array('service_charges,include_comment,is_notify_customer,comment', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, comment, user_id, order_id, status, create_time, create_user_id, update_time, update_user_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'order' => array(self::BELONGS_TO, 'Order', 'order_id'),
            'user' => array(self::BELONGS_TO, 'User', 'user_id'),
            'order_status' => array(self::BELONGS_TO, 'Status', 'status', 'condition' => 'module="Order"'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'comment' => 'Comment',
            'user_id' => 'User',
            'order_id' => 'Order',
            'status' => 'Status',
            'is_notify_customer' => 'Notify Customer',
            'create_time' => 'Create Time',
            'create_user_id' => 'Create User',
            'update_time' => 'Update Time',
            'update_user_id' => 'Update User',
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

        $criteria->compare('id', $this->id);
        $criteria->compare('comment', $this->comment, true);
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('order_id', $this->order_id);
        $criteria->compare('status', $this->status, true);
        $criteria->compare('is_notify_customer', $this->is_notify_customer, true);
        $criteria->compare('create_time', $this->create_time, true);
        $criteria->compare('create_user_id', $this->create_user_id, true);
        $criteria->compare('update_time', $this->update_time, true);
        $criteria->compare('update_user_id', $this->update_user_id, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}