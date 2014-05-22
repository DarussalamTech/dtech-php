<?php

/**
 * This is the model class for table "product_profile".
 *
 * The followings are the available columns in table 'product_profile':
 * @property integer $id
 * @property integer $product_id
 * @property integer $item_code
 * @property integer $title
 * @property integer $arabic_name
 * @property integer $language_id
 * @property integer $discount_type
 * @property integer $discount_value
 * @property integer $language_id
 * @property integer $quantity
 * @property integer $weight
 * @property string $isbn
 * @property string $price
 * @property string $color
 *
 * The followings are the available model relations:
 * @property Author $author
 * @property Language $language
 * @property Product $profile
 */
class ProductProfile extends DTActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return ProductProfile the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * used to insert and upload images 
     * for every own profile
     * @var type 
     */
    public $upload_index;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'product_profile';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('price,language_id', 'required'),
            array('item_code,isbn', 'unique'),
            /**
             * if item code set to automatic then it wont be requred
             * other wise requried
             */
            array('item_code', Yii::app()->params['auto_item_code'] == 0 ? "required" : "safe"),
            array('create_time,create_user_id,update_time,update_user_id', 'required'),
            array('title,product_id', 'safe'),
            array('id,size,no_of_pages,binding,printing,paper,edition,upload_index', 'safe'),
            array('arabic_name,color,is_shippable,weight,attribute,attribute_value,dimension,translator_id,compiler_id,quantity,slag', 'safe'),
            array('isbn', 'length', 'max' => 255),
            array('price,quantity', 'numerical', 'integerOnly' => FALSE),
            //array('language_id', 'UniqueLanguage'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('profile_id, author_id, isbn', 'safe', 'on' => 'search'),
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
            'cart_products' => array(self::HAS_MANY, 'Cart', 'product_profile_id'),
            'orderDetails' => array(self::HAS_MANY, 'OrderDetail', 'product_profile_id'),
            'productLanguage' => array(self::BELONGS_TO, 'Language', 'language_id'),
            'productImages' => array(self::HAS_MANY, 'ProductImage', 'product_profile_id', 'order' => 'is_default DESC'),
            'productAttributes' => array(self::HAS_MANY, 'ProductAttributes', 'product_profile_id'),
            /**
             * configuration relationship
             */
            'dimension_rel' => array(self::BELONGS_TO, 'ConfProducts', 'dimension', 'condition' => 'type="Dimensions"'),
            'binding_rel' => array(self::BELONGS_TO, 'ConfProducts', 'binding', 'condition' => 'type="Binding"'),
            'printing_rel' => array(self::BELONGS_TO, 'ConfProducts', 'printing', 'condition' => 'type="Printing"'),
            'paper_rel' => array(self::BELONGS_TO, 'ConfProducts', 'paper', 'condition' => 'type="Paper"'),
            'weight_rel' => array(self::BELONGS_TO, 'ConfProducts', 'weight', 'condition' => 'type="weight"'),
            /*
             * relation for compiler and translator table
             */
            'translator_rel' => array(self::BELONGS_TO, 'TranslatorCompiler', 'translator_id', 'condition' => 'type="translator"'),
            'compiler_rel' => array(self::BELONGS_TO, 'TranslatorCompiler', 'compiler_id', 'condition' => 'type="compiler"'),
            'productProfilelangs' => array(self::HAS_MANY, 'ProductProfileLang', 'product_profile_id'),
        );
    }

    /**
     * get Relational Column here
     */
    public function relationColumns() {
        return array(
            'dimension' => array("model"=>'ConfProducts', "key"=>'title', 'condition' => 'type="Dimensions"'),
            'binding' => array("model"=>'ConfProducts',  "key"=>'title', 'condition' => 'type="Binding"'),
            'printing' => array("model"=>'ConfProducts',"key"=>'title', 'condition' => 'type="Printing"'),
            'paper' => array("model"=>'ConfProducts',"key"=>'title', 'condition' => 'type="Paper"'),
            'language_id' => array("model"=>'Language',"key"=>'language_name'),
            
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
                'langClassName' => 'ProductProfileLang',
                'relation' => 'productProfilelangs',
                'langTableName' => 'product_profile_lang',
                'langForeignKey' => 'product_profile_id',
                'localizedAttributes' => array('title'), //attributes of the model to be translated
                'localizedPrefix' => '',
                'languages' => Yii::app()->params['translatedLanguages'], // array of your translated languages. Example : array('fr' => 'Français', 'en' => 'English')
                'defaultLanguage' => Yii::app()->params['defaultLanguage'], //your main language. Example : 'fr'
            ),
        );
    }

    /**
     * 
     * @param type $attribute
     * @param type $params
     */
    public function UniqueLanguage($attribute, $params) {
        /** in case while creating new product * */
        if ($this->_controller == "product" && $this->_action == "create") {
            $languages = array();

            $total_childs = array();
            if (isset($_POST['ProductProfile'])) {
                $total_childs = $_POST['ProductProfile'];
                foreach ($_POST['ProductProfile'] as $pFile) {
                    $languages[] = $pFile['language_id'];
                }
            }

            $languages = array_unique($languages);


            if (count($languages) > 0 && count($total_childs) != count($languages)) {

                $this->addError($attribute, "Language Must be unique");
            }
        }
        /**
         * in case creating profiles using product
         */ else if ($this->_controller == "product" && $this->_action == "view") {
            $is_error = $this->getLangsLists();
            if ($is_error) {
                $this->addError($attribute, "Language Must be unique");
            }
        }
    }

    /**
     * langs list
     */
    public function getLangsLists() {



        if (!empty($_GET['id'])) {
            $criteria = new CDbCriteria();
            $criteria->select = "language_id";
            $criteria->addCondition("product_id=" . $_GET['id']);
            $criteria->addCondition("language_id=" . $this->language_id);
            if (!$this->isNewRecord) {

                $criteria->addCondition("id <>" . $this->id);
            }
            $product = ProductProfile::model()->findAll($criteria);
            if (!empty($product)) {
                return true;
            }
        }
        return false;
    }

    public function beforeValidate() {
        return parent::beforeValidate();
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'profile_id' => Yii::t('model_labels', 'Profile', array(), NULL, Yii::app()->controller->currentLang),
            'product_id' => Yii::t('model_labels', 'Product', array(), NULL, Yii::app()->controller->currentLang),
            'item_code' => Yii::t('model_labels', 'Item Code', array(), NULL, Yii::app()->controller->currentLang),
            'isbn' => Yii::t('model_labels', 'ISBN', array(), NULL, Yii::app()->controller->currentLang),
            'price' => Yii::t('model_labels', 'Product Price', array(), NULL, Yii::app()->controller->currentLang),
            'no_of_pages' => Yii::t('model_labels', 'No Of Pages', array(), NULL, Yii::app()->controller->currentLang),
            'binding' => Yii::t('model_labels', 'Binding', array(), NULL, Yii::app()->controller->currentLang),
            'printing' => Yii::t('model_labels', 'Printing', array(), NULL, Yii::app()->controller->currentLang),
            'paper' => Yii::t('model_labels', 'Paper', array(), NULL, Yii::app()->controller->currentLang),
            'dimension' => Yii::t('model_labels', 'Dimension', array(), NULL, Yii::app()->controller->currentLang),
            'size' => Yii::t('model_labels', 'Size', array(), NULL, Yii::app()->controller->currentLang),
            'weight' => Yii::t('model_labels', 'Weight', array(), NULL, Yii::app()->controller->currentLang),
            'language_id' => Yii::t('model_labels', 'Language', array(), NULL, Yii::app()->controller->currentLang),
            'edition' => Yii::t('model_labels', 'Edition', array(), NULL, Yii::app()->controller->currentLang),
            'compiler_id' => Yii::t('model_labels', 'Compiler', array(), NULL, Yii::app()->controller->currentLang),
            'translator_id' => Yii::t('model_labels', 'Translator', array(), NULL, Yii::app()->controller->currentLang),
            'slag' => Yii::t('model_labels', 'Slug', array(), NULL, Yii::app()->controller->currentLang),
            'color' => Yii::t('model_labels', 'Color', array(), NULL, Yii::app()->controller->currentLang),
            'arabic_name' => Yii::t('model_labels', 'Arabic Name', array(), NULL, Yii::app()->controller->currentLang),
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

        $criteria->compare('profile_id', $this->profile_id);
        $criteria->compare('isbn', $this->isbn, true);
        $criteria->compare('no_of_pages', $this->no_of_pages, true);
        $criteria->compare('binding', $this->binding, true);
        $criteria->compare('printing', $this->printing, true);
        $criteria->compare('paper', $this->paper, true);
        $criteria->compare('edition', $this->edition, true);
        $criteria->compare('slag', $this->slag, true);
        $criteria->compare('arabic_name', $this->arabic_name, true);
        $criteria->compare('color', $this->color, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /*
     * before save action
     */

    public function beforeSave() {

        $this->generateItemCode();
        return parent::beforeSave();
    }

    /*
     * method generate item codes base on city
     * in specific formate
     *
     */

    public function generateItemCode() {
        if ($this->isNewRecord && Yii::app()->params['auto_item_code'] == 1) {

            $criteria = new CDbCriteria();
            $criteria->select = 'MAX(id) AS id';
            $obj = $this->find($criteria);

            $last_product_id = $obj['id'] + 1;
            $city_name = substr(Yii::app()->session['city_short_name'], 0, 2);

            $parent_category_name = substr(Categories::model()->findByPk($this->product->parent_cateogry_id)->category_name, 0, 1);
            $gen_code = strtoupper($city_name) . $parent_category_name . '-' . $last_product_id;
            $this->item_code = $gen_code;
        }
        /**
         * if isbn no is empty then 
         * it will be auto matic
         */
        if (empty($this->isbn)) {
            $dt = new DTFunctions();
            $this->isbn = "dt-" . time();
        }
    }

    /**
     * language _name for 
     * @return type
     * when we needed it will work as language
     */
    public function getlanguage_name() {
        return $this->productLanguage->language_name;
    }

    /**
     *  get product images for some code
     * @return type 
     */
    public function getImage() {
        $images = array();
        foreach ($this->productImages as $img) {
            if ($img->is_default == 1) {
                $images[] = array('id' => $img->id,
                    'image_large' => $img->image_url['image_large'],
                    'image_small' => $img->image_url['image_small'],
                    'image_cart' => $img->image_url['image_cart'],
                    'image_detail' => $img->image_url['image_detail'],
                );
                break;
            } else {
                $images[] = array('id' => $img->id,
                    'image_large' => $img->image_url['image_large'],
                    'image_small' => $img->image_url['image_small'],
                    'image_cart' => $img->image_url['image_cart'],
                    'image_detail' => $img->image_url['image_detail'],
                );
                break;
            }
        }

        return $images;
    }

    /**
     * 
     * @return type
     */
    public function afterFind() {
        /**
         * dt- means
         * isbn is 
         */
        if (strstr($this->isbn, "dt-")) {
            $this->isbn = "";
        }
        return parent::afterFind();
    }

    /**
     * setting slug
     * for url
     */
    public function setSlug() {
        $module = Yii::app()->controller->getModule();
        if ($this->_controller == "site" || get_class($module) == "WebModule") {
            $this->slag = $this->slag . "-" . $this->primaryKey;
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
            $this->slag = str_replace(" ", "-", $this->title);
        }
    }

    /**
     * 
     *  Product Profile
     *  stock has been udpated
     * @param type $new_quantity
     * @param type $profile_id
     */
    public function updateStock($new_quantity, $profile_id) {

        $connection = Yii::app()->db;
        $sql = "UPDATE " . $this->tableName() . " t SET t.quantity=t.quantity+" . $new_quantity . " WHERE t.id = " . $profile_id;
        $command = $connection->createCommand($sql);
        $command->execute();
    }

}