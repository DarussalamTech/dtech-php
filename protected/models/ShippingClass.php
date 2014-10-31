<?php

/**
 * This is the model class for table "shipping_class".
 *
 * The followings are the available columns in table 'shipping_class':
 * @property integer $id
 * @property integer $source_city
 * @property integer $destination_city
 * @property string $title
 * @property double $fix_shipping_cost
 * @property double $price_range_shipping_cost
 * @property double $weight_range_shipping_cost
 * @property integer $is_fix_shpping
 * @property integer $is_pirce_range
 * @property integer $is_weight_based
 * @property double $start_price
 * @property double $end_price
 * @property integer $min_weight_id
 * @property integer $max_weight_id
 * @property string $categories
 * @property string $class_status
 * @property string $create_time
 * @property string $create_user_id
 * @property string $update_time
 * @property string $update_user_id
 */
class ShippingClass extends DTActiveRecord {

    /**
     * this is var 
     * for testing the site whether is posted 
     * and retrieveing db
     * @var type 
     */
    public $is_post_find, $is_no_selected;
    public $_shipping_cost, $_shipping_range;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return ShippingClass the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'shipping_class';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {

        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('categories,source_city, destination_city, title, min_weight_id, max_weight_id, categories, create_time, create_user_id, update_time, update_user_id', 'required'),
            array('source_city, destination_city, is_fix_shpping, is_pirce_range, min_weight_id, max_weight_id', 'numerical', 'integerOnly' => true),
            array('is_fix_shpping,is_weight_based,is_pirce_range', 'numerical'),
            array('is_fix_shpping,is_weight_based,is_pirce_range', 'validateIfNoShipType'),
            array('start_price,end_price', 'numerical', 'integerOnly' => FALSE),
            array('min_weight_id,max_weight_id', 'numerical', 'integerOnly' => FALSE),
            array('price_range_shipping_cost,weight_range_shipping_cost,fix_shipping_cost',
                'numerical', 'integerOnly' => FALSE),
            array('fix_shipping_cost', 'validateShippingFixScanario'),
            array('start_price,end_price,price_range_shipping_cost', 'validateShippingRangeScanario'),
            array('min_weight_id,max_weight_id,weight_range_shipping_cost', 'validateShippingWeightScanario'),
            array('class_status', 'numerical'),
            array('title, categories', 'length', 'max' => 255),
            array('create_user_id, update_user_id', 'length', 'max' => 11),
            array('is_post_find', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, source_city, destination_city, title, fix_shipping_cost, is_fix_shpping, is_pirce_range, start_price, end_price, min_weight_id, max_weight_id, categories, create_time, create_user_id, update_time, update_user_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     *  validating shipping scanrio
     */
    public function validateShippingFixScanario() {
        if ($this->is_fix_shpping == 1 && $this->fix_shipping_cost == "") {
            $this->addError("fix_shipping_cost", "Error");
        }
    }

    /**
     *  validating shipping scanrio
     */
    public function validateShippingRangeScanario() {
        if ($this->is_pirce_range == 1) {
            if ($this->start_price == "") {
                $this->addError("start_price", "Error");
            }
            if ($this->end_price == "") {
                $this->addError("end_price", "Error");
            }
            if ($this->price_range_shipping_cost == "") {
                $this->addError("price_range_shipping_cost", "Error");
            }

            if ($this->start_price >= $this->end_price) {
                $this->addError("start_price", "start price should be less than");
            }
        }
    }

    /**
     *  validating shipping scanrio
     */
    public function validateShippingWeightScanario() {
        if ($this->is_weight_based == 1) {
            if ($this->min_weight_id == "") {
                $this->addError("min_weight_id", "Error");
            }
            if ($this->max_weight_id == "") {
                $this->addError("max_weight_id", "Error");
            }
            if ($this->weight_range_shipping_cost == "") {
                $this->addError("weight_range_shipping_cost", "Error");
            }
            if ($this->min_weight_id >= $this->max_weight_id) {
                $this->addError("max_weight_id", "Min Weight should be less than");
            }
        }
    }

    /**
     * Becaause there is 
     * on way is compulsory either its
     * fix shipping
     * or weight based
     * price range so we need to validate
     * one condition atlease
     */
    public function validateIfNoShipType($attribute) {
        if ($this->is_fix_shpping == 0 && $this->is_pirce_range == 0 && $this->is_weight_based == 0) {
            $this->addError($attribute, "atleast Fix price, price range or weight range is compulsory");
            // $this->addError("is_pirce_range", "atleast one is compulsory");
            // $this->addError("is_weight_based", "atleast one is compulsory");

            $this->is_no_selected = 1;
        } else {
            $this->is_no_selected = 0;
        }
    }

    /**
     * 
     */
    public function beforeValidate() {
        $this->is_post_find = 1;

        return parent::beforeValidate();
    }

    /**
     * 
     */
    public function afterValidate() {

        return parent::afterValidate();
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'source_city_rel' => array(self::BELONGS_TO, 'City', 'source_city'),
            'dest_city_rel' => array(self::BELONGS_TO, 'City', 'destination_city'),
            //'is_pirce_range' => array(self::BELONGS_TO, 'City', 'destination_city'),

        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'source_city' => 'Source City',
            'destination_city' => 'Dest City',
            'title' => 'Title',
            'fix_shipping_cost' => 'Shipping Price',
            'is_fix_shpping' => 'Fix based',
            'is_pirce_range' => 'P Range based',
            'is_weight_based' => 'W Range based',
            'start_price' => 'Start Price',
            'end_price' => 'End Price',
            'min_weight_id' => 'Min Weight',
            'max_weight_id' => 'Max Weight',
            '_shipping_range' => 'Price/weight range',
            'categories' => 'Categories',
            'class_status' => 'Status',
            'create_time' => 'Create Time',
            'create_user_id' => 'Create User',
            'update_time' => 'Update Time',
            'update_user_id' => 'Update User',
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
        $criteria->compare('source_city', $this->source_city);
        $criteria->compare('destination_city', $this->destination_city);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('fix_shipping_cost', $this->fix_shipping_cost);
        $criteria->compare('is_fix_shpping', $this->is_fix_shpping);
        $criteria->compare('is_pirce_range', $this->is_pirce_range);
        $criteria->compare('start_price', $this->start_price);
        $criteria->compare('end_price', $this->end_price);
        $criteria->compare('min_weight_id', $this->min_weight_id);
        $criteria->compare('max_weight_id', $this->max_weight_id);
        $criteria->compare('categories', $this->categories, true);
        $criteria->compare('create_time', $this->create_time, true);
        $criteria->compare('create_user_id', $this->create_user_id, true);
        $criteria->compare('update_time', $this->update_time, true);
        $criteria->compare('update_user_id', $this->update_user_id, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * set the value of flag is post and find 1
     * @return type
     */
    public function afterFind() {
        $this->is_post_find = 1;
        $this->categories = explode(",", $this->categories);

        if ($this->is_fix_shpping == 1) {
            $this->_shipping_cost = $this->fix_shipping_cost;
        } else if ($this->is_pirce_range == 1) {
            $this->_shipping_cost = $this->price_range_shipping_cost;
            $this->_shipping_range = $this->start_price . " - " . $this->end_price;
        } else if ($this->is_weight_based == 1) {
            $this->_shipping_cost = $this->weight_range_shipping_cost;
            $this->_shipping_range = $this->min_weight_id . " - " . $this->max_weight_id;
        }
        return parent::afterFind();
    }

    /**
     * before save
     * for categories
     * @return type
     */
    public function beforeSave() {
        
        
        $this->categories = !empty($this->categories) && is_array($this->categories) ? implode(",", $this->categories) : $this->categories;
        return parent::beforeSave();
    }

    /**
     * get multienum field
     * categories names against
     * multi enum
     */
    public function getCategoriesNames() {

        if (!empty($this->categories)) {
            $criteria = new CDbCriteria;
            $criteria->select = "category_name";
            $criteria->addInCondition('category_id', $this->categories);
            $categories = CHtml::listData(Categories::model()->findAll($criteria), "category_name", "category_name");

            return implode(",", $categories);
        }
    }

    /**
     * SELECT * FROM shipping_class
      WHERE is_pirce_range =1
      AND source_city = 1
      AND destination_city = 1
      AND categories IN (57)
      AND `end_price` >= 1625 AND `start_price` <= 1625

     * @param type $categories
     * @param type $range
     * @param type $range_type
     *  if destination is same as source
     * @param type $$is_source
     */
    public function calculateShippingCost($categories, $range, $range_type, $is_source = 1) {
        $criteria = new CDbCriteria;
        $criteria->addCondition("source_city =" . Yii::app()->session['city_id']);
        if ($is_source == 1) {
            $criteria->addCondition("destination_city =" . Yii::app()->session['city_id']);
        }
        else {
            $criteria->addCondition("destination_city = 0 ");
        }
        $criteria->compare('categories', implode(",",$categories), true,"AND");
        $criteria->order = 'id DESC';
        if ($range_type == "price") {
            $criteria->addCondition('class_status = 1 AND end_price >= ' . $range . ' AND start_price <= ' . $range);
            $criteria->addCondition("is_pirce_range = 1");
        } else if ($range_type == "weight") {
          
            $criteria->addCondition('class_status = 1 AND max_weight_id >= ' . $range . ' AND min_weight_id <= ' . $range);
            $criteria->addCondition("is_weight_based = 1");
           
        }

        if ($ship_data = $this->find($criteria)) {
            
            if ($range_type == "price")
                return $ship_data->price_range_shipping_cost;
            else if ($range_type == "weight")
                return $ship_data->weight_range_shipping_cost;
            else
                return $ship_data->fix_shipping_cost;
        }
        return 0;
    }
    
    /**
     * This will calculate the total shipping cost in case of "Credit Card" payment method 
     * @param type $shipping_type
     * @param type $total_weight
     * @return type array : this will contain the amount of the shipping(local(PKR) or international($))
     */
    public function calculateShippingCostForCreditCard($shipping_type = 'local',$total_weight)
    {
        $shipping_amount_half_kg_local = 225;//this amount will be in PKR
        $shipping_amount_one_kg_local = 250;//this amount will be in PKR
        $shipping_amount_each_kg_local = 240;//this amount will be in PKR
        
        $shipping_amount_one_kg_international = 20;//this amount will be in US Dollar ($)
        $shipping_amount_each_kg_international = 15;//this amount will be in US Dollar ($)
        
        
        $local_shipping = 0; // this will be in PKR currency
        $international_shipping = 0; // this will be in US dollar currency
        
        if($shipping_type == "local")
        {
            if($total_weight <= 0.5){
                $local_shipping = (double)$shipping_amount_half_kg_local;
            }elseif($total_weight > 0.5 && $total_weight <= 1.0){
                $local_shipping = (double) $shipping_amount_one_kg_local;
            }elseif($total_weight > 1.0){
                $local_shipping = (double)($total_weight * $shipping_amount_each_kg_local);
            }
        }elseif ($shipping_type == "international") {
            if($total_weight <= 1.0){
                $international_shipping = (double) $shipping_amount_one_kg_international;
            }elseif($total_weight > 1.0){
                $international_shipping = (double) ($total_weight * $shipping_amount_each_kg_international);
            } 
        }
        return array("local"=>$local_shipping,"international"=>$international_shipping);
    }

}