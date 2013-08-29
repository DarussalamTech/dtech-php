<?php

/**
 * This is the model class for table "user_order_billing".
 *
 * The followings are the available columns in table 'user_order_billing':
 * @property integer $id
 * @property integer $user_id
 * @property integer $order_id
 * @property string $billing_prefix
 * @property string $billing_first_name
 * @property string $billing_last_name
 * @property string $billing_address1
 * @property string $billing_address2
 * @property string $billing_country
 * @property string $billing_state
 * @property string $billing_city
 * @property integer $billing_zip
 * @property string $billing_phone
 * @property string $billing_mobile
 * @property string $create_time
 * @property string $create_user_id
 * @property string $update_time
 * @property string $update_user_id
 *
 * The followings are the available model relations:
 * @property Order $order
 * @property User $user
 */
class UserOrderBilling extends DTActiveRecord {

    public $_states = array();
    public $isSameShipping;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return UserOrderBilling the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'user_order_billing';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('user_id, create_time, create_user_id, update_time, update_user_id', 'required'),
            array('user_id, order_id, billing_zip', 'numerical', 'integerOnly' => true),
            array('billing_prefix', 'length', 'max' => 3),
            array('billing_first_name, billing_last_name, billing_address1, billing_address2, billing_country, billing_state, billing_city', 'required'),
            array('billing_first_name, billing_last_name, billing_address1, billing_address2, billing_country, billing_state, billing_city, billing_phone, billing_mobile', 'length', 'max' => 255),
            array('create_user_id, update_user_id', 'length', 'max' => 11),
            array('isSameShipping,order_id', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, user_id, order_id, billing_prefix, billing_first_name, billing_last_name, billing_address1, billing_address2, billing_country, billing_state, billing_city, billing_zip, billing_phone, billing_mobile, create_time, create_user_id, update_time, update_user_id', 'safe', 'on' => 'search'),
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
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'user_id' => 'User',
            'order_id' => Yii::t('model_labels', 'Order', array(), NULL, Yii::app()->controller->currentLang),
            'billing_prefix' => Yii::t('model_labels', 'Billing Prefix', array(), NULL, Yii::app()->controller->currentLang),
            'billing_first_name' => Yii::t('model_labels', 'Billing First Name', array(), NULL, Yii::app()->controller->currentLang),
            'billing_last_name' => Yii::t('model_labels', 'Billing Last Name', array(), NULL, Yii::app()->controller->currentLang),
            'billing_address1' => Yii::t('model_labels', 'Billing Address1', array(), NULL, Yii::app()->controller->currentLang),
            'billing_address2' => Yii::t('model_labels', 'Billing Address2', array(), NULL, Yii::app()->controller->currentLang),
            'billing_country' => Yii::t('model_labels', 'Billing Country', array(), NULL, Yii::app()->controller->currentLang),
            'billing_state' => Yii::t('model_labels', 'Billing State', array(), NULL, Yii::app()->controller->currentLang),
            'billing_city' => Yii::t('model_labels', 'Billing City', array(), NULL, Yii::app()->controller->currentLang),
            'billing_zip' => Yii::t('model_labels', 'Billing Zip', array(), NULL, Yii::app()->controller->currentLang),
            'billing_phone' => Yii::t('model_labels', 'Billing Phone', array(), NULL, Yii::app()->controller->currentLang),
            'billing_mobile' => Yii::t('model_labels', 'Billing Mobile', array(), NULL, Yii::app()->controller->currentLang),
            'isSameShipping' => Yii::t('model_labels', 'Same as shipping', array(), NULL, Yii::app()->controller->currentLang),
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
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('order_id', $this->order_id);
        $criteria->compare('billing_prefix', $this->billing_prefix, true);
        $criteria->compare('billing_first_name', $this->billing_first_name, true);
        $criteria->compare('billing_last_name', $this->billing_last_name, true);
        $criteria->compare('billing_address1', $this->billing_address1, true);
        $criteria->compare('billing_address2', $this->billing_address2, true);
        $criteria->compare('billing_country', $this->billing_country, true);
        $criteria->compare('billing_state', $this->billing_state, true);
        $criteria->compare('billing_city', $this->billing_city, true);
        $criteria->compare('billing_zip', $this->billing_zip);
        $criteria->compare('billing_phone', $this->billing_phone, true);
        $criteria->compare('billing_mobile', $this->billing_mobile, true);
        $criteria->compare('create_time', $this->create_time, true);
        $criteria->compare('create_user_id', $this->create_user_id, true);
        $criteria->compare('update_time', $this->update_time, true);
        $criteria->compare('update_user_id', $this->update_user_id, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * get States for particular country
     */
    public function getStates() {
        $stateList = array();
       
        if (!empty($this->billing_country)) {
            /*
             * PCM
             */
            $stateList = Subregion::model()->findAll('region_id="' . $this->billing_country . '"');

            $stateList = CHtml::listData($stateList, 'name', 'name');
            
        }
        return $stateList;
    }

    public function beforeValidate() {

        $this->_states = $this->getStates();
        parent::beforeValidate();
        return true;
    }
    public function afterFind() {

        $this->_states = $this->getStates();
  
        parent::afterFind();
        return true;
    }

}