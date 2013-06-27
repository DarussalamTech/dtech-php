<?php

/**
 * 
 */
class HybridLogin extends CFormModel {

    public $email;

    /**
     * Declares the validation rules.
     */
    public function rules() {
        return array(
            // name, email, subject and body are required
            array('email', 'required'),
            array('email','email'),
            array('email','checkUniqueValid'),

        );
    }
    
    /**
     * get Unique email in db
     * @param type $attribute
     * @param type $params
     */
    public function checkUniqueValid($attribute, $params){
        $user = User::model()->count("user_email = '".$this->$attribute."'");
        if($user>0){
             $this->addError($attribute, "Email Must be unique");
        }
        
    }

}

?>
