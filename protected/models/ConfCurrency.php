<?php

/**
 * This is the model class for table "currency".
 *
 * The followings are the available columns in table 'currency':
 * @property string $id
 * @property string $name
 * @property string $symbol
 * @property string $create_time
 * @property string $create_user_id
 * @property string $update_time
 * @property string $update_user_id
 */
class ConfCurrency extends DTActiveRecord {

    public $confViewName = 'confCurrency/index';

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Currency the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'currency';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, symbol, create_time, create_user_id, update_time, update_user_id', 'required'),
            array('name', 'length', 'max' => 255),
            array('name,symbol', 'unique'),
            array('symbol', 'length', 'max' => 15),
            array('create_user_id, update_user_id', 'length', 'max' => 11),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, name, symbol, create_time, create_user_id, update_time, update_user_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'cities' => array(self::HAS_MANY, 'City', 'currency_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => Yii::t('model_labels', 'ID', array(), NULL, Yii::app()->controller->currentLang),
            'name' => Yii::t('common', 'Name', array(), NULL, Yii::app()->controller->currentLang),
            'symbol' => Yii::t('model_labels', 'Symbol', array(), NULL, Yii::app()->controller->currentLang),
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

        $criteria->compare('id', $this->id, true);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('symbol', $this->symbol, true);
        $criteria->compare('create_time', $this->create_time, true);
        $criteria->compare('create_user_id', $this->create_user_id, true);
        $criteria->compare('update_time', $this->update_time, true);
        $criteria->compare('update_user_id', $this->update_user_id, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}