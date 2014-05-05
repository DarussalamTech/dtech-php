<?php

/**
 * make product avaialbe to members of city admin
 * 
 */
class ProductAvailableTo extends CFormModel {

    public $message,$to_city,$template_product_id;

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
            'message' => Yii::t('common', 'Message', array(), NULL, Yii::app()->controller->currentLang),
        );
    }

}

?>
