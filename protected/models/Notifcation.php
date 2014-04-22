<?php

/**
 * This is the model class for table "notifcation".
 *
 * The followings are the available columns in table 'notifcation':
 * @property integer $id
 * @property string $from
 * @property string $to
 * @property string $type
 * @property integer $folder
 * @property integer $subject
 * @property integer $body
 * @property integer $attachment
 * @property integer $related_to
 * @property integer $related_id
 * @property integer $email_sent
 * @property integer $is_read
 * @property string $create_time
 * @property string $create_user_id
 * @property string $update_time
 * @property string $update_user_id
 */
class Notifcation extends DTActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Notifcation the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'notifcation';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('from,to,subject, create_time, create_user_id, update_time, update_user_id', 'required'),
            array('folder', 'numerical', 'integerOnly' => true),
            array('from, create_user_id, update_user_id', 'length', 'max' => 11),
            array('to', 'length', 'max' => 255),
            array('to', 'validateEmailTo'),
            array('type', 'length', 'max' => 5),
            array('email_sent,related_id,related_to,subject,body,attachment','safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, from, to, type, folder,subject,body,attachment, create_time, create_user_id, update_time, update_user_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'from_rel' => array(self::BELONGS_TO, 'User', 'from'),
            'folder_rel' => array(self::BELONGS_TO, 'NotificationFolder', 'folder'),
        );
    }
    /**
     * validate email 
     */
    public function validateEmailTo(){
        $explode = explode(",",$this->to);
        foreach($explode as $email){
            $email_validate = new CEmailValidator();
            if(!$email_validate->validateValue($email)){
                $this->addError("to", "One or more email is not valid");
            }
        }
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'from' => 'From',
            'to' => 'To',
            'type' => 'Message',
            'folder' => 'Folder',
            'subject' => 'Subject',
            'attachment' => 'Attachment',
            'body' => 'Body',
            'related_id' => 'Related',
            'related_to' => 'Related To',
            'email_sent' => 'Send as email',
            'is_read' => 'Viewed',
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
        $criteria->compare('t.from', $this->from,true);
        $criteria->compare('t.to', $this->to, true);
        $criteria->compare('t.type', $this->type, true);
        $criteria->compare('folder', $this->folder);
        $criteria->compare('subject', $this->subject);
        $criteria->compare('body', $this->body);
        $criteria->compare('attachment', $this->attachment);
        $criteria->compare('related_id', $this->related_id);
        $criteria->compare('related_to', $this->related_to);
        $criteria->compare('email_sent', $this->email_sent);
        $criteria->compare('is_read', $this->is_read);
        $criteria->compare('create_time', $this->create_time, true);
        $criteria->compare('create_user_id', $this->create_user_id, true);
        $criteria->compare('update_time', $this->update_time, true);
        $criteria->compare('update_user_id', $this->update_user_id, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }
    /**
     * save to user inbox
     * which are involved in this process
     * @param type $model
     */
    public function saveToUserInbox(){
        $user_arr = explode(",",$this->to);
        
        foreach($user_arr as $user_email){
           
            $user = User::model()->get('user_email = "'.$user_email.'"');
            $notify = new Notifcation;
            $notify->attributes = $this->attributes;
           
            
            $notify->type = "inbox";
          
            $notify->save();
            
        }
        return true;
    }

}