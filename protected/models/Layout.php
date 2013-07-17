<?php

/**
 * This is the model class for table "layout".
 *
 * The followings are the available columns in table 'layout':
 * @property integer $layout_id
 * @property string $layout_name
 * @property string $layout_description
 * @property string $layout_color
 * @property integer $site_id
 *
 * The followings are the available model relations:
 * @property City[] $cities
 * @property City $layout
 * @property Site $site
 */
class Layout extends DTActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Layout the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'layout';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('layout_name, layout_description, layout_color, site_id', 'required'),
            array('create_time,create_user_id,update_time,update_user_id', 'required'),
            array('site_id', 'numerical', 'integerOnly' => true),
            array('layout_name, layout_description, layout_color', 'length', 'max' => 255),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('layout_id, layout_name, layout_description, layout_color, site_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'cities' => array(self::HAS_MANY, 'City', 'layout_id'),
            'layout' => array(self::BELONGS_TO, 'City', 'layout_id'),
            'site' => array(self::BELONGS_TO, 'SelfSite', 'site_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'layout_id' => Yii::t('model_labels', 'Layout', array(), NULL, Yii::app()->controller->currentLang),
            'layout_name' => Yii::t('model_labels', 'Layout Name', array(), NULL, Yii::app()->controller->currentLang),
            'layout_description' => Yii::t('model_labels', 'Layout Description', array(), NULL, Yii::app()->controller->currentLang),
            'layout_color' => Yii::t('model_labels', 'Layout Color', array(), NULL, Yii::app()->controller->currentLang),
            'site_id' => Yii::t('model_labels', 'Site', array(), NULL, Yii::app()->controller->currentLang),
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

        $criteria->compare('layout_id', $this->layout_id);
        $criteria->compare('layout_name', $this->layout_name, true);
        $criteria->compare('layout_description', $this->layout_description, true);
        $criteria->compare('layout_color', $this->layout_color, true);
        $criteria->compare('site_id', $this->site_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}