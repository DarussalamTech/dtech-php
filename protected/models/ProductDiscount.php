<?php

/**
 * This is the model class for table "product_discount".
 *
 * The followings are the available columns in table 'product_discount':
 * @property integer $id
 * @property string $discount_type
 * @property string $discount_value
 * @property string $applied
 *
 * The followings are the available model relations:
 * @property Product[] $products
 */
class ProductDiscount extends DTActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return ProductDiscount the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'product_discount';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('discount_type, discount_value', 'required'),
            array('create_time,create_user_id,update_time,update_user_id', 'required'),
            array('applied,discount_type, discount_value', 'length', 'max' => 10),
            array('discount_value', 'type', 'type' => 'float'),
            array('discount_value', 'validatePercentage'),
            array('product_id', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, discount_type, discount_value', 'safe', 'on' => 'search'),
        );
    }

    /**
     * 
     * @param type $attribute
     * @param type $params
     */
    public function validatePercentage($attribute, $params) {
        if ($this->discount_type == "percentage") {
            if ($this->$attribute > 100) {
                $this->addError($attribute, "Percentage should'nt be more than 100");
            }
        }
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'product' => array(self::HAS_MANY, 'Product', 'product_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'Discount',
            'product_id' => 'Product',
            'discount_type' => 'Discount Type',
            'applied' => 'Applied',
            'discount_value' => 'Discount Value',
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
        $criteria->compare('product_id', $this->product_id, true);
        $criteria->compare('discount_type', $this->discount_type, true);
        $criteria->compare('discount_value', $this->discount_value, true);
        $criteria->compare('applied', $this->applied, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function beforeSave() {
        if (!empty($this->product_id)) {
            $connection = Yii::app()->db;
            $sql = "UPDATE ".$this->tableName()." t SET t.applied=0 WHERE t.product_id =".$this->product_id;
            $command = $connection->createCommand($sql);
            $command->execute();
        }
        return parent::beforeSave();
    }

}