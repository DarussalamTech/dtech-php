<?php

/**
 * This is the model class for table "product_profile".
 *
 * The followings are the available columns in table 'product_profile':
 * @property integer $id
 * @property integer $product_id
 * Used for Education Toys
 */
class EducationToys extends DTActiveRecord {

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
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('price', 'required'),
            array('product_id,attribute,attribute_value', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('attribute,attribute_value', 'safe', 'on' => 'search'),
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
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        $relations = array(
            'product' => array(self::BELONGS_TO, 'Product', 'product_id'),
            'orderDetails' => array(self::HAS_MANY, 'OrderDetail', 'product_profile_id'),
            'productImages' => array(self::HAS_MANY, 'ProductImage', 'product_profile_id', 'order' => 'is_default DESC'),
        );

        return array_merge(parent::relations(), $relations);
    }

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
        if ($this->isNewRecord) {

            $criteria = new CDbCriteria();
            $criteria->select = 'MAX(id) AS id';
            $obj = $this->find($criteria);

            $last_product_id = $obj['id'] + 1;
            $city_name = substr(Yii::app()->session['city_short_name'], 0, 2);

            $parent_category_name = substr(Categories::model()->findByPk($this->product->parent_cateogry_id)->category_name, 0, 1);
            $gen_code = strtoupper($city_name) . $parent_category_name . '-' . $last_product_id;
            $this->item_code = $gen_code;
        }
    }

}