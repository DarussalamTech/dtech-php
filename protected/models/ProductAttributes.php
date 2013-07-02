<?php

/**
 * This is the model class for table "product_attributes".
 *
 * The followings are the available columns in table 'product_attributes':
 * @property integer $id
 * @property integer $product_attribute_conf_id
 * @property integer $product_profile_id
 * @property string $attribute_value
 * @property double $price
 * @property string $create_time
 * @property string $create_user_id
 * @property string $update_time
 * @property string $update_user_id
 */
class ProductAttributes extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return ProductAttributes the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'product_attributes';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('product_attribute_conf_id, product_profile_id, attribute_value ', 'required'),
            array('product_attribute_conf_id, product_profile_id', 'numerical', 'integerOnly' => true),
            array('price', 'numerical'),
            array('product_attribute_conf_id, product_profile_id, attribute_value, create_time, create_user_id, update_time, update_user_id', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, product_attribute_conf_id, product_profile_id, attribute_value, price, create_time, create_user_id, update_time, update_user_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'books_rel' => array(self::BELONGS_TO, 'ConfProductAttributes', 'books', 'condition' => 'product_type="Books"'),
            'others_rel' => array(self::BELONGS_TO, 'ConfProductAttributes', 'others', 'condition' => 'product_type="Others"'),
            'quran_rel' => array(self::BELONGS_TO, 'ConfProductAttributes', 'quran', 'condition' => 'product_type="Quran"'),
            'edu_toys_rel' => array(self::BELONGS_TO, 'ConfProductAttributes', 'educational_toys', 'condition' => 'product_type="Educational Toys"'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'product_attribute_conf_id' => 'Product Attribute Conf',
            'product_profile_id' => 'Product Profile',
            'attribute_value' => 'Attribute Value',
            'price' => 'Price',
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
        $criteria->compare('product_attribute_conf_id', $this->product_attribute_conf_id);
        $criteria->compare('product_profile_id', $this->product_profile_id);
        $criteria->compare('attribute_value', $this->attribute_value, true);
        $criteria->compare('price', $this->price);
        $criteria->compare('create_time', $this->create_time, true);
        $criteria->compare('create_user_id', $this->create_user_id, true);
        $criteria->compare('update_time', $this->update_time, true);
        $criteria->compare('update_user_id', $this->update_user_id, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}