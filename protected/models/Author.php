<?php

/**
 * This is the model class for table "author".
 *
 * The followings are the available columns in table 'author':
 * @property integer $author_id
 * @property string $author_name
 * @property string $user_order
 *
 * The followings are the available model relations:
 * @property ProductProfile $author
 */
class Author extends DTActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Author the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'author';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('author_name', 'required'),
            array('create_time,create_user_id,update_time,update_user_id', 'required'),
            array('author_name', 'length', 'max' => 255),
            array('user_order', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('author_id, author_name', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'author' => array(self::BELONGS_TO, 'ProductProfile', 'author_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'author_id' => Yii::t('model_labels', 'Author', array(), NULL, Yii::app()->controller->currentLang),
            'author_name' => Yii::t('model_labels', 'Author Name', array(), NULL, Yii::app()->controller->currentLang),
            'user_order' => Yii::t('model_labels', 'Order', array(), NULL, Yii::app()->controller->currentLang),
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

        $criteria->compare('author_id', $this->author_id);
        $criteria->compare('author_name', $this->author_name, true);
        $criteria->compare('user_order', $this->user_order, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 40,
            ),
        ));
    }

}