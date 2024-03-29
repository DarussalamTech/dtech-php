<?php

/**
 * This is the model class for table "notification_folder".
 *
 * The followings are the available columns in table 'notification_folder':
 * @property integer $id
 * @property string $name
 * @property string $create_time
 * @property string $create_user_id
 * @property string $update_time
 * @property string $update_user_id
 */
class NotificationFolder extends DTActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return NotificationFolder the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'notification_folder';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name,create_time, create_user_id, update_time, update_user_id', 'required'),
            array('name', 'length', 'max' => 255),
            array('name', 'checkUserUnique'),
            array('create_user_id, update_user_id', 'length', 'max' => 11),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, name, create_time, create_user_id, update_time, update_user_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * checkFolder is unique against user
     */
    public function checkUserUnique() {
        $criteria = new CDbCriteria;
        $criteria->condition = "create_user_id = :user AND name = :name";

        $criteria->params = array(
            ':user' => Yii::app()->user->id,
            ':name' => $this->name,
        );
        if (!$this->isNewRecord) {
            $criteria->addCondition("id <> :id");
            $criteria->params[':id'] = $this->id;
        }

        if (NotificationFolder::model()->find($criteria)) {
            $this->addError("name", "Already exists");
        }
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'notifications' => array(self::HAS_MANY, 'Notifcation', 'folder'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'name' => 'Name',
            'create_time' => 'Create Time',
            'create_user_id' => 'Create User',
            'update_time' => 'Update Time',
            'update_user_id' => 'Update User',
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
        $criteria->compare('name', $this->name, true);
        $criteria->compare('create_time', $this->create_time, true);
        $criteria->compare('create_user_id', $this->create_user_id, true);
        $criteria->compare('update_time', $this->update_time, true);
        $criteria->compare('update_user_id', $this->update_user_id, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }
    /**
     * get User Folder agains its user id
     */
    public function getUserFolders(){
        $criteria = new CDbCriteria;
        $criteria->condition = "create_user_id = :user";

        $criteria->params = array(
            ':user' => Yii::app()->user->id,
        );
        return NotificationFolder::model()->findAll($criteria);
    }

}