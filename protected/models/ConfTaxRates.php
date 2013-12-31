<?php

/**
 * This is the model class for table "tax_rates".
 *
 * The followings are the available columns in table 'tax_rates':
 * @property integer $id
 * @property integer $city_id
 * @property string $title
 * @property double $price_level
 * @property double $tax_rate
 * @property string $rate_type
 * @property integer $class_status
 * @property string $create_time
 * @property string $create_user_id
 * @property string $update_time
 * @property string $update_user_id
 */
class ConfTaxRates extends DTActiveRecord {

    public $confViewName = 'confTaxRates/index';
    public $_calulated_rate;
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return TaxRates the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tax_rates';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('city_id, title, create_time, create_user_id, update_time, update_user_id', 'required'),
            array('city_id, class_status', 'numerical', 'integerOnly' => true),
            array('price_level, tax_rate', 'numerical'),
            array('title', 'length', 'max' => 255),
            array('rate_type', 'length', 'max' => 10),
            array('create_user_id, update_user_id', 'length', 'max' => 11),
            array('_calulated_rate','safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, city_id, title, price_level, tax_rate, rate_type, class_status, create_time, create_user_id, update_time, update_user_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'city' => array(self::BELONGS_TO, 'City', 'city_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'city_id' => 'City',
            'title' => 'Title',
            'price_level' => 'Price Level',
            'tax_rate' => 'Tax Rate',
            'rate_type' => 'Rate Type',
            'class_status' => 'Class Status',
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
        $criteria->compare('city_id', $this->city_id);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('price_level', $this->price_level);
        $criteria->compare('tax_rate', $this->tax_rate);
        $criteria->compare('rate_type', $this->rate_type, true);
        $criteria->compare('class_status', $this->class_status);
        $criteria->compare('create_time', $this->create_time, true);
        $criteria->compare('create_user_id', $this->create_user_id, true);
        $criteria->compare('update_time', $this->update_time, true);
        $criteria->compare('update_user_id', $this->update_user_id, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }
    /**
     * run time calcluated valude
     */
    public function afterFind() {
        $this->_calulated_rate = ($this->rate_type == "percentage")?($this->price_level * $this->tax_rate)/100:$this->tax_rate; 
        return parent::afterFind();
    }

}