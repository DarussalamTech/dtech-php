<?php

/**
 * This is the model class for table "site".
 *
 * The followings are the available columns in table 'site':
 * @property integer $site_id
 * @property string $site_name
 * @property string $site_descriptoin
 * @property string $site_headoffice
 */
class SelfSite extends DTActiveRecord {

    public $country_id;
    public $_cites = array();

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return SelfSite the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'site';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('site_name, site_descriptoin', 'required'),
            array('site_name', 'unique'),
            array('create_time,create_user_id,update_time,update_user_id', 'required'),
            array('activity_log,site_headoffice,_cites,country_id', 'safe'),
            array('site_name, site_descriptoin', 'length', 'max' => 255),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('site_id, site_name, site_descriptoin,country_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'country' => array(self::HAS_MANY, 'country', 'site_id'),
            'layout' => array(self::HAS_MANY, 'layout', 'site_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'site_id' => 'Site',
            'site_name' => 'Site Name',
            'country_id' => 'Country',
            'site_headoffice' => 'Head Office',
            'site_descriptoin' => 'Site Descriptoin',
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

        $criteria->compare('site_id', $this->site_id);
        $criteria->compare('site_name', $this->site_name, true);
        $criteria->compare('site_descriptoin', $this->site_descriptoin, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * get States for particular country
     */
    public function getCities() {

        $city = City::model()->findByPk($this->site_headoffice);
        $this->country_id = $city->country->country_id;
        $criteria = new CDbCriteria();
        $criteria->select = "city_id,city_name";
        $criteria->condition = "country_id = ".$this->country_id;
        $this->_cites = CHtml::listData(City::model()->findAll($criteria), "city_id", "city_name");
    }

    public function afterFind() {
        $this->getCities();
        parent::afterFind();
    }

    public function getSiteInfo($url) {
        $site = Yii::app()->db->createCommand()
                ->select('*')
                ->from($this->tableName())
                ->where("LOCATE(site_name,'$url')")
                ->queryAll();

        if (isset($site[0])) {
            return $site[0];
        }
        else
            return 0;
    }

}