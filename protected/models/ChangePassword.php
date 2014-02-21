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

    /*
     * to check weak or strong password
     */

    const WEAK = 0;
    const STRONG = 1;

    /**
     * Declares the validation rules.
     */
    public function rules() {
        return array(
            array('user_password, user_conf_password', 'required'),
            array('old_password', 'compare', 'operator' => '!=',
                'compareAttribute' => 'user_password',
                'message' => "Old and New password should not be same"
            ),
            array('user_conf_password', 'compare', 'compareAttribute' => 'user_password'),
            array('user_password, user_conf_password,old_password', 'safe'),
            array('old_password', 'validateOldPassword'),
            array('user_password', 'passwordStrength', 'strength' => self::STRONG),
        );
    }

    /**
     * Declares customized attribute labels.
     * If not declared here, an attribute would have a label that is
     * the same as its name with the first letter in upper case.
     */
    public function attributeLabels() {
        return array(
            'old_password' => Yii::t('common', 'Old Password', array(), NULL, Yii::app()->controller->currentLang),
            'user_password' => Yii::t('common', 'New Password', array(), NULL, Yii::app()->controller->currentLang),
            'user_conf_password' => Yii::t('common', 'Confirm Password', array(), NULL, Yii::app()->controller->currentLang),
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

    public function passwordStrength($attribute, $params) {
        if ($params['strength'] === self::WEAK)
            $pattern = '/^(?=.*[a-zA-Z0-9]).{5,}$/';
        elseif ($params['strength'] === self::STRONG)
        //$pattern = '/^(?=.*[a-zA-Z](?=.*[a-zA-Z])).{5,}$/';
           $pattern = '/^(?=.*\d.*\d)[0-9 A-Z a-z !@#$%*]{8,}$/';

        if (!preg_match($pattern, $this->$attribute))
            $this->addError($attribute, 'Weak Password ! At least 5 characters.Passowrd can contain both letters and numbers!');
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