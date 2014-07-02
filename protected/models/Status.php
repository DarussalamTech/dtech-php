<?php

/**
 * This is the model class for table "user_status".
 *
 * The followings are the available columns in table 'user_status':
 * @property integer $id
 * @property string $title
 * @property string $module

 * The followings are the available model relations:
 * @property User[] $users
 */
class Status extends DTActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return UserStatus the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'status';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('title', 'required'),
            array('create_time,create_user_id,update_time,update_user_id', 'required'),
            array('title,module', 'length', 'max' => 255),
            array("title,module,module_id", "safe"),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('title, module', 'safe', 'on' => 'search'),
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
            'title' => 'Status Title',
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

        $criteria->compare('id', $this->id);
        $criteria->compare('title', $this->title);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * getting user status
     * 
     */
    public function gettingUserStatus() {
        $criteria = new CDbCriteria;
        $criteria->addCondition("module = 'User'");
        $status = Status::model()->findAll($criteria);
        return CHtml::listData($status, "id", "title");
    }

    /**
     * getting Order status
     * 
     */
    public function gettingOrderStatus() {
        $criteria = new CDbCriteria;
        $criteria->addCondition("module = 'Order'");
        $status = Status::model()->findAll($criteria);
        return CHtml::listData($status, "id", "title");
    }

    /**
     * getting user status
     * 
     */
    public function gettingInactive() {
        $criteria = new CDbCriteria;
        $criteria->addCondition("module = 'User' AND title ='inactive'");
        $status = Status::model()->find($criteria);
        return $status->id;
    }

    /**
     * getting user status
     * 
     */
    public function getActive() {
        $criteria = new CDbCriteria;
        $criteria->addCondition("module = 'User' AND title ='active'");
        $status = Status::model()->find($criteria);
        return $status->id;
    }

    /**
     * getting pending order status
     * 
     */
    public function gettingPending() {
        $criteria = new CDbCriteria;
        $criteria->addCondition("module = 'Order' AND title ='Pending'");
        $status = Status::model()->find($criteria);
        return $status->id;
    }

}