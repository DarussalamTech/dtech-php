<?php

/**
 * This is the model class for table "country".
 *
 * The followings are the available columns in table 'country':
 * @property integer $country_id
 * @property string $country_name
 * @property string $short_name
 * @property integer $site_id
 *
 * The followings are the available model relations:
 * @property City[] $cities
 * @property Site $site
 */
class Country extends DTActiveRecord {

    public $_cities = array();

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Country the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'country';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('country_name, short_name, site_id', 'required'),
            array('country_name', 'unique'),
            array('create_time,create_user_id,update_time,update_user_id', 'required'),
            
            array('site_id', 'numerical', 'integerOnly' => true),
            array('country_name, short_name', 'length', 'max' => 255),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('country_id, country_name, short_name, site_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'cities' => array(self::HAS_MANY, 'City', 'country_id'),
            'site' => array(self::BELONGS_TO, 'SelfSite', 'site_id'),
        );
    }

    /**
     * get States for particular country
     */
    public function getCities() {

        // $city = City::model()->findByAttributes($this->country_id);
        //$this->country_id = $city->country->country_id;
        $criteria = new CDbCriteria();
        $criteria->select = "city_id,city_name";
        $criteria->condition = "country_id = " . $this->country_id;
        $this->_cities = CHtml::listData(City::model()->findAll($criteria), "city_id", "city_name");
        //CVarDumper::dump( CHtml::listData(City::model()->findAll($criteria), "city_id", "city_name"),10,TRUE);die;
    }

    public function afterFind() {
        $this->getCities();
        parent::afterFind();
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'country_id' => 'Country',
            'country_name' => 'Country Name',
            'short_name' => 'Short Name',
            'site_id' => 'Site',
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

        $criteria->compare('country_id', $this->country_id);
        $criteria->compare('country_name', $this->country_name, true);
        $criteria->compare('short_name', $this->short_name, true);
        $criteria->compare('site_id', $this->site_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}