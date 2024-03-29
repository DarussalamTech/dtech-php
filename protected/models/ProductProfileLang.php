<?php

/**
 * This is the model class for table "product_profile_lang".
 *
 * The followings are the available columns in table 'product_profile_lang':
 * @property integer $id
 * @property integer $product_profile_id
 * @property string $title
 * @property string $category_name
 * @property string $create_time
 * @property string $create_user_id
 * @property string $update_time
 * @property string $update_user_id
 *
 * The followings are the available model relations:
 * @property ProductProfile $productProfile
 */
class ProductProfileLang extends DTActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return ProductProfileLang the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'product_profile_lang';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('product_profile_id, create_time, create_user_id, update_time, update_user_id', 'required'),
            array('product_profile_id', 'numerical', 'integerOnly' => true),
            array('title', 'length', 'max' => 255),
            array('create_user_id, update_user_id', 'length', 'max' => 11),
            array('lang_id', 'safe'),
            array('lang_id', 'UniqueLanguage'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, product_profile_id, title, create_time, create_user_id, update_time, update_user_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'productProfile' => array(self::BELONGS_TO, 'ProductProfile', 'product_profile_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => Yii::t('model_labels', 'ID', array(), NULL, Yii::app()->controller->currentLang),
            'product_profile_id' => Yii::t('model_labels', 'Product Profile', array(), NULL, Yii::app()->controller->currentLang),
            'title' => Yii::t('model_labels', 'Title', array(), NULL, Yii::app()->controller->currentLang),
            'create_time' => Yii::t('model_labels', 'Create Time', array(), NULL, Yii::app()->controller->currentLang),
            'create_user_id' => Yii::t('model_labels', 'Create User', array(), NULL, Yii::app()->controller->currentLang),
            'update_time' => Yii::t('model_labels', 'Update Time', array(), NULL, Yii::app()->controller->currentLang),
            'update_user_id' => Yii::t('model_labels', 'Update User', array(), NULL, Yii::app()->controller->currentLang),
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
        $criteria->compare('product_profile_id', $this->product_profile_id);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('create_time', $this->create_time, true);
        $criteria->compare('create_user_id', $this->create_user_id, true);
        $criteria->compare('update_time', $this->update_time, true);
        $criteria->compare('update_user_id', $this->update_user_id, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * 
     * @param type $attribute
     * @param type $params
     */
    public function UniqueLanguage($attribute, $params) {
        /** in case while creating new product * */
        $is_error = $this->getLangsLists();
        if ($is_error) {
            $this->addError($attribute, "Language Must be unique");
        }
    }

    /**
     * langs list
     */
    public function getLangsLists() {

        if (!empty($_GET['id'])) {
            $criteria = new CDbCriteria();
            $criteria->select = "lang_id";
            $criteria->addCondition("product_profile_id=" . Yii::app()->request->getQuery('id'));
            $criteria->addCondition("lang_id ='" . $this->lang_id . "'");
            if (!$this->isNewRecord) {

                $criteria->addCondition("id <>" . $this->id);
            }
            $productLang = ProductProfileLang::model()->findAll($criteria);

            if (!empty($productLang)) {
                return true;
            }
        }
        return false;
    }

}