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
            array('site_headoffice,_cites,country_id', 'safe'),
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
            'site_id' => Yii::t('model_labels', 'Site', array(), NULL, Yii::app()->controller->currentLang),
            'site_name' => Yii::t('model_labels', 'Site Name', array(), NULL, Yii::app()->controller->currentLang),
            'country_id' => Yii::t('model_labels', 'Country', array(), NULL, Yii::app()->controller->currentLang),
            'site_headoffice' => Yii::t('model_labels', 'Head Office', array(), NULL, Yii::app()->controller->currentLang),
            'site_descriptoin' => Yii::t('model_labels', 'Site Description', array(), NULL, Yii::app()->controller->currentLang),
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

        $criteria = new CDbCriteria();
        $criteria->select = "city_id,city_name";
        $criteria->condition = "country_id = " . $city->country_id;

        if (!empty($city->country_id)) {
            $this->_cites = CHtml::listData(City::model()->findAll($criteria), "city_id", "city_name");
            
        }
        if($this->site_headoffice !=""){
           
           $this->country_id = City::model()->findByPk($this->site_headoffice)->country_id;
        }
    }

    public function afterFind() {
        $this->getCities();
        parent::afterFind();
    }

    public function getSiteInfo($url) {
        $site = Yii::app()->db->createCommand()
                ->select('site_id,site_name,site_descriptoin,site_headoffice')
                ->from($this->tableName())
                ->where("LOCATE(site_name,'$url')")
                ->queryAll();

        //echo "LOCATE(site_name,'$url')";
        if (isset($site[0])) {
            return $site[0];
        }
        else
            return 0;
    }

    /**
     * city location
     */
    public function findCityLocation($city_id) {
        $criteria = new CDbCriteria(array(
            'select' => "city_id,t.city_name,t.country_id,layout_id,currency_id" .
            "t.short_name,layout_id",
            'condition' => "t.city_id='" . $city_id . "'"
        ));

        $cityfind = City::model()->with(array(
                    'country' => array(
                        'select' => 'c.country_name,c.short_name',
                        'joinType' => 'INNER JOIN', 'alias' => 'c'),
                    'currency' => array('select' => 'name,symbol', 'joinType' => 'INNER JOIN'),
                ))->find($criteria);


        return $cityfind;
    }

    /**
     *  find layout name against
     * layout id
     * @param type $layout_id
     * @return string
     */
    public function findLayout($layout_id) {
        if (!empty($layout_id)) {
           
            $layout = Layout::model()->find("layout_id=" . $layout_id);
            return $layout;
        } else {
            return "dtech-second";
        }
    }

}
