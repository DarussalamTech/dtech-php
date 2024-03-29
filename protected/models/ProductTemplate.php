<?php

/**
 * @author  ali abbas<ali.abbas@darussalampk.com>
 * @abstract to create for Super Admin Product Template
 */
class ProductTemplate extends Product {

  
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
            array('parent_cateogry_id,product_name, city_id, is_featured,universal_name', 'required'),
            array('create_time,create_user_id,update_time,update_user_id', 'required'),
            array('product_id,authors,product_rating', 'safe'),
            array('parent_cateogry_id,no_image,authors,product_description,product_overview', 'safe'),
            array('city_id', 'numerical', 'integerOnly' => true),
            array('product_name', 'length', 'max' => 255),
            array('is_featured', 'length', 'max' => 1),
            array("universal_name",'validateUniqueUniversalCode'),
            array("status", "safe"),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('product_id, product_name,product_description, city_id, is_featured', 'safe', 'on' => 'search'),
        );
    }
    /**
     * 
     * @return type
     */
    public function relations() {
        $relations = parent::relations();
        $relations['productTemplateProfile'] = array(self::HAS_MANY, 'ProductTemplateProfile', 'product_id');
        $relations['productTemplatesChilderns'] = array(self::HAS_MANY, 'ProductTemplate', 'parent_id');
       
        return $relations;
    }
    /**
     * validate universal code
     * while super admin cannot able to insert duplicate
     * codes
     */
    public function validateUniqueUniversalCode(){
        $criteria = new CDbCriteria;
        $criteria->condition = "universal_name = :universal_name";
        $criteria->params = array(":universal_name"=>$this->universal_name);
        if(!$this->isNewRecord){
            $criteria->condition.= " AND product_id <> :product_id";
            $criteria->params [':product_id'] = $this->product_id;
        }
        if($this->count($criteria)>=1){
            $this->addError("universal_name","this product is already exists");
        }
    }

}

?>
