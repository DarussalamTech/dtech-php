<?php

/**
 * This is model for system 
 * Initial Page Landing...
 * Country and city selections 
 */
class LandingModel extends CFormModel {

    public $country;
    public $city;
    public $rememeber_me;

    /**
     * Declares the validation rules.
     */
    public function rules() {
        return array(
            array('country, city', 'required'),
            array('rememeber_me', 'safe'),
        );
    }

    /**
     * Declares customized attribute labels.
     * If not declared here, an attribute would have a label that is
     * the same as its name with the first letter in upper case.
     */
    public function attributeLabels() {
        return array(
            'country' => Yii::t('model_labels', 'Country', array(), NULL, Yii::app()->controller->currentLang),
            'city' => Yii::t('model_labels', 'City', array(), NULL, Yii::app()->controller->currentLang),
            'rememeber_me' => 'Remember me', Yii::t('model_labels', 'Remember me', array(), NULL, Yii::app()->controller->currentLang),
        );
    }

}