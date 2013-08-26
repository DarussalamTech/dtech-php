<?php

/**
 * 
 * Slider Settings
 * 
 */
class SliderSetting extends CFormModel {

    public $time;


    /**
     * Declares the validation rules.
     */
    public function rules() {
        return array(
           
            array('time', 'required'),
            array('time', 'numerical', 'integerOnly' => true),
               
        );
    }

    /**
     * Declares customized attribute labels.
     * If not declared here, an attribute would have a label that is
     * the same as its name with the first letter in upper case.
     */
    public function attributeLabels() {
        return array(
            'time' => Yii::t('common', 'Time Interval (in Seconds)', array(), NULL, Yii::app()->controller->currentLang),

        );
    }

}