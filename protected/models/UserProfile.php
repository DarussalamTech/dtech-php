<?php

/**
 * This is the model class for table "user_profile".
 *
 * The followings are the available columns in table 'user_profile':
 * @property integer $user_profile_id
 * @property integer $user_id
 * @property string $first_name
 * @property string $last_name
 * @property string $address
 * @property string $email
 * @property string $contact_number
 * @property string $date_of_birth
 *
 * The followings are the available model relations:
 * @property User $user
 */
class UserProfile extends DTActiveRecord {
//    public $avatar;
//    public $date_of_birth;
//    public $address2;
//    public $zip_code;

    /**
     *
     * @var type 
     * uploaded path for image
     */
    public $uploaded_img = "", $temp_avatar;
    public $oldImg = "";

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return UserProfile the static model class
     */
    public static function model($className = __CLASS__) {

        return parent::model($className);
    }

    public function __construct($scenario = 'insert') {
        $this->uploaded_img = Yii::app()->baseUrl . "/images/noImage.png";
        parent::__construct($scenario);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'user_profile';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('first_name, last_name', 'required'),
            array('create_time,create_user_id,update_time,update_user_id', 'required'),
            //array('avatar', 'file', 'types' => 'jpg, gif, png', 'allowEmpty' => true),
            //array('user_id', 'numerical', 'integerOnly'=>true),
            array('first_name, last_name, address,  contact_number', 'length', 'max' => 255),
            array('id, first_name, last_name, address, gender, contact_number,city', 'safe'),
            array('temp_avatar,avatar,date_of_birth,state_province,address_2,country,zip_code', 'safe'),
            array('shipping_prefix,shipping_first_name,shipping_last_name,shipping_address1,shipping_address2,shipping_country', 'safe'),
            array('shipping_state,shipping_city,shipping_zip,shipping_phone,mobile_number,is_shipping_address', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, first_name, last_name, address, gender, contact_number,city', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'user' => array(self::BELONGS_TO, 'User', 'id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => Yii::t('model_labels', 'Profile', array(), NULL, Yii::app()->controller->currentLang),
            'first_name' => Yii::t('model_labels', 'First Name', array(), NULL, Yii::app()->controller->currentLang),
            'last_name' => Yii::t('model_labels', 'Last Name', array(), NULL, Yii::app()->controller->currentLang),
            'address' => Yii::t('model_labels', 'Address 1', array(), NULL, Yii::app()->controller->currentLang),
            'address_2' => Yii::t('model_labels', 'Address 2', array(), NULL, Yii::app()->controller->currentLang),
            'city' => Yii::t('model_labels', 'City', array(), NULL, Yii::app()->controller->currentLang),
            'country' => Yii::t('model_labels', 'Country', array(), NULL, Yii::app()->controller->currentLang),
            'state_province' => Yii::t('model_labels', 'State/Province', array(), NULL, Yii::app()->controller->currentLang),
            'gender' => Yii::t('model_labels', 'Gender', array(), NULL, Yii::app()->controller->currentLang),
            'zip_code' => Yii::t('model_labels', 'Zip Code', array(), NULL, Yii::app()->controller->currentLang),
            'contact_number' => Yii::t('model_labels', 'Phone Number', array(), NULL, Yii::app()->controller->currentLang),
            'mobile_number' => Yii::t('model_labels', 'Mobile Number', array(), NULL, Yii::app()->controller->currentLang),
            'is_shipping_address' => Yii::t('model_labels', 'Select if shipping address is same as above', array(), NULL, Yii::app()->controller->currentLang),
            'avatar' => Yii::t('model_labels', 'Profile Picture', array(), NULL, Yii::app()->controller->currentLang),
            'date_of_birth' => Yii::t('model_labels', 'Date Of Birth', array(), NULL, Yii::app()->controller->currentLang),
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data pr$order_idovider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('first_name', $this->first_name, true);
        $criteria->compare('last_name', $this->last_name, true);
        $criteria->compare('address', $this->address, true);
        $criteria->compare('contact_number', $this->contact_number, true);
        $criteria->compare('city', $this->city, true);
        $criteria->compare('gender', $this->gender, true);
        $criteria->compare('mobile_number', $this->mobile_number, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function getFullName() {

        $firstN = $this->first_name;
        $lastN = $this->last_name;
        return $firstN . $lastN;
    }

    public function afterFind() {

        if (!empty($this->avatar)) {
            $this->uploaded_img = Yii::app()->baseUrl . "/uploads/user_profile/" . $this->user->primaryKey . "/" . $this->avatar;
        } else {
            $this->uploaded_img = Yii::app()->baseUrl . "/images/noImage.png";
        }

        if (!empty($this->date_of_birth)) {
            $this->date_of_birth = DTFunctions::dateFormatForView($this->date_of_birth);
        }


        $this->oldImg = $this->avatar;

        parent::afterFind();
    }

    /**
     * before save to convert 
     * few things like date
     */
    public function beforeSave() {
        if (!empty($this->date_of_birth)) {
            $this->date_of_birth = DTFunctions::dateFormatForSave($this->date_of_birth);
        }
        parent::beforeSave();
        return true;
    }

    public function afterSave() {

        $this->deleteldImage();
        parent::afterSave();
    }

    /**
     * to delete old image in case of not empty
     * not equal new image
     */
    public function deleteldImage() {

        if (!empty($this->oldImg) && $this->oldImg != $this->avatar) {
            $file = Yii::app()->basePath . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR;
            $file.= "uploads" . DIRECTORY_SEPARATOR . "user_profile" . DIRECTORY_SEPARATOR . $this->user->primaryKey . DIRECTORY_SEPARATOR . $this->oldImg;

            DTUploadedFile::deleteExistingFile($file);
        }
    }

    /**
     * 
     * @param type $attributes
     * @param type $order_id
     * /**
     * Save shipping information in case of payment
     */
    public function saveShippingInfo($attributes, $order_id = 0) {

        $shippingInfo = new UserOrderShipping;

        $shippingInfo->attributes = $attributes;
        $shippingInfo->user_id = Yii::app()->user->id;
        $shippingInfo->order_id = $order_id;

        $shippingInfo->save(false);
    }

    /**
     * update shipping order last id
     * @param type $order_id
     */
    public function updateShippingInfo($order_id) {
        $criteria = new CDbCriteria;
        $criteria->addCondition("user_id = " . Yii::app()->user->id);
        $criteria->order = "id DESC";

        $model = UserOrderShipping::model()->find($criteria);
        $model->updateByPk($model->id,array("order_id"=>$order_id));
        return $model;
    }

}