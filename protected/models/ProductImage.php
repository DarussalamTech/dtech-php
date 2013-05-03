<?php

/**
 * This is the model class for table "product_image".
 *
 * The followings are the available columns in table 'product_image':
 * @property integer $id
 * @property integer $product_id
 * @property string $image_small
 * @property string $is_default
 * @property string $image_large
 *
 * The followings are the available model relations:
 * @property Product $product
 */
class ProductImage extends DTActiveRecord {

    public $upload_key = "";
    public $uploaded_img = "";

    /**
     *
     * @var type 
     * for purpose of deleting old image
     */
    public $oldLargeImg = "";

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return ProductImage the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'product_image';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            //array('product_id, image_small, image_large', 'required'),
            array('product_id', 'numerical', 'integerOnly' => true),
            array('create_time,create_user_id,update_time,update_user_id', 'required'),
            array('oldLargeImg,upload_key,is_default,activity_log', 'safe'),
            array('image_small, image_large', 'length', 'max' => 255),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, product_id, image_small, image_large', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'product' => array(self::BELONGS_TO, 'Product', 'product_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'Product Image',
            'product_id' => 'Product',
            'is_default' => 'Default',
            'image_small' => 'Image Small',
            'image_large' => 'Image Large',
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
        $criteria->compare('product_id', $this->product_id);
        $criteria->compare('image_small', $this->image_small, true);
        $criteria->compare('is_default', $this->is_default, true);
        $criteria->compare('image_large', $this->image_large, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function afterFind() {
        $this->oldLargeImg = $this->image_large;
        parent::afterFind();
    }

    /**
     * for setting object to save
     * image name rather its emtpy
     * @return type 
     */
    public function beforeSave() {
        
        $large_img = DTUploadedFile::getInstance($this, '[' . $this->upload_key . ']image_large');
        $this->image_large = $large_img;
        
        return parent::beforeSave();
    }

    public function afterSave() {

        $large_img = DTUploadedFile::getInstance($this, '[' . $this->upload_key . ']image_large');

        $this->image_large = $large_img;
        $folder_array = array("product", $this->product->primaryKey, "product_images", $this->id);

        $upload_path = DTUploadedFile::creeatRecurSiveDirectories($folder_array);


        $large_img->saveAs($upload_path . $large_img->name);
        $this->deleteldImage();
        parent::afterSave();
        return true;
    }

    /**
     * to delete old image in case of not empty
     * not equal new image
     */
    public function deleteldImage() {

        if (!empty($this->oldLargeImg) && $this->oldLargeImg != $this->image_large) {
            $path = Yii::app()->basePath . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR;
            $path.= "uploads" . DIRECTORY_SEPARATOR . "product" . DIRECTORY_SEPARATOR . $this->product->primaryKey . DIRECTORY_SEPARATOR . "product_images";
            $path.= DIRECTORY_SEPARATOR . $this->id . DIRECTORY_SEPARATOR . $this->oldLargeImg;

            DTUploadedFile::deleteExistingFile($path);
        }
    }
    
    public function beforeDelete() {
        $this->deleteldImage();
        parent::beforeDelete();
    }

}