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
 * @property integer $category_image
 * @property integer $is_main_featured
 *
 * The followings are the available model relations:
 * @property City $city
 * @property ProductCategories[] $productCategories
 */
class Categories extends DTActiveRecord {

    public $totalStock;
    public $cat_image_url = array();

    /**
     * category slug
     */
    public $slug, $category_slug;
    public $imageUrl = array();

    /**
     * set some good images for parent categories
     * other has to upload
     * @param type $scenario
     */
    public function __construct($scenario = 'insert') {
        $this->imageUrl = array(
            "Books" => Yii::app()->baseUrl . "/themes/dtech_second/images/books.png",
            "Quran" => Yii::app()->baseUrl . "/themes/dtech_second/images/quran.png",
            "Islamic devices" => Yii::app()->baseUrl . "/themes/dtech_second/images/toys.png",
            "Others" => Yii::app()->baseUrl . "/themes/dtech_second/images/other.png",
            "Educational Toys" => Yii::app()->baseUrl . "/themes/dtech_second/images/toys.png",
        );
        parent::__construct($scenario);
    }

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
            array('category_name,parent_id, city_id', 'required'),
            array('category_name', 'uniqueCategory'),
            //array('category_name','unique'),
            array('create_time,create_user_id,update_time,update_user_id', 'required'),
            array('parent_id, city_id', 'numerical', 'integerOnly' => true),
            array('category_name', 'length', 'max' => 255),
            array('user_order,added_date', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('category_id,is_main_featured,slug,category_image', 'safe'),
            array('category_id, category_name, added_date, parent_id, city_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * 
     */
    public function uniqueCategory($attribute, $param) {
        $criteria = new CDbCriteria();
        $criteria->addCondition("category_name ='" . $this->$attribute . "'");
        $criteria->addCondition("city_id = '" . $this->city_id."'");
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

    public function afterFind() {
        if (!empty($this->category_image)) {
            $this->cat_image_url = Yii::app()->baseUrl . "/uploads/parent_category/" . $this->category_id . '/' . $this->category_image;
        } else {

            $this->cat_image_url = isset($this->imageUrl[$this->category_name]) ? $this->imageUrl[$this->category_name] : "";
        }
        $this->slug = str_replace(" ", "-", $this->category_name . "-" . $this->primaryKey);
        $this->slug = str_replace("/", "-", $this->slug);
        $this->slug = MyHelper::convert_no_sign(str_replace(Yii::app()->params['notallowdCharactorsUrl'], '', $this->slug));
        /**
         * category slug for url
         * that will be used in url
         * for going to particular book detail
         */
        $this->category_slug = str_replace(" ", "-", $this->category_name);
        $this->category_slug = MyHelper::convert_no_sign(str_replace(Yii::app()->params['notallowdCharactorsUrl'], '', $this->category_slug));
        parent::afterFind();
    }

    public function behaviors() {

        $setArr = array(
            'CSaveRelationsBehavior' => array(
                'class' => 'CSaveRelationsBehavior',
                'relations' => array(
                    'basicFeatures' => array("message" => "Please, fill required fields"),
                ),
            ),
            'CMultipleRecords' => array(
                'class' => 'CMultipleRecords'
            ),
            'DTMultiLangBehaviour' => array(
                'class' => 'DTMultiLangBehaviour',
                'langClassName' => 'CategoriesLang',
                'relation' => 'catlangs',
                'langTableName' => 'categories_lang',
                'langForeignKey' => 'category_id',
                'localizedAttributes' => array('category_name'), //attributes of the model to be translated
                'localizedPrefix' => '',
                'languages' => Yii::app()->params['translatedLanguages'], // array of your translated languages. Example : array('fr' => 'Français', 'en' => 'English')
                'defaultLanguage' => Yii::app()->params['defaultLanguage'], //your main language. Example : 'fr'
            ),
        );
        return $setArr;
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'category_id' => Yii::t('model_labels', 'Category', array(), NULL, Yii::app()->controller->currentLang),
            'category_name' => Yii::t('model_labels', 'Category Name', array(), NULL, Yii::app()->controller->currentLang),
            'added_date' => Yii::t('model_labels', 'Added Date', array(), NULL, Yii::app()->controller->currentLang),
            'parent_id' => Yii::t('model_labels', 'Parent', array(), NULL, Yii::app()->controller->currentLang),
            'city_id' => Yii::t('model_labels', 'City', array(), NULL, Yii::app()->controller->currentLang),
            'category_image' => Yii::t('model_labels', 'Category Image', array(), NULL, Yii::app()->controller->currentLang),
            'user_order' => Yii::t('model_labels', 'Order', array(), NULL, Yii::app()->controller->currentLang),
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
            'condition' => "t.city_id='" . $city_id . "' AND product.city_id='" . $city_id."'", //parent id = 0 means category that is parent by itself.show only parent category in list
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
        $criteria->compare('user_order', $this->user_order);
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
            'sort' => array('defaultOrder' => "user_order ASC")
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
            'condition' => 't.parent_id=57',
        ));
        $cate = $this->with(array('productCategories' => array("select" => ""), 'productCategories.product' => array('alias' => 'product', 'joinType' => "INNER JOIN ", "select" => "")))->findAll($criteriaC);
        $return_arr = array();
        foreach($cate as $cat){
            $return_arr[]['category_id'] = $cat['category_id'];
            $return_arr[]['category_name'] = $cat['category_name'];
            $return_arr[]['category_slug'] = $cat['slug'];
        }
        return $cate;
    }

    /**
     * 
     * @param type $cat_name
     * @param type $is_city
     * we having the categry
     */
    public function getParentCategoryId($cat_name,$city = "") {
        $criteria = new CDbCriteria();
        $criteria->addCondition("Lower(t.category_name) = '" . strtolower($cat_name) . "'");
        $criteria->select = "category_id";
        
        if($city != ""){
            $criteria->addCondition("city_id =".$city);
        }
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
        $crtitera->addCondition("parent_id = 0 AND city_id = '" . $city_id."'");
        $crtitera->select = "category_id,category_name";
        $crtitera->order = "FIELD(t.category_name ,'Books') DESC";
        $categories = CHtml::listData($this->findAll($crtitera), "category_id", "category_name");

        return $categories;
    }

    /**
     * retreving parent category for current city
     * for menu
     * 
     */
    public function getMenuParentCategories() {
        $crtitera = new CDbCriteria();
        $city_id = isset(Yii::app()->session['city_id']) ? Yii::app()->session['city_id'] : $_REQUEST['city_id'];
        $crtitera->addCondition("parent_id = 0 AND city_id = '" . $city_id."'");
        $crtitera->select = "category_id,category_name,category_image,is_main_featured";
        $crtitera->order = "user_order ASC";
        $categories = $this->findAll($crtitera);

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

        $criteria->order = "t.user_order " . $order;
        $categories = $this->findAll($criteria);
        return $categories;
    }

    /**
     * get parent categories
     * for displaying menu items
     */
    public function getMenuCategories() {
        $paren_categories = Categories::model()->getMenuParentCategories();
        $showCategories = array();
        foreach ($paren_categories as $model) {
            $showCategories[$model->category_id] = array(
                "category_id" => $model->category_id,
                "name" => $model->category_name,
                "is_main_featured" => $model->is_main_featured,
                "slug" => $model->slug,
                "image" => $model->cat_image_url,
            );
            $childrenCats = Categories::model()->getchildrenCategory($model->category_id, "", "", 200);
            if (count($childrenCats) >= 1):
                $showCategories[$model->category_id]['data'] = $childrenCats;
            endif;
        }
        return $showCategories;
    }

    /**
     * saving category lang inot
     * messages table for saving 
     * translation
     */
    public function afterSave() {
        if ($this->category_name != "") {
            $this->saveTranlsation();
        }
        parent::afterSave();
    }

    /**
     * saving translation
     * into the tranlsation message table
     * 
     */
    public function saveTranlsation() {
        $data = Yii::app()->db->createCommand()
                ->select('message ')
                ->from('dt_messages')
                ->where("category = 'product_category' AND message ='{$this->category_name}'")
                ->queryRow();

        if (empty($data)) {
            $message = new DtMessages;
            $message->category = 'product_category';
            $message->message = $this->category_name;
            $message->save();
        }
    }

}
