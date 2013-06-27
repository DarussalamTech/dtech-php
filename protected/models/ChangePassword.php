<?php

/**
 * chagne password class using for change user password 
 * it is called from user controller in change password action
 */
class ChangePassword extends CFormModel {

    public $old_password;
    public $_user_name;
    public $user_password;
    public $user_conf_password;

    /**
     * Declares the validation rules.
     */
    public function rules() {
        return array(
            array('user_password, user_conf_password', 'required'),
            array('old_password', 'compare','operator'=>'!=', 
                'compareAttribute' => 'user_password',
                'message'=>"Old and New password should not be same"
                ),
            array('user_conf_password', 'compare', 'compareAttribute' => 'user_password'),
            array('user_password, user_conf_password,old_password', 'safe'),
            array('old_password', 'validateOldPassword'),
        );
    }

    /**
     * Declares customized attribute labels.
     * If not declared here, an attribute would have a label that is
     * the same as its name with the first letter in upper case.
     */
    public function attributeLabels() {
        return array(
            'old_password' => 'Old Password',
            'user_password' => 'New Password',
            'user_conf_password' => 'Confirm Password',
        );
    }

    /**
     *  validate old password from db
     * @param type $password
     * @return boolean
     */
    public function validateOldPassword($attribute, $params) {

        if (User::model()->count("user_id=" . Yii::app()->user->id . " AND user_password='" . md5($this->old_password) . "'") == 0) {
            $this->addError($attribute, "Old password Miss match");
        }
    }

    /**
     *  update password of the current user based on user id
     * @param type $user_password
     * @return boolean
     */
    public function updatePassword() {
        if (User::model()->updateByPk(Yii::app()->user->id, array('user_password' => md5($this->user_password)))) {
            Yii::app()->user->setFlash('changPass', 'YOur Password has been  Changed  ');
            return true;
        }
        return false;
    }

}