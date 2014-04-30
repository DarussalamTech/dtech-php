<?php

/**
 * Model for Product Template Profile
 */
class ProductTemplateProfile extends ProductProfile {

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('price,language_id,weight,weight_unit', 'required'),
        );
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
        return 'product_profile';
    }

    /**
     * 
     * @return type
     */
    public function relations() {
        $relations = parent::relations();
        $relations['productTemplate'] = array(self::BELONGS_TO, 'ProductTemplate', 'product_id');

        return $relations;
    }

}

?>
