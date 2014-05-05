<?php

/**
 * make product avaialbe to members of city admin
 * 
 */
class ProductAvailableTo extends CFormModel {

    public $message, $to_city, $template_product_id;

    /**
     * Declares the validation rules.
     */
    public function rules() {
        return array(
            // message
            array('message', 'required'),
            array('to_city,template_product_id', 'safe'),
        );
    }

    /**
     * Declares customized attribute labels.
     * If not declared here, an attribute would have a label that is
     * the same as its name with the first letter in upper case.
     */
    public function attributeLabels() {
        return array(
            'message' => Yii::t('common', 'Message To City Admin', array(), NULL, Yii::app()->controller->currentLang),
        );
    }

    /**
     * send Product Available to to particular city admin
     * and notify him 
     */
    public function makeAvailableTo() {
        $product = ProductTemplate::model()->findFromPrimerkey($this->template_product_id);

        $model = new Product;
        $model->attributes = $product->attributes;
        $model->city_id = $this->to_city;
        $model->parent_id = $this->template_product_id;
        
        //treating model as new thats y this line need to be unset
        unset($model->product_id);

        //finding right parent category for that to transfer with respect to city
        $criteria = new CDbCriteria;
        $criteria->condition = "LOWER(category_name) =:category_name AND city_id =:city_id";
        $criteria->params = array(
            ":category_name" => strtolower($product->parent_category->category_name),
            ":city_id" => $this->to_city
        );
        $criteria->select = "category_id,category_name";
        if ($category = Categories::model()->get($criteria)) {
            $model->parent_cateogry_id = $category->category_id;
        }
        

        if ($model->save()) {
            foreach ($product->productProfile as $productProfile) {
                $pModel = new ProductTemplateProfile;
                $pModel->product_id = $model->product_id;
                $pModel->attributes = $productProfile->attributes;
                
                $pModel->save();
            }
        }
        
        return $model;
       
    }

}

?>
