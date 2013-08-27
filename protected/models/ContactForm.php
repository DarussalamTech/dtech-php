<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class ContactForm extends CFormModel {

    public $name;
    public $email;
    public $subject;
    public $body;
    public $verifyCode;

    /**
     * Declares the validation rules.
     */
    public function rules() {
        return array(
            // name, email, subject and body are required
            array('name, email, subject, body,verifyCode', 'required'),
            // email has to be a valid email address
            array('email', 'email'),
            // verifyCode needs to be entered correctly
            array('verifyCode', 'captcha', 'allowEmpty' => !CCaptcha::checkRequirements()),
        );
    }

    /**
     * Declares customized attribute labels.
     * If not declared here, an attribute would have a label that is
     * the same as its name with the first letter in upper case.
     */
    public function attributeLabels() {
        return array(
            'name' => Yii::t('common', 'Name', array(), NULL, Yii::app()->controller->currentLang),
            'email' => Yii::t('common', 'Email', array(), NULL, Yii::app()->controller->currentLang),
            'subject' => Yii::t('model_labels', 'Subject', array(), NULL, Yii::app()->controller->currentLang),
            'body' => Yii::t('model_labels', 'Message', array(), NULL, Yii::app()->controller->currentLang),
            'verifyCode' => Yii::t('model_labels', 'Verification Code', array(), NULL, Yii::app()->controller->currentLang),
        );
    }

}