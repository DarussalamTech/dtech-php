<?php

/**
 * This is the model class for table "product_attributes".
 *
 * The followings are the available columns in table 'product_attributes':
 * @property integer $id
 * @property integer $product_attribute_conf_id
 * @property integer $product_profile_id
 * @property string $attribute_value
 * @property string $create_time
 * @property string $create_user_id
 * @property string $update_time
 * @property string $update_user_id
 */
class ProductAttributes extends DTActiveRecord {

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
            array('product_attribute_conf_id, product_profile_id, attribute_value, create_time, create_user_id, update_time, update_user_id', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, product_attribute_conf_id, product_profile_id, attribute_value, create_time, create_user_id, update_time, update_user_id', 'safe', 'on' => 'search'),
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
            'productProfile' => array(self::BELONGS_TO, 'ProductProfile', 'product_profile_id'),
            'conf_rel' => array(self::BELONGS_TO, 'ConfProductAttributes', 'product_attribute_conf_id',),
            'books_rel' => array(self::BELONGS_TO, 'ConfProductAttributes', 'product_attribute_conf_id', 'condition' => 'type="Books"'),
            'others_rel' => array(self::BELONGS_TO, 'ConfProductAttributes', 'product_attribute_conf_id', 'condition' => 'type="Others"'),
            'quran_rel' => array(self::BELONGS_TO, 'ConfProductAttributes', 'product_attribute_conf_id', 'condition' => 'type="Quran"'),
            'edu_toys_rel' => array(self::BELONGS_TO, 'ConfProductAttributes', 'product_attribute_conf_id', 'condition' => 'type="Educational Toys"'),
        );
    }

    /*
     * return additonal attributes 
     */

    public function ConfAttributes($profile_id) {
        $criteria = new CDbCriteria();
        $criteria->select = "product_attribute_conf_id,product_profile_id,attribute_value";
        $criteria->condition = "product_profile_id = " . $profile_id;
        $attributes = ProductAttributes::model()->findAll($criteria);
        return $attributes;
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => Yii::t('model_labels', 'ID', array(), NULL, Yii::app()->controller->currentLang),
            'product_attribute_conf_id' => Yii::t('model_labels', 'Product Attribute Configuration', array(), NULL, Yii::app()->controller->currentLang),
            'product_profile_id' => Yii::t('model_labels', 'Product Profile', array(), NULL, Yii::app()->controller->currentLang),
            'attribute_value' => Yii::t('model_labels', 'Attribute Value', array(), NULL, Yii::app()->controller->currentLang),
            'create_time' => Yii::t('model_labels', 'Create Time', array(), NULL, Yii::app()->controller->currentLang),
            'create_user_id' => Yii::t('model_labels', 'Create User', array(), NULL, Yii::app()->controller->currentLang),
            'update_time' => Yii::t('model_labels', 'Update Time', array(), NULL, Yii::app()->controller->currentLang),
            'update_user_id' => Yii::t('model_labels', 'Update User', array(), NULL, Yii::app()->controller->currentLang),
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
        $criteria->compare('create_time', $this->create_time, true);
        $criteria->compare('create_user_id', $this->create_user_id, true);
        $criteria->compare('update_time', $this->update_time, true);
        $criteria->compare('update_user_id', $this->update_user_id, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}
