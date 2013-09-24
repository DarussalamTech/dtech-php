<?php

/**
 * This is the model class for table "log".
 *
 * The followings are the available columns in table 'log':
 * @property integer $log_id
 * @property string $action
 * @property integer $user_id
 * @property integer $product_id
 * @property string $ip
 * @property string $browser
 * @property string $url
 * @property string $user_name
 * @property string $added_date
 */
class Log extends DTActiveRecord
{

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Log the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'log';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('action, user_id, product_id, ip, browser, url, user_name, added_date', 'required'),
            array('user_id, product_id', 'numerical', 'integerOnly' => true),
            array('create_time,create_user_id,update_time,update_user_id', 'required'),
            
            array('action', 'length', 'max' => 100),
            array('ip', 'length', 'max' => 20),
            array('browser, url, user_name, added_date', 'length', 'max' => 255),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('log_id, action, user_id, product_id, ip, browser, url, user_name, added_date', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'log_id' => 'Log',
            'action' => 'Action',
            'user_id' => 'User',
            'product_id' => 'Product',
            'ip' => 'Ip',
            'browser' => 'Browser',
            'url' => 'Url',
            'user_name' => 'User Name',
            'added_date' => 'Added Date',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('log_id', $this->log_id);
        $criteria->compare('action', $this->action, true);
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('product_id', $this->product_id);
        $criteria->compare('ip', $this->ip, true);
        $criteria->compare('browser', $this->browser, true);
        $criteria->compare('url', $this->url, true);
        $criteria->compare('user_name', $this->user_name, true);
        $criteria->compare('added_date', $this->added_date, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}