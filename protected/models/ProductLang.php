<?php

/**
 * This is the model class for table "product_lang".
 *
 * The followings are the available columns in table 'product_lang':
 * @property integer $id
 * @property integer $product_id
 * @property string $product_name
 * @property string $product_description
 * @property string $product_overview
 * @property string $lang_id
 * @property string $create_time
 * @property string $create_user_id
 * @property string $update_time
 * @property string $update_user_id
 *
 * The followings are the available model relations:
 * @property Product $product
 */
class ProductLang extends DTActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return ProductLang the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'product_lang';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('product_id, create_time, create_user_id, update_time, update_user_id', 'required'),
            array('product_id', 'numerical', 'integerOnly' => true),
            array('product_name', 'length', 'max' => 255),
            array('lang_id', 'length', 'max' => 6),
            array('lang_id', 'UniqueLanguage'),
            array('create_user_id, update_user_id', 'length', 'max' => 11),
            array('product_description, product_overview', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, product_id, product_name, product_description, product_overview, lang_id, create_time, create_user_id, update_time, update_user_id', 'safe', 'on' => 'search'),
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
            'id' => Yii::t('model_labels', 'ID', array(), NULL, Yii::app()->controller->currentLang),
            'product_id' => Yii::t('model_labels', 'Product', array(), NULL, Yii::app()->controller->currentLang),
            'product_name' => Yii::t('model_labels', 'Product Name', array(), NULL, Yii::app()->controller->currentLang),
            'product_description' => Yii::t('model_labels', 'Product Description', array(), NULL, Yii::app()->controller->currentLang),
            'product_overview' => Yii::t('model_labels', 'Product Overview', array(), NULL, Yii::app()->controller->currentLang),
            'lang_id' => Yii::t('model_labels', 'Language', array(), NULL, Yii::app()->controller->currentLang),
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
        $criteria->compare('product_id', $this->product_id);
        $criteria->compare('product_name', $this->product_name, true);
        $criteria->compare('product_description', $this->product_description, true);
        $criteria->compare('product_overview', $this->product_overview, true);
        $criteria->compare('lang_id', $this->lang_id, true);
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
            $criteria->addCondition("product_id=" . Yii::app()->request->getQuery('id'));
            $criteria->addCondition("lang_id ='" . $this->lang_id . "'");
            if (!$this->isNewRecord) {

                $criteria->addCondition("id <>" . $this->id);
            }
            $productLang = ProductLang::model()->findAll($criteria);

            if (!empty($productLang)) {
                return true;
            }
        }
        return false;
    }

}