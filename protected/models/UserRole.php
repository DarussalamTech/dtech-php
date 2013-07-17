<?php

/**
 * This is the model class for table "user_role".
 *
 * The followings are the available columns in table 'user_role':
 * @property integer $role_id
 * @property string $role_title
 *
 * The followings are the available model relations:
 * @property User[] $users
 */
class UserRole extends DTActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return UserRole the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'user_role';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('role_title', 'required'),
            array('create_time,create_user_id,update_time,update_user_id', 'required'),
            array('role_title', 'length', 'max' => 255),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('role_id, role_title', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'users' => array(self::HAS_MANY, 'User', 'role_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'role_id' => Yii::t('model_labels', 'Role', array(), NULL, Yii::app()->controller->currentLang),
            'role_title' => Yii::t('model_labels', 'Role Title', array(), NULL, Yii::app()->controller->currentLang),
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

        $criteria->compare('role_id', $this->role_id);
        $criteria->compare('role_title', $this->role_title, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}