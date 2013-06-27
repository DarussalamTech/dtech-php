<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity {

    private $id;

    public function authenticate() {
        $user = User::model()->find('LOWER(user_email)=?', array(strtolower($this->username)));

        if ($user === null)
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        //else if(!$user->validatePassword($this->password))
        else if (!$user->validatePassword($this->password, $user->user_password))
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        else if ($user->status_id == '2')
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        else {

            $this->id = $user->user_id;
            //$this->username=$user->user_name;
            $this->setState('user_email', $user->user_email);
            $this->setState('name', $user->user_name);
            $this->setState('user_id', $user->user_id);
            $this->setState('role_id', $user->role_id);
            $this->setState('status_id', $user->status_id);
            $this->setState('city_id', $user->city_id);
            $this->setState('site_id', $user->site_id);
            $this->setState('is_active', $user->is_active);

            $this->errorCode = self::ERROR_NONE;
        }
        return $this->errorCode == self::ERROR_NONE;
    }

    /**
     * authicate with social 
     * @return type
     */
    public function authenticateWith() {
        //$this->setState("isSuperAdmin", Yii::app()->user->isSuperAdmin);
        $user = User::model()->find("user_email = '" . $this->username . "'");
        if ($user === null)
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        else if ($user->status_id == '0')
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        else {
            $this->id = $user->user_id;
            $this->setState('user_id', $user->user_id);
            $this->username = $user->user_email;
            echo Yii::app()->user->isSuperuser;
            
            $this->errorCode = self::ERROR_NONE;
        }


        return $this->errorCode == self::ERROR_NONE;
    }

    public function getId() {
        return $this->id;
    }

}