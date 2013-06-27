<?php

/**
 * cfrom model to validate the 
 * comments of wordpress module
 */
class WpComment extends CFormModel {

    public $wp_user_name;
    public $wp_user_email;
    public $wp_comment;
   

    /**
     * Declares the validation rules.
     */
    public function rules() {
        return array(
            array('wp_user_name, wp_user_email ,wp_comment', 'required'),
            array('wp_user_email', 'email'),
            array('wp_user_name, wp_user_email,wp_comment', 'safe'),
        );
    }

    /**
     * Declares customized attribute labels.
     * If not declared here, an attribute would have a label that is
     * the same as its name with the first letter in upper case.
     */
    public function attributeLabels() {
        return array(
            'wp_user_name' => 'Your Name',
            'wp_user_email' => 'Email',
            'wp_comment' => 'Comments',
        );
    }

}