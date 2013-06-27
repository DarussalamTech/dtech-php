<?php

/**
 * This is the model class for table "product_categories".
 *
 * The followings are the available columns in table 'product_categories':
 * @property integer $product_category_id
 * @property integer $product_id
 * @property integer $category_id
 *
 * The followings are the available model relations:
 * @property Categories $category
 * @property Product $product
 */
class ProductCategories extends DTActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return ProductCategories the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'product_categories';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('category_id', 'required'),
            array('create_time,create_user_id,update_time,update_user_id', 'required'),
            
            array('category_id', 'UniqueCat'),
            array('product_id, category_id', 'numerical', 'integerOnly' => true),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('product_category_id, product_id, category_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * 
     * @param type $attribute
     * @param type $params
     */
    public function UniqueCat($attribute, $params) {
        /** in case while creating new product * */
        if ($this->_controller == "product" && $this->_action == "create") {
            $categories = array();

            $total_childs = array();
            if (isset($_POST['ProductCategories'])) {
                $total_childs = $_POST['ProductCategories'];
                foreach ($_POST['ProductCategories'] as $pFile) {
                    $categories[] = $pFile['category_id'];
                }
            }

            $categories = array_unique($categories);


            if (count($categories) > 0 && count($total_childs) != count($categories)) {

                $this->addError($attribute, "Category Must be unique");
            }
        }
        /**
         * in case creating profiles using product
         */ else if ($this->_controller == "product" && $this->_action == "view") {
            $is_error = $this->getLangsLists();
            if ($is_error) {
                $this->addError($attribute, "Category Must be unique");
            }
        }
    }

    /**
     * cat list
     */
    public function getLangsLists() {



        if (!empty($_GET['id'])) {
            $criteria = new CDbCriteria();
            $criteria->select = "category_id";
            $criteria->addCondition("product_id=" . $_GET['id']);
            $criteria->addCondition("category_id=" . $this->category_id);
            if (!$this->isNewRecord) {

                $criteria->addCondition("id <>" . $this->id);
            }
            $product = ProductCategories::model()->findAll($criteria);
            if (!empty($product)) {
                return true;
            }
        }
        return false;
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'category' => array(self::BELONGS_TO, 'Categories', 'category_id'),
            'product' => array(self::BELONGS_TO, 'Product', 'product_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'product_category_id' => 'Product Category',
            'product_id' => 'Product',
            'category_id' => 'Category',
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

        $criteria->compare('product_category_id', $this->product_category_id);
        $criteria->compare('product_id', $this->product_id);
        $criteria->compare('category_id', $this->category_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}