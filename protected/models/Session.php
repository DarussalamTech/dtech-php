<?php

/**
 * This is the model class for table "session".
 *
 * The followings are the available columns in table 'session':
 * @property integer $ip
 * @property integer $country_id
 * @property integer $city_id
 */
class Session extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Session the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'session';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            // array('country_id, city_id', 'required'),
            array('country_id, city_id', 'numerical', 'integerOnly' => true),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('ip, country_id, city_id', 'safe', 'on' => 'search'),
            array('ip, country_id, city_id', 'safe'),
            array('ip', 'validateIpAddress'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'ip' => 'Ip',
            'country_id' => 'Country',
            'city_id' => 'City',
        );
    }

    public function afterValidate() {

        $this->saveSession();
        return parent::afterValidate();
    }

    /*
     * saving session
     * with city and country id
     */

    public function saveSession() {
        $chttp = new CHttpRequest();
        $this->ip = $chttp->getUserHostAddress();
        $this->city_id = Yii::app()->session['city_id'];
        $this->country_id = Yii::app()->session['country_id'];
    }

    /*
     * check if the current ip of user 
     * already exist in database then
     * delete it
     */

    public function validateIpAddress($attribute, $params) {
        $chttp = new CHttpRequest();
        $old_ip = $chttp->getUserHostAddress();
        if ($old_ip == $this->ip) {
            $this->model()->deleteByPk($this->ip);
        }
    }
    
    public function getCity(){
        $chttp = new CHttpRequest();
        $session = $this->find("ip = '".$chttp->getUserHostAddress()."'");
        return $session->city_id;
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('ip', $this->ip);
        $criteria->compare('country_id', $this->country_id);
        $criteria->compare('city_id', $this->city_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}