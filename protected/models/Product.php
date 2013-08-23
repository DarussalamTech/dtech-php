<?php

/**
 * This is the model class for table "product".
 *
 * The followings are the available columns in table 'product':
 * @property integer $product_id
 * @property string $product_name
 * @property integer $city_id
 * @property string $is_featured
 * @property string $product_price
 * @property string $parent_cateogry_id
 *
 * The followings are the available model relations:
 * @property Cart[] $carts
 * @property OrderDetail[] $orderDetails
 * @property ProductDiscount $discount
 * @property City $city
 * @property ProductCategories[] $productCategories
 * @property ProductImage[] $productImages
 * @property ProductProfile $productProfile
 */
class Product extends DTActiveRecord {

    public $no_image;
    public $max_product_id, $slider_link, $slider_remove_link;

    public function __construct($scenario = 'insert') {
        $this->no_image = Yii::app()->baseUrl . "/images/product_images/noimages.jpeg";
        parent::__construct($scenario);
    }

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Product the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'product';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('parent_cateogry_id,product_name, city_id, is_featured', 'required'),
            array('create_time,create_user_id,update_time,update_user_id', 'required'),
            array('authors', 'safe'),
            array('discount_type,discount_type,parent_cateogry_id,no_image,authors,product_description,product_overview', 'safe'),
            array('slag', 'safe'),
            array('city_id', 'numerical', 'integerOnly' => true),
            array('product_name', 'length', 'max' => 255),
            array('is_featured', 'length', 'max' => 1),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('product_id, product_name,product_description, city_id, is_featured', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {

        $lang_id = isset($_POST['lang_id']) ? $_POST['lang_id'] : '1';
        $profile_id = isset($_REQUEST['profile_id']) ? $_REQUEST['profile_id'] : '1';
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'slider' => array(self::HAS_ONE, 'Slider', 'product_id'),
            'carts' => array(self::HAS_MANY, 'Cart', 'product_id'),
            'discount' => array(self::HAS_MANY, 'ProductDiscount', 'product_id'),
            'city' => array(self::BELONGS_TO, 'City', 'city_id'),
            'parent_category' => array(self::BELONGS_TO, 'Categories', 'parent_cateogry_id'),
            'productCategories' => array(self::HAS_MANY, 'ProductCategories', 'product_id'),
            'categories' => array(self::MANY_MANY, 'Categories', 'product_categories(product_id, product_category_id)'),
            'productProfile' => array(self::HAS_MANY, 'ProductProfile', 'product_id'),
            'quranProfile' => array(self::HAS_MANY, 'Quran', 'product_id'),
            'other' => array(self::HAS_MANY, 'Other', 'product_id'),
            'educationToys' => array(self::HAS_MANY, 'EducationToys', 'product_id'),
            /**
             * only for ajax views
             */
            'productSelectedProfile' => array(self::HAS_MANY, 'ProductProfile', 'product_id', 'condition' => 'language_id=' . $lang_id),
            'productloadProfile' => array(self::HAS_MANY, 'ProductProfile', 'product_id', 'condition' => 'id =' . $profile_id),
            'product_reviews' => array(self::HAS_MANY, 'ProductReviews', 'product_id'),
            'author' => array(self::BELONGS_TO, 'Author', 'authors'),
            'language' => array(self::BELONGS_TO, 'Language', 'languages'),
            'productlangs' => array(self::HAS_MANY, 'ProductLang', 'product_id'),
        );
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
            'DTMultiLangBehaviour' => array(
                'class' => 'DTMultiLangBehaviour',
                'langClassName' => 'ProductLang',
                'relation' => 'productlangs',
                'langTableName' => 'product_lang',
                'langForeignKey' => 'product_id',
                'localizedAttributes' => array('product_name', 'product_description', 'product_overview'), //attributes of the model to be translated
                'localizedPrefix' => '',
                'languages' => Yii::app()->params['translatedLanguages'], // array of your translated languages. Example : array('fr' => 'Français', 'en' => 'English')
                'defaultLanguage' => Yii::app()->params['defaultLanguage'], //your main language. Example : 'fr'
            ),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'product_id' => Yii::t('model_labels', 'Product', array(), NULL, Yii::app()->controller->currentLang),
            'product_name' => Yii::t('model_labels', 'Product Name', array(), NULL, Yii::app()->controller->currentLang),
            'parent_cateogry_id' => Yii::t('model_labels', 'Parent Category', array(), NULL, Yii::app()->controller->currentLang),
            '_parent_category' => Yii::t('model_labels', 'Category', array(), NULL, Yii::app()->controller->currentLang),
            'product_description' => Yii::t('model_labels', 'Product Description', array(), NULL, Yii::app()->controller->currentLang),
            'product_overview' => Yii::t('model_labels', 'Product Overview', array(), NULL, Yii::app()->controller->currentLang),
            'city_id' => Yii::t('model_labels', 'City', array(), NULL, Yii::app()->controller->currentLang),
            'authors' => Yii::t('model_labels', 'Author', array(), NULL, Yii::app()->controller->currentLang),
            'is_featured' => Yii::t('model_labels', 'Is Featured', array(), NULL, Yii::app()->controller->currentLang),
            'slag' => Yii::t('model_labels', 'Slag', array(), NULL, Yii::app()->controller->currentLang),
        );
    }

    /**
     *  get relavent product info
     * @param type $limit
     * @return type #
     */
    public function allProducts($product_array = array(), $limit = 30, $parent_category = "Books", $category = "") {


        /**
         * all parent categories 
         * will be here
         */
        $parent_categories = array_keys(Yii::app()->controller->menu_categories);
        $city_id = Yii::app()->session['city_id'];

        /**
         * for search we will provide the list of product
         */
        if (!empty($product_array)) {


            $criteria = new CDbCriteria(array(
                'select' => '*',
                'limit' => $limit,
                'order' => 't.product_id DESC',
                    //'with'=>'commentCount' 
            ));
            $criteria->addInCondition('t.product_id', $product_array);
        } else {
            $criteria = new CDbCriteria(array(
                'select' => '*',
                'condition' => "t.city_id='" . $city_id . "' ",
                'limit' => $limit,
                'order' => 't.product_id DESC',
                    //'with'=>'commentCount' 
            ));


            /**
             * that should only be book
             */
            if ($category != "") {

                $category = explode("-", $category);
                if (in_array($category[count($category) - 1], $parent_categories)) {
                    $criteria->addCondition('t.parent_cateogry_id = ' . $category[count($category) - 1]);
                } else {

                    /**
                     * it could be the  ajax scanario 
                     */
                    $criteria->join.= ' LEFT JOIN product_categories  ON ' .
                            't.product_id=product_categories.product_id';
                    $criteria->addCondition('product_categories.category_id= ' . $category[count($category) - 1]);
                }
            } else if (!isset($_POST['ajax'])) {
                $parent_cat = Categories::model()->getParentCategoryId($parent_category);
                $criteria->addCondition('parent_cateogry_id = ' . $parent_cat);
            }
        }


        /**
         * ajax based filtering
         */
        if (isset($_POST['ajax'])) {


            if (!empty($_POST['author'])) {
                $author = explode(",", $_POST['author']);
                $criteria->addInCondition("authors", $author);
            }
            if (!empty($_POST['langs'])) {
                $langs = explode(",", $_POST['langs']);
                $criteria->join.= ' INNER JOIN product_profile  ' .
                        ' ON product_profile.product_id = t.product_id';

                $criteria->addInCondition("product_profile.language_id", $langs);
            }
            if (!empty($_POST['cat_id'])) {
                $criteria->addCondition('parent_cateogry_id = ' . $_POST['cat_id']);
            }
            if (!empty($_POST['categories'])) {
                $categories = explode(",", $_POST['categories']);

                $criteria->addInCondition("product_categories.category_id", $categories);
            }
            $criteria->distinct = "t.product_id";
        }
        /**
         * 
         */
        if (!empty($_GET['category'])) {
            $criteria->join.= ' LEFT JOIN product_categories  ON ' .
                    't.product_id=product_categories.product_id';
            $criteria->addCondition("product_categories.category_id='" . $_GET['category'] . "'");
        }

        /**
         * get category from slug
         */
        $dataProvider = new DTActiveDataProvider($this, array(
            'pagination' => array(
                'pageSize' => 12,
            ),
            'criteria' => $criteria,
        ));

        return $dataProvider;
    }

    /**
     * return all products
     */
    public function returnProducts($dataProvider) {
        $all_pro = array();
        $data = $dataProvider->getData();

        foreach ($data as $products) {

            $criteria = new CDbCriteria;
            $criteria->select = 'id,product_profile_id,image_small,image_large,is_default';  // only select the 'title' column
            $criteria->condition = "product_profile_id='" . $products->productProfile[0]->id . "'";

            $criteria->addCondition("(is_default =0 OR is_default=1)");
            $criteria->order = "is_default DESC";

            $imagedata = ProductImage::model()->find($criteria);

            $images = array();

            if ($imagedata->is_default == 1) {
                $images[] = array('id' => $imagedata->id,
                    'image_large' => $imagedata->image_url['image_large'],
                    'image_small' => $imagedata->image_url['image_small'],
                );
            } else {
                $images[] = array('id' => $imagedata->id,
                    'image_large' => $imagedata->image_url['image_large'],
                    'image_small' => $imagedata->image_url['image_small'],
                );
            }


            $all_pro[] = array(
                'product_id' => $products->product_id,
                'no_image' => $products->no_image,
                'city_id' => $products->city_id,
                'slug' => $products->slag,
                'category' => $products->parent_category->category_name,
                'city_short' => $products->city->short_name,
                'country_short' => $products->city->country->short_name,
                'product_name' => $products->product_name,
                'product_overview' => $products->product_overview,
                'product_description' => $products->product_description,
                'product_price' => $products->productProfile[0]->price,
                'product_profile_id' => $products->productProfile[0]->id,
                'quantity' => $products->productProfile[0]->quantity,
                'author' => $products->getAuthors(),
                'image' => $images
            );
        }


        return $all_pro;
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('product_id', $this->product_id);
        $criteria->compare('parent_cateogry_id', $this->parent_cateogry_id);
        $criteria->compare('product_name', $this->product_name, true);
        $criteria->compare('product_description', $this->product_description, true);
        $criteria->compare('city_id', $this->city_id);
        $criteria->compare('is_featured', $this->is_featured, true);
        $criteria->compare('slag', $this->slag, true);


        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => array(
                    'product_id' => true,
                ),
            ),
            'pagination' => array(
                'pageSize' => 40,
            ),
        ));
    }

    /**
     *  get author info against book
     */
    public function getAuthors() {
        if (empty($this->authors)) {
            return array();
        }
        $authors = explode(",", $this->authors);

        $criteria = new CDbCriteria();
        $criteria->addInCondition("author_id", $authors);
        $criteria->select = "author_id,author_name";

        return CHtml::listData(Author::model()->findAll($criteria), "author_id", "author_name");
    }

    /**
     * get books languages
     */
    public function getBookLanguages() {


        $criteria = new CDbCriteria();

        $criteria->addCondition("t.product_id=" . $this->product_id);
        $criteria->select = "t.language_id,language.language_name";
        $criteria->join = "INNER JOIN language ON language.language_id =t.language_id";

        return CHtml::listData(ProductProfile::model()->findAll($criteria), "language_id", "language_name");
    }

    /**
     * slag filling
     */
    public function beforeSave() {
        $this->saveSlug();
        parent::beforeSave();
        return true;
    }

    /**
     * setting slug
     * for url
     */
    public function afterFind() {
        $this->setSlug();
        $this->setSlider();
        parent::afterFind();
    }

    /**
     * setting slug
     * for url
     */
    public function setSlug() {
        $module = Yii::app()->controller->getModule();
        if ($this->_controller == "site" || get_class($module) == "WebModule") {
            $this->slag = trim($this->slag) . "-" . $this->primaryKey;
            $this->slag = str_replace(" ", "-", $this->slag);
            $this->slag = str_replace(Yii::app()->params['notallowdCharactorsUrl'], '', $this->slag);
        }
    }

    /**
     * set slider link 
     * for administration
     */
    public function setSlider() {
        if ($this->isAdmin) {
            if (empty($this->slider)) {
                $this->slider_link = CHtml::link("Slider", Yii::app()->controller->createUrl("/product/createSlider", array("id" => $this->product_id)), array("onclick" => "dtech.openColorBox(this)"));
            } else {
                $this->slider_link = CHtml::link("Update Slider", Yii::app()->controller->createUrl("/product/createSlider", array("id" => $this->product_id)), array("onclick" => "dtech.openColorBox(this)"));
                $this->slider_remove_link = CHtml::link("Remove", Yii::app()->controller->createUrl("/product/removeSlider", array("id" => $this->slider->id)), array("onclick" => "dtech.removeSlider(this);return false;"));
            }
        }
    }

    /**
     * setting slug
     * for url
     */
    public function saveSlug() {
        if (!empty($this->slag)) {
            $this->slag = str_replace(" ", "-", $this->slag);
        } else {
            $this->slag = str_replace(" ", "-", $this->product_name);
        }
    }

}