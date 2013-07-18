<?php

/**
 * This is the model class for table "categories_lang".
 *
 * The followings are the available columns in table 'categories_lang':
 * @property integer $id
 * @property integer $category_id
 * @property string $category_name
 * @property string $lang_id
 * @property string $create_time
 * @property string $create_user_id
 * @property string $update_time
 * @property string $update_user_id
 *
 * The followings are the available model relations:
 * @property Categories $category
 */
class CategoriesLang extends DTActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return CategoriesLang the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'categories_lang';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('category_id, create_time, create_user_id, update_time, update_user_id', 'required'),
            array('category_id', 'numerical', 'integerOnly' => true),
            array('category_name', 'length', 'max' => 255),
            array('create_user_id, update_user_id', 'length', 'max' => 11),
            array('lang_id', 'UniqueLanguage'),
            array('lang_id', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, category_id, category_name, create_time, create_user_id, update_time, update_user_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'category' => array(self::BELONGS_TO, 'Categories', 'category_id'),
            'categoryview' => array(self::BELONGS_TO, 'CategoriesView', 'category_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => Yii::t('model_labels', 'ID', array(), NULL, Yii::app()->controller->currentLang),
            'category_id' => Yii::t('model_labels', 'Category', array(), NULL, Yii::app()->controller->currentLang),
            'category_name' => Yii::t('model_labels', 'Category Name', array(), NULL, Yii::app()->controller->currentLang),
            'lang_id' => Yii::t('model_labels', 'Language', array(), NULL, Yii::app()->controller->currentLang),
            'create_time' => Yii::t('model_labels', 'Create Time', array(), NULL, Yii::app()->controller->currentLang),
            'create_user_id' => Yii::t('model_labels', 'Create User', array(), NULL, Yii::app()->controller->currentLang),
            'update_time' => Yii::t('model_labels', 'Update Time', array(), NULL, Yii::app()->controller->currentLang),
            'update_user_id' => Yii::t('model_labels', 'Update User', array(), NULL, Yii::app()->controller->currentLang),
        );
    }

    /**
     * 
     * @param type $attribute
     * @param type $params
     */
    public function UniqueLanguage($attribute, $params) {
        /** in case while creating new product * */
        $languages = array();

        $total_childs = array();
        if (isset($_POST['CategoriesLang'])) {
            $total_childs = $_POST['CategoriesLang'];
            foreach ($_POST['CategoriesLang'] as $pFile) {
                $languages[] = $pFile['lang_id'];
            }
        }

        $languages = array_unique($languages);


        if (count($languages) > 0 && count($total_childs) != count($languages)) {

            $this->addError($attribute, "Language Must be unique");
        }

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
            $criteria->addCondition("category_id=" . Yii::app()->request->getQuery('id'));
            $criteria->addCondition("lang_id ='" . $this->lang_id . "'");
            if (!$this->isNewRecord) {

                $criteria->addCondition("id <>" . $this->id);
            }
            $categories = CategoriesLang::model()->findAll($criteria);

            if (!empty($categories)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Behaviour
     *
     */
    public function behaviors() {
        return array(
            'CSaveRelationsBehavior' => array(
                'class' => 'CSaveRelationsBehavior',
                'relations' => array(
                    'basicFeatures' => array("message" => "Please, fill required fields"),
                ),
            ),
            'CMultipleRecords' => array(
                'class' => 'CMultipleRecords'
            ),
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
        $criteria->compare('category_id', $this->category_id);
        $criteria->compare('category_name', $this->category_name, true);
        $criteria->compare('create_time', $this->create_time, true);
        $criteria->compare('create_user_id', $this->create_user_id, true);
        $criteria->compare('update_time', $this->update_time, true);
        $criteria->compare('update_user_id', $this->update_user_id, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}