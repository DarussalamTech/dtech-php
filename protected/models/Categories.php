<?php

/**
 * This is the model class for table "categories".
 *
 * The followings are the available columns in table 'categories':
 * @property integer $category_id
 * @property string $category_name
 * @property string $added_date
 * @property integer $parent_id
 * @property integer $city_id
 *
 * The followings are the available model relations:
 * @property City $city
 * @property ProductCategories[] $productCategories
 */
class Categories extends DTActiveRecord {

    public $totalStock;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Categories the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'categories';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('category_name,parent_id, added_date, city_id', 'required'),
            array('category_name', 'uniqueCategory'),
            //array('category_name','unique'),
            array('create_time,create_user_id,update_time,update_user_id', 'required'),
            array('parent_id, city_id', 'numerical', 'integerOnly' => true),
            array('category_name, added_date', 'length', 'max' => 255),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('category_id, category_name, added_date, parent_id, city_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * 
     */
    public function uniqueCategory($attribute, $param) {
        $criteria = new CDbCriteria();
        $criteria->addCondition("category_name ='" . $this->$attribute . "'");
        $criteria->addCondition("city_id = " . $this->city_id);
        if (!$this->isNewRecord) {
            $criteria->addCondition("category_id !='" . $this->category_id . "'");
        }

        if ($this->find($criteria)) {
            $this->addError($attribute, "Category already exist");
        }
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'getparent' => array(self::BELONGS_TO, 'Categories', 'parent_id'),
            'childs' => array(self::HAS_MANY, 'Categories', 'parent_id', 'order' => 'categories_id ASC'),
            'city' => array(self::BELONGS_TO, 'City', 'city_id'),
            'productCategories' => array(self::HAS_MANY, 'ProductCategories', 'category_id'),
            'catlangs' => array(self::HAS_MANY, 'CategoriesLang', 'category_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'category_id' => 'Category',
            'category_name' => 'Category Name',
            'added_date' => 'Added Date',
            'parent_id' => 'Parent',
            'city_id' => 'City',
        );
    }

    /**
     * 
     * @return type
     */
    public function allCategories($type = "", $parent_cat = 0) {
        $city_id = isset(Yii::app()->session['city_id']) ? Yii::app()->session['city_id'] : $_REQUEST['city_id'];

        $criteriaC = new CDbCriteria(array(
            'select' => "COUNT(product_category_id ) as totalStock,t.category_id,t.category_name",
            'group' => 't.category_id',
            //'limit' => 14,
            'condition' => "t.city_id=" . $city_id . " AND product.city_id=" . $city_id, //parent id = 0 means category that is parent by itself.show only parent category in list
            'order' => 'totalStock DESC',
        ));
        /**
         * in case of featured product
         */
        if ($type == "featured") {
            $criteriaC->addCondition("product.is_featured = '1'");
        } else if ($type == "bestselling") {
            $criteriaC->addInCondition("product.product_id", $this->getOderedProducts());
        }

        /**
         * handling parent_category to for books , toys
         */
        if ($parent_cat != 0) {
            $criteriaC->addCondition("t.parent_id=" . $parent_cat);
        }
        $cate = $this->with(array('productCategories' => array("select" => ""), 'productCategories.product' => array('alias' => 'product', 'joinType' => "INNER JOIN ", "select" => "")))->findAll($criteriaC);

        return $cate;
    }

    /**
     * get the array in keys segments
     * for footer of pages
     * @return type
     */
    public function getCategoriesInSegment($offset = 5) {
        $cats_temp = $this->allCategories();
        $cats = array();
        foreach ($cats_temp as $keycat => $cat) {
            $cats[$cat->category_id] = $cat->category_name;
        }
        $cats = array_chunk($cats, $offset, true);
        return $cats;
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('category_id', $this->category_id);
        $criteria->compare('category_name', $this->category_name, true);
        $criteria->compare('added_date', $this->added_date, true);
        $criteria->compare('parent_id', $this->parent_id);
        $criteria->compare('city_id', $this->city_id);
        /**
         * if flag for parent then only will be parent
         */
        if ($this->parent_id != '0') {
            $criteria->addCondition("parent_id <> 0");
        } else {
           
            $criteria->addCondition("parent_id = 0");
           
            $criteria->compare('city_id', Yii::app()->request->getQuery("city_id"), true);
        }
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 40,
            ),
        ));
    }

    /**
     * ordered product 
     * to see handle the category count
     * @return type
     */
    public function getOderedProducts() {
        $connection = Yii::app()->db;
        $sql = "SELECT " .
                " DISTINCT(product_profile.product_id) " .
                " FROM product_profile " .
                " INNER JOIN order_detail " .
                " ON order_detail.product_profile_id = product_profile.id ";
        $command = $connection->createCommand($sql);
        $row = $command->queryColumn();
        return $row;
    }

    /**
     * 
     * get books by category for web service
     */
    public function getAllCategoriesForWebService() {

        $criteriaC = new CDbCriteria(array(
            'select' => "t.category_id,t.category_name",
            'group' => 't.category_id',
            'order' => 't.category_name ASC',
        ));
        $cate = $this->with(array('productCategories' => array("select" => ""), 'productCategories.product' => array('alias' => 'product', 'joinType' => "INNER JOIN ", "select" => "")))->findAll($criteriaC);
        return $cate;
    }

    /**
     * 
     * @param type $cat_name
     * we having the categry
     */
    public function getParentCategoryId($cat_name) {
        $criteria = new CDbCriteria();
        $criteria->addCondition("category_name = '" . $cat_name . "'");
        $criteria->select = "category_id";

        $category = $this->find($criteria);
        return $category->category_id;
    }

    /**
     * retreving parent category for current city
     * 
     */
    public function getParentCategories() {
        $crtitera = new CDbCriteria();
        $city_id = isset(Yii::app()->session['city_id']) ? Yii::app()->session['city_id'] : $_REQUEST['city_id'];
        $crtitera->addCondition("parent_id = 0 AND city_id = " . $city_id);
        $crtitera->select = "category_id,category_name";
        $categories = CHtml::listData($this->findAll($crtitera), "category_id", "category_name");

        return $categories;
    }

    /**
     * 
     * @param type $parent_id
     * @param type $name
     * @param type $order
     * @param type $limit
     * @return type
     * 
     * return cateogores for menes
     * cateogry
     */
    public function getchildrenCategory($parent_id = 0, $name = "", $order = "ASC", $limit = 2) {
        $parent_id = ($name != "") ? $this->getParentCategoryId($name) : $parent_id;
        $criteria = new CDbCriteria();

        $criteria->addCondition("parent_id = " . $parent_id);
        $criteria->select = "category_name,category_id";
        $criteria->limit = $limit;

        $criteria->order = "category_id " . $order;
        $categories = $this->findAll($criteria);
        return $categories;
    }

}
