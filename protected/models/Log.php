<?php

/**
 * This is the model class for table "log".
 *
 * The followings are the available columns in table 'log':
 * @property integer $id
 * @property string $ip
 * @property string $browser
 * @property string $url
 * @property string $line
 * @property string $file
 * @property string $robots_txt_rule
 * @property string $htaccess_rule
 * @property string $message
 * @property string $type
 * @property string $trace
 * @property string $create_time
 * @property string $create_user_id
 * @property string $update_time
 * @property string $update_user_id
 */
class Log extends DTActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Log the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'log';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('ip, browser, url, create_time, create_user_id, update_time, update_user_id', 'required'),
            array('ip', 'length', 'max' => 20),
            array('browser, url', 'length', 'max' => 255),
            array('line, type', 'length', 'max' => 15),
            array('file', 'length', 'max' => 100),
            array('robots_txt_rule, htaccess_rule', 'length', 'max' => 300),
            array('message', 'length', 'max' => 200),
            array('create_user_id, update_user_id', 'length', 'max' => 11),
            array('trace', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, ip, browser, url, line, file, robots_txt_rule, htaccess_rule, message, type, trace, create_time, create_user_id, update_time, update_user_id', 'safe', 'on' => 'search'),
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
            'id' => 'ID',
            'ip' => 'Ip',
            'browser' => 'Browser',
            'url' => 'Url',
            'line' => 'Line',
            'file' => 'File',
            'robots_txt_rule' => 'Robots Txt Rule',
            'htaccess_rule' => 'Htaccess Rule',
            'message' => 'Message',
            'type' => 'Type',
            'trace' => 'Trace',
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
        $criteria->compare('ip', $this->ip, true);
        $criteria->compare('browser', $this->browser, true);
        $criteria->compare('url', $this->url, true);
        $criteria->compare('line', $this->line, true);
        $criteria->compare('file', $this->file, true);
        $criteria->compare('robots_txt_rule', $this->robots_txt_rule, true);
        $criteria->compare('htaccess_rule', $this->htaccess_rule, true);
        $criteria->compare('message', $this->message, true);
        $criteria->compare('type', $this->type, true);
        $criteria->compare('trace', $this->trace, true);
        $criteria->compare('create_time', $this->create_time, true);
        $criteria->compare('create_user_id', $this->create_user_id, true);
        $criteria->compare('update_time', $this->update_time, true);
        $criteria->compare('update_user_id', $this->update_user_id, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}