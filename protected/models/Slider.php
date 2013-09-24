<?php

/**
 * This is the model class for table "slider".
 *
 * The followings are the available columns in table 'slider':
 * @property integer $id
 * @property string $image
 * @property string $title
 * @property integer $product_id
 * @property integer $city_id
 * @property string $create_time
 * @property string $create_user_id
 * @property string $update_time
 * @property string $update_user_id
 */
class Slider extends DTActiveRecord {

    public $product_name,$slider_link;
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Slider the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'slider';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('title,product_id, create_time, create_user_id, update_time, update_user_id', 'required'),
            array('product_id', 'numerical', 'integerOnly' => true),
            array('image', 'file','types'=>'jpg, gif, png', 'allowEmpty'=>true),
            array('image, title', 'length', 'max' => 255),
          
            array('create_user_id, update_user_id', 'length', 'max' => 11),
            array('city_id', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, image,city_id, title, product_id, create_time, create_user_id, update_time, update_user_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
               'slider' => array(self::BELONGS_TO, 'Product', 'product_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'image' => 'Image',
            'title' => 'Title',
            'city_id' => 'City',
            'product_id' => 'Product Name',
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
        $criteria->compare('image', $this->image, true);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('product_id', $this->product_id);
        $criteria->compare('city_id', $this->city_id);
        $criteria->compare('create_time', $this->create_time, true);
        $criteria->compare('create_user_id', $this->create_user_id, true);
        $criteria->compare('update_time', $this->update_time, true);
        $criteria->compare('update_user_id', $this->update_user_id, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }
    /**
     * slider link 
     */
    public function afterFind() {
        if(!empty($this->product)){
            $this->slider_link = CHtml::link("Slider",Yii::app()->controller->createUrl("/product/createSlider",array("id"=>$this->product_id)),
                            array("onclick"=>"dtech.openColorBox(this)"));
        }
        else {
              $this->slider_link = CHtml::link("Update Slider",Yii::app()->controller->createUrl("/product/createSlider",array("id"=>$this->product_id)),
                            array("onclick"=>"dtech.openColorBox(this)"));
        }
        parent::afterFind();
    }

}