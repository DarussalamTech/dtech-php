<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $user_id
 * @property string $user_name
 * @property string $user_password
 * @property integer $role_id
 * @property integer $status_id
 * @property integer $city_id
 * @property string $activation_key
 * @property string $is_active
 * @property integer $site_id
 * @property integer $old_password
 * @property integer $source
 *
 * The followings are the available model relations:
 * @property Order[] $orders
 * @property UserStatus $status
 * @property Site $site
 * @property UserRole $role
 * @property UserProfile[] $userProfiles
 * 
 * 
 */
class User extends DTActiveRecord {
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return User the static model class
     */

    const LEVEL_WHOLE_SELLER  = 4, LEVEL_CUSTOMER = 3, LEVEL_ADMIN = 2, LEVEL_SUPERADMIN = 1, LEVEL_UNKNOWN = 0;
    const WEAK = 0;
    const STRONG = 1;

    public $agreement_status;
    public $user_password2;
    public $old_password;

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'user';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('user_password,user_email', 'required'),
            array('create_time,create_user_id,update_time,update_user_id', 'required'),
            array('role_id, status_id, city_id, site_id', 'numerical', 'integerOnly' => true),
            array('user_password, activation_key', 'length', 'max' => 255),
            array('is_active', 'length', 'max' => 8),
            array('user_password2', 'compare', 'compareAttribute' => 'user_password'),
            array('user_email', 'email'),
            array('user_email', 'unique'),
            array('user_password', 'passwordStrength', 'strength' => self::STRONG),
            array('source,join_date,social_id', 'safe'),
            array('agreement_status', 'compare', 'compareValue' => '1', 'message' => "You must accept the Darusslam Terms and conditions"),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('user_id,user_name,special_offer,agreement_status,old_password,user_password2', 'safe'),
            array('user_id, user_password, role_id, status_id, city_id, activation_key, is_active, site_id', 'safe', 'on' => 'search'),
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
            'COneRelations' => array(
                'class' => 'COneRelations'
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
            'orders' => array(self::HAS_MANY, 'Order', 'user_id'),
            'status' => array(self::BELONGS_TO, 'Status', 'status_id', 'condition' => 'module="User"'),
            'site' => array(self::BELONGS_TO, 'SelfSite', 'site_id'),
            'role' => array(self::BELONGS_TO, 'Authassignment', 'user_id'),
            'userProfiles' => array(self::HAS_ONE, 'UserProfile', 'id'),
            'city' => array(self::BELONGS_TO, 'City', 'city_id'),
            'social' => array(self::HAS_MANY, 'Social', 'yiiuser'),
            'authassignment' => array(self::BELONGS_TO, 'Authassignment', 'userid'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'user_id' => Yii::t('common', 'User', array(), NULL, Yii::app()->controller->currentLang),
            'user_name' => Yii::t('common', 'Name', array(), NULL, Yii::app()->controller->currentLang),
            'user_password' => Yii::t('common', 'Password', array(), NULL, Yii::app()->controller->currentLang),
            'role_id' => Yii::t('common', 'Type', array(), NULL, Yii::app()->controller->currentLang),
            'status_id' => Yii::t('common', 'Status', array(), NULL, Yii::app()->controller->currentLang),
            'city_id' => Yii::t('common', 'City', array(), NULL, Yii::app()->controller->currentLang),
            'activation_key' => Yii::t('common', 'Activation Key', array(), NULL, Yii::app()->controller->currentLang),
            'is_active' => Yii::t('common', 'Is Active', array(), NULL, Yii::app()->controller->currentLang),
            'site_id' => Yii::t('common', 'Site', array(), NULL, Yii::app()->controller->currentLang),
            'user_email' => Yii::t('common', 'Email', array(), NULL, Yii::app()->controller->currentLang),
            'join_date' => Yii::t('common', 'Registration date', array(), NULL, Yii::app()->controller->currentLang),
            'user_password2' => Yii::t('common', 'Confirm Password', array(), NULL, Yii::app()->controller->currentLang),
            'old_password' => Yii::t('common', 'Old Password', array(), NULL, Yii::app()->controller->currentLang),
            'special_offer' => Yii::t('common', 'Special Offers', array(), NULL, Yii::app()->controller->currentLang),
            'agreement_status' => Yii::t('common', 'Agreement Status', array(), NULL, Yii::app()->controller->currentLang),
        );
    }

    static function getAccessLevelList($level = null) {
        $levelList = array(
            self::LEVEL_ADMIN => 'SystemUsers',
            self::LEVEL_CUSTOMER => 'Customer',
            self::LEVEL_WHOLE_SELLER => 'wholesale',
        );
        if ($level === null)
            return $levelList;
        return $levelList[$level];
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('user_name', $this->user_name, true);
        $criteria->compare('user_password', $this->user_password, true);
        $criteria->compare('role_id', $this->role_id);
        $criteria->compare('status_id', $this->status_id);
        $criteria->compare('user_email', $this->status_id);
        $criteria->compare('city_id', $this->city_id);
        $criteria->compare('activation_key', $this->activation_key, true);
        $criteria->compare('is_active', $this->is_active, true);
        $criteria->compare('site_id', $this->site_id);
        
        //in case of no super user then city admin can see its user only
        if(!Yii::app()->user->IsSuperuser){
              $criteria->addCondition("city_id=" . Yii::app()->session['city_id']);
        }
        $criteria->addCondition("user_id<>" . Yii::app()->user->id);
        $criteria->compare('role_id', '2');

        /**
         * 
         */
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function searchCustomer() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('user_name', $this->user_name, true);
        $criteria->compare('user_password', $this->user_password, true);
        $criteria->compare('role_id', '3');
        $criteria->compare('status_id', $this->status_id);
        $criteria->compare('user_email', $this->status_id);
        $criteria->compare('city_id', $this->city_id);
        $criteria->compare('activation_key', $this->activation_key, true);
        $criteria->compare('is_active', $this->is_active, true);
        $criteria->compare('site_id', $this->site_id);
        $criteria->order = 'create_time desc';

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     *  used to set the value for validation
     */
    public function beforeValidate() {

        parent::beforeValidate();
        return true;
    }

    public function beforeSave() {

        /*
         * to handle the exception when 
         * user name is empty then system will 
         * assign user email as user name 
         * by:ubd
         */
        if (empty($this->user_name)) {
            $this->user_name = $this->user_email;
        }



        if (empty($this->join_date)) {
            $this->join_date = date("Y-m-d");
        } else {
            /** in case of form is filling this value * */
            $this->join_date = DTFunctions::dateFormatForSave($this->join_date);
        }
        if (!empty($this->user_password)) {
            $this->user_password = md5($this->user_password);
        }
        parent::beforeSave();
        return true;
    }

    public function afterFind() {

        if (!empty($this->join_date)) {
            $this->join_date = DTFunctions::dateFormatForView($this->join_date);
        }
        parent::afterFind();
    }

    /**
     *  
     *  set the site confugrations
     *  like site id , city id
     *  plust activation key
     */
    public function setSiteConfigurations() {
        
    }

    public function validatePassword($password, $old_password) {

        return md5($password) === $old_password;
        //return $password;
    }

    public function passwordStrength($attribute, $params) {
        if ($params['strength'] === self::WEAK)
            $pattern = '/^(?=.*[a-zA-Z0-9]).{5,}$/';
        elseif ($params['strength'] === self::STRONG)
            $pattern = '/^(?=.*\d.*\d)[0-9 A-Z a-z !@#$%*]{8,}$/';

        
        if (!preg_match($pattern, $this->$attribute))
            $this->addError($attribute, 'Weak Password ! At least 8 characters.Passowrd can contain both letters and numbers!');
        
        
    }

    public function customerHistory() {
        $data = "";
        $id = Yii::app()->user->id;
        $criteria = new CDbCriteria();
        $criteria->condition = 'user_id=' . $id;
        $criteria->order = "status ='process' DESC";
        $data = new CActiveDataProvider('Order', array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => array(
                    'create_time' => 'DESC',
                ),
            ),
            'pagination' => array(
                'pageSize' => 100,
            ),
        ));
        return $data;
    }

    /**
     * Get city admin
     * Temporray
     */
    public function getCityAdmin() {
        $critera = new CDbCriteria();
        $critera->select = "user_email";
        $critera->condition = "role_id =2 AND city_id = :city_id";
        $critera->params = array("city_id"=> Yii::app()->request->getQuery("city_id"));
        $user = User::model()->find($critera);
        if (!empty($user)) {
            return $user->user_email;
        } else {
            return Yii::app()->params['default_admin'];
        }
    }

}