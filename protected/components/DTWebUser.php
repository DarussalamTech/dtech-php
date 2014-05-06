<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class DTWebUser extends CWebUser {

    private $_user;

    /**
     * when system will login it will help us to navigate to thats
     * city
     * @var type 
     */
    public $userCity;

    //is the user a superadmin ?
    function getIsSuperAdmin() {
        return ( $this->user && $this->user->role_id == User::LEVEL_SUPERADMIN );
    }

    //is the user an administrator ?
    function getIsAdmin() {

        return ( $this->user && $this->user->role_id == User::LEVEL_ADMIN );
    }

    //is user a whole seller
    function getIsWholeSeller() {

        return ($this->user && $this->user->role_id == User::LEVEL_WHOLE_SELLER);
    }

    //is user a customer
    function getIsCustomer() {

        return ($this->user && $this->user->role_id == User::LEVEL_CUSTOMER);
    }
    //is user a customer
    function getWebCity() {

        return City::model()->findByPk(Yii::app()->session['city_id']);
    }

    //get the logged user
    function getUser() {
        if ($this->isGuest)
            return;
        if ($this->_user === null) {
            $this->_user = User::model()->findByPk($this->id);
        }
        return $this->_user;
    }

    /**
     * 
     * @return boolean
     */
    function getIpInfo() {
        $ip = Yii::app()->request->getUserHostAddress();
        $content = @file_get_contents('http://api.hostip.info/?ip=' . $ip);
        if ($content != FALSE) {
            $xml = new SimpleXmlElement($content);
            $location['citystate'] = $xml->children('gml', TRUE)->featureMember->children('', TRUE)->Hostip->children('gml', TRUE)->name;
            $location['country'] = $xml->children('gml', TRUE)->featureMember->children('', TRUE)->Hostip->countryName;
            $location['short_country'] = $xml->children('gml', TRUE)->featureMember->children('', TRUE)->Hostip->countryAbbrev;
            return $location;
        }
        else
            return false;
    }

    function getSiteSessions() {


        $siteUrl = Yii::app()->request->hostInfo . Yii::app()->baseUrl;
        $site_info = SelfSite::model()->getSiteInfo($siteUrl);





        /**
         * When site is not in db
         * and not configured 
         * although it is configured in vhost
         * 
         */
        if ($site_info == 0) {

            Yii::app()->controller->redirect(Yii::app()->createUrl("/error/unconfigured"));
            return true;
        } else if ($site_info['status'] == 0) {
            Yii::app()->controller->redirect(Yii::app()->createUrl("/error/underconstruction"));
            return true;
        }

        /**
         * When is in db
         * and configured
         * It is sure every site
         * has its head office 
         * which is a unique city in all over the world 
         * and in application
         */
        Yii::app()->session['site_id'] = $site_info['site_id'];
        Yii::app()->session['site_headoffice'] = $site_info['site_headoffice'];



        /**
         * when city id in request
         */
        if (!empty($_REQUEST['city_id'])) {

            $cityModel = SelfSite::model()->findCityLocation($_REQUEST['city_id']);

            $this->saveDTSessions($cityModel, $site_info);
        }
        /**
         * when city id in session
         */ else if (!empty(Yii::app()->session['city_id'])) {

            /**
             * Nothing do session is already saved
             */
        }


        /**
         * start from scratch
         * when application is loading first time
         */ else if (!empty($site_info['site_headoffice'])) {
            $cityModel = SelfSite::model()->findCityLocation($site_info['site_headoffice']);


            $this->saveDTSessions($cityModel, $site_info);
        }

        //$this->installSocialConfigs();
    }

    /**
     * save darusslam sessions
     * including theme currency ,city and country
     * @param type $cityModel
     * @param type $site_info
     * @return boolean
     */
    public function saveDTSessions($cityModel, $site_info = array()) {

        
        $theme = SelfSite::model()->findLayout($site_info['site_id']);
        
        Yii::app()->session['layout'] = $theme;
       
        Yii::app()->session['country_short_name'] = $cityModel->country->short_name;
        Yii::app()->session['city_short_name'] = $cityModel->short_name;
        Yii::app()->session['city_id'] = $cityModel->city_id;
        Yii::app()->session['country_id'] = $cityModel->country_id;
        Yii::app()->session['currency'] = $cityModel->currency->symbol;

        Yii::app()->theme = $theme;


        /**
         * Pcm temporary
         */
        /*
          if(Yii::app()->params['theme'] == 'dtech_second'){

          Yii::app()->session['layout'] = Yii::app()->params['theme'];
          Yii::app()->theme = Yii::app()->params['theme'];
          }
         */
        Yii::app()->user->userCity = $cityModel->city_id;
        $_REQUEST['city_id'] = $cityModel->city_id;

        return true;
    }

}

?>
