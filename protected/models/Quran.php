<?php

/**
 * Quran Category for all
 * 
 */
class Quran extends ProductProfile {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return ProductProfile the static model class
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
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        
        $relations =  array(
            'product' => array(self::BELONGS_TO, 'Product', 'product_id'),
            'orderDetails' => array(self::HAS_MANY, 'OrderDetail', 'product_profile_id'),
            'productImages' => array(self::HAS_MANY, 'ProductImage', 'product_profile_id', 'order' => 'is_default DESC'),
        );
        
        return array_merge(parent::relations(),$relations);
    }

}

?>
