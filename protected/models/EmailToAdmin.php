<?php

/**
 * This model will be use to send email to admi
 */
class EmailToAdmin extends CFormModel {

    public $email;

    /**
     * Declares the validation rules.
     */
    public function rules() {
        return array(
            array('email', 'required'),
            array('email', 'email'),
        );
    }

    public function attributeLabels() {
        return array(
            'email' => Yii::t('model_labels', 'Email Address', array(), NULL, Yii::app()->controller->currentLang),
           
        );
    }

}