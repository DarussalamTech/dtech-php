<?php

/**
 * User Update 
 * 
 */
class UserUpdate extends User {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'user';
    }

    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('user_email', 'required'),
            array('create_time,create_user_id,update_time,update_user_id', 'required'),
            array('role_id, status_id, city_id, site_id', 'numerical', 'integerOnly' => true),
            array('is_active', 'length', 'max' => 8),
            array('user_email', 'email'),
            array('user_email', 'unique'),
            array('join_date,social_id', 'safe'),
            array('agreement_status', 'compare', 'compareValue' => '1', 'message' => "You must accept the Darusslam Terms and conditions"),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('special_offer,agreement_status', 'safe'),
            array('user_id, role_id, status_id, city_id, activation_key, is_active, site_id', 'safe', 'on' => 'search'),
        );
    }

    public function beforeSave() {
        if (empty($this->join_date)) {
            $this->join_date = date("Y-m-d");
        } else {
            /** in case of form is filling this value * */
            $this->join_date = DTFunctions::dateFormatForSave($this->join_date);
        }
        return true;
    }

}

?>
