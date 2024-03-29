<?php

/**
 * This is the model class for table "city".
 *
 * The followings are the available columns in table 'city':
 * @property integer $city_id
 * @property integer $country_id
 * @property string $city_name
 * @property string $short_name
 * @property string $address
 * @property string $c_status
 * @property integer $layout_id
 *
 * The followings are the available model relations:
 * @property Categories[] $categories
 * @property Layout $layout
 * @property Country $country
 * @property Layout $layout1
 * @property Product[] $products
 */
class City extends DTActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return City the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'city';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('country_id, city_name, short_name, address, layout_id,currency_id', 'required'),
            array('create_time,create_user_id,update_time,update_user_id', 'required'),
            array('city_name', 'unique'),
            array('country_id, layout_id', 'numerical', 'integerOnly' => true),
            array('city_name, short_name, address', 'length', 'max' => 255),
            array('city_id,c_status,currency_id', 'safe'),
            array('api_username,api_password,api_signature', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('city_id, country_id, city_name, short_name, address, layout_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'categories' => array(self::HAS_MANY, 'Categories', 'city_id'),
            'products' => array(self::HAS_MANY, 'Product', 'city_id'),
            'orders' => array(self::HAS_MANY, 'Order', 'city_id'),
            'shippments' => array(self::HAS_MANY, 'ShippingClass', 'source_city'),
            'layout' => array(self::BELONGS_TO, 'Layout', 'layout_id'),
            'country' => array(self::BELONGS_TO, 'Country', 'country_id'),
            'layout1' => array(self::HAS_ONE, 'Layout', 'layout_id'),
            
            'currency' => array(self::BELONGS_TO, 'ConfCurrency', 'currency_id'),
            'site' => array(self::HAS_ONE, 'SelfSite', 'site_headoffice', 'condition' => 'site_headoffice <>0'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'city_id' => Yii::t('model_labels', 'City', array(), NULL, Yii::app()->controller->currentLang),
            'country_id' => Yii::t('model_labels', 'Country', array(), NULL, Yii::app()->controller->currentLang),
            'city_name' => Yii::t('model_labels', 'City Name', array(), NULL, Yii::app()->controller->currentLang),
            'short_name' => Yii::t('model_labels', 'Short Name', array(), NULL, Yii::app()->controller->currentLang),
            'address' => Yii::t('model_labels', 'Address', array(), NULL, Yii::app()->controller->currentLang),
            'layout_id' => Yii::t('model_labels', 'Layout', array(), NULL, Yii::app()->controller->currentLang),
            'currency_id' => Yii::t('model_labels', 'Currency', array(), NULL, Yii::app()->controller->currentLang),
            'c_status' => Yii::t('model_labels', 'Status', array(), NULL, Yii::app()->controller->currentLang),
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

        $criteria->compare('city_id', $this->city_id);
        $criteria->compare('country_id', $this->country_id);
        $criteria->compare('city_name', $this->city_name, true);
        $criteria->compare('short_name', $this->short_name, true);
        $criteria->compare('address', $this->address, true);
        $criteria->compare('layout_id', $this->layout_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * get city id from from city
     * @param type $name
     */
    public function getCityId($name) {
        $criteria = new CDbCriteria;
        $criteria->condition = 'LOWER(t.city_name) = :city_name';
        $criteria->params = array(":city_name" => strtolower($name));

        return City::model()->get($criteria);
    }

    /**
     * get product avaiability for particular city
     * @param type $universal_name
     * @param type $city_id
     * @return type
     */
    public function getProductAvailability($universal_name, $city_id = 0) {
        $criteria = new CDbCriteria;
        $criteria->condition = "city_id = :city_id AND universal_name = :universal_name";
        $criteria->params = array(":universal_name" => $universal_name, "city_id" => $this->city_id);
        if ($product = Product::model()->get($criteria)) {
            $url = Yii::app()->controller->createUrl("/product/view", array("id" => $product->product_id));
            $image = CHtml::image(Yii::app()->baseUrl . "/images/enable.png");
            return CHtml::link($image . " Already Available", $url, array("class" => "link_btn"));
        } else {
            //adding access control for this 
            if (Yii::app()->controller->checkViewAccess("Product.CreateFromTemplate")) {
                $url = Yii::app()->controller->createUrl("/product/createFromTemplate", array("id" => Yii::app()->request->getQuery("id"), "to_city" => $city_id));
                return CHtml::link("Make Available", $url, array('class' => " print_link_btn"), array("height" => "400", "width" => "600"));
            }
        }
    }

    /**
     * 
     * @param type $universal_name
     *   product universal name
     *   under this product template
     */
    public function getAvailableCities($universal_name) {
        $criteria = new CDbCriteria;
        $criteria->addCondition("universal_name= :universal_name AND city_id <> :city_id");
        $criteria->params = array(
            ':universal_name' => $universal_name,
            ':city_id' => $this->getCityId("Super")->city_id,
        );
        $criteria->distinct = "city_id";
        $products = ProductTemplate::model()->getAll($criteria);
        $cities = array();
        foreach($products as $product){
            $cities[$product->city->city_name] = $product->city->city_name;
        }
        
        return implode(", ",$cities);
    }

}