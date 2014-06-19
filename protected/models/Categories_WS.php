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
class Categories_WS extends Categories {

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
     * book category model for webservice use
     */
    public function getBookCategory($city_id = 0){
        $criteria = new CDbCriteria;
        $criteria->addCondition("LOWER(category_name) = :category AND parent_id = :parent_id");
        $criteria->params = array("category"=>"book","parent_id"=>0);
        if($city_id!=0){
             $criteria->addCondition("t.city_id :city_id");
             $criteria->params['city_id'] = $city_id;
        }
        
        return $this->get($criteria);
    }
   
}
