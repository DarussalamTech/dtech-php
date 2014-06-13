g<?php

/**
 * This is the model class for table "site".
 *
 * The followings are the available columns in table 'site':
 * @property integer $site_id
 * @property string $site_name
 * @property string $site_descriptoin
 * @property string $site_headoffice
 * @property string $fb_key
 * @property string $fb_secret
 * @property string $google_key
 * @property string $google_secret
 * @property string $twitter_key
 * @property string $twitter_secret
 * @property string $linkedin_key
 * @property string $linkedin_secret
 */
class SelfSite extends DTActiveRecord {

    public $country_id;
    public $_cites = array(),$_statuses = array("0"=>"Disabled","1"=>"Enabled");

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
            array('site_headoffice,_cites,country_id,status', 'safe'),
            array('site_name, site_descriptoin', 'length', 'max' => 255),
            array("linkedin_key,linkedin_secret,fb_secret,fb_key","safe"),
            array("google_key,google_secret,twitter_key,twitter_secret","safe"),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('site_id, site_name,status,site_descriptoin,country_id', 'safe', 'on' => 'search'),
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
        $criteria->compare('status', $this->fb_key, true);
        $criteria->compare('status', $this->fb_secret, true);
        $criteria->compare('status', $this->google_key, true);
        $criteria->compare('status', $this->google_secret, true);
        $criteria->compare('status', $this->twitter_key, true);
        $criteria->compare('status', $this->twitter_secret, true);
        $criteria->compare('status', $this->linkedin_key, true);
        $criteria->compare('status', $this->linkedin_secret, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * get States for particular country
     */
    public function getCities() {

        if (!empty($this->site_headoffice) && $this->site_headoffice != 0) {
            $city = City::model()->findByPk($this->site_headoffice);

            if (!empty($city->country_id)) {
                $criteria = new CDbCriteria();
                $criteria->select = "city_id,city_name,country_id";
                $criteria->condition = "country_id = " . $city->country_id;
                $this->_cites = CHtml::listData(City::model()->findAll($criteria), "city_id", "city_name");
                $this->country_id = $city->country_id;
            }
        }
    }

    public function afterFind() {
        $this->getCities();
        parent::afterFind();
    }

    public function getSiteInfo($url) {
        $site = Yii::app()->db->createCommand()
                ->select('site_id,site_name,site_descriptoin,site_headoffice,
                            status,fb_key,fb_secret,google_key,google_secret,
                            twitter_key,twitter_secret,linkedin_key,linkedin_secret
                            ')
                ->from($this->tableName())
                ->where("LOCATE(site_name,'$url')")
                ->queryRow();

        //echo "LOCATE(site_name,'$url')";
        if (isset($site)) {
            return $site;
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
    public function findLayout($site_id) {
        if (!empty($site_id)) {
           
            $layout = Layout::model()->find("site_id=" . $site_id);
            
            return !empty($layout) ? $layout->layout_name : "dtech_second";
        } else {
            return "dtech_second";
        }
    }

}
