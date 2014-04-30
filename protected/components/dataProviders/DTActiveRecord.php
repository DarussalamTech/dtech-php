<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ItstActiveRecord
 *
 * @author Brain
 */
class DTActiveRecord extends CActiveRecord {

    //put your code here
    /**
     * Prepares attributes before performing validation.
     * create_time,
     * create_user_id,
     * update_time
     * update_user_id
     */
    public $_action;
    public $_controller;
    public $_no_condition = false;
    public $_current_module, $isAdmin;

    public function __construct($scenario = 'insert') {

        /**
         * for only web application
         */
        if (php_sapi_name() != "cli") {
            $this->_action = isset(Yii::app()->controller->action->id) ? Yii::app()->controller->action->id : "";
            $this->_controller = Yii::app()->controller->id;
            $this->_current_module = get_class(Yii::app()->controller->getModule());
            /**
             * setting of admin site is running from model
             */
            $this->isAdmin = Yii::app()->controller->isAdminSite;
        }
        parent::__construct($scenario);
    }

    public function afterFind() {
        if (php_sapi_name() != "cli" && isset(Yii::app()->controller->action->id)) {
            $this->_action = Yii::app()->controller->action->id;
            /**
             * setting of admin site is running from model
             */
            $this->isAdmin = Yii::app()->controller->isAdminSite;
        }

        $this->attributes = $this->decodeArray($this->attributes);
        parent::afterFind();
    }

    protected function beforeValidate() {

        if (php_sapi_name() != "cli") {
            $this->_action = Yii::app()->controller->action->id;

            if ($this->isNewRecord) {

                // set the create date, last updated date and the user doing the creating
                $this->create_time = $this->update_time = date("Y-m-d H:i:s"); //new CDbExpression('NOW()');
                $this->create_user_id = $this->update_user_id = Yii::app()->user->id;
                // $this->users_id=1;//$this->update_user_id=Yii::app()->user->id;
            } else {
                //not a new record, so just set the last updated time and last updated user id
                $this->update_time = new CDbExpression('NOW()');
                $this->update_user_id = Yii::app()->user->id;
                // $this->users_id=1;
            }
        }


        /**
          special conidtion 
         * in case of use php cli
         */
        if (!isset(Yii::app()->user->id) || php_sapi_name() =="Cli") {
            $this->create_user_id = 1;
            $this->update_user_id = 1;
            $this->create_time = new CDbExpression('NOW()');
            $this->update_time = new CDbExpression('NOW()');
        }
        parent::beforeValidate();
        $this->attributes = $this->decodeArray($this->attributes);
        return true;
    }

    /**
     *  will 
     *  be used 
     * during before save
     * @return boolean 
     */
    protected function beforeSave() {

        $update_time = date("Y-m-d") . " " . date("H:i:s");

        if ($this->_controller != "product" && $this->_action == "viewImage") {
            $this->attributes = CHtml::encodeArray($this->attributes);
        }
        parent::beforeSave();

        return true;
    }

    /**
     *
     * @return <array>
     */
    public function behaviors() {
        parent::behaviors();

        return array(
            'CMultipleRecords' => array(
                'class' => 'CMultipleRecords'
            ),
        );
    }

    /**
     *  will be used to deltee
     *  mark as dleted
     */
    public function markDeleted() {
        $this->updateByPk($this->primaryKey, array('deleted' => "1"));
    }

    public function getOrder() {
        $criteria = new CDbCriteria;
        $criteria->order = "t.order DESC";
        $criteria->select = "t.order";
        $orderM = $this->find($criteria);

        $this->order = $orderM->order + 1;
    }

    public function setUuid($length = 20) {
        $connection = Yii::app()->db;

        $command = $connection->createCommand("SELECT SUBSTRING(UUID(),1,$length) as uuid");
        $row = $command->queryRow();
        return $row['uuid'];
    }

    /*
     * method to decode an array 
     * removing special characters and slashes....
     */

    private function decodeArray($data) {
        $d = array();
        /**
         * not keys
         */
        $not_keys = array("product_description", "product_overview");

        foreach ($data as $key => $value) {
            if (is_string($key))
                $key = stripslashes(htmlspecialchars_decode($key, ENT_QUOTES));
            if (is_string($value))
                $value = stripslashes(htmlspecialchars_decode($value, ENT_QUOTES));
            else if (is_array($value))
                $value = self::decodeArray($value);
            /*
             * IF condition is for arabic and internatational data handling 
             * 
             * and the else part is for local data entry for system
             */

            if (is_string($value) && mb_detect_encoding($value) == "UTF-8" && !in_array($key, $not_keys)) {

                $d[$key] = $this->_current_module == "WebModule" ? utf8_decode($value) : $value;
            } else {
                $d[$key] = $value;
            }
        }

        return $d;
    }

    /**
     * 
     * @param type $condition
     * @param type $params
     */
    public function find($condition = '', $params = array()) {
        if (is_object($condition)) {
            $condition = $this->makeCriteriaCityAdmin($condition);
        } else if (is_string($condition)) {
            $condition.= $this->makeCityAdminCondition($condition);
        }
        return parent::find($condition, $params);
    }

    public function findByPk($pk, $condition = '', $params = array()) {
        if (is_object($condition)) {
            $condition = $this->makeCriteriaCityAdmin($condition);
        } else if (is_string($condition)) {
            $condition.= $this->makeCityAdminCondition($condition);
        }
        return parent::findByPk($pk, $condition, $params);
    }

    /**
     *  the only reason
     *  dats y i made this function
     *  some time i dun need city id
     * @param type $pk
     * @param type $condition
     * @param type $params
     * @return type
     */
    public function findFromPrimerkey($pk, $condition = '', $params = array()) {
        return parent::findByPk($pk, $condition, $params);
    }
    /**
     * 
     * @param type $condition
     * @param type $params
     * @return type
     */
    public function findAll($condition = '', $params = array()) {
        if (is_object($condition)) {
            $condition = $this->makeCriteriaCityAdmin($condition);
        } else if (is_string($condition)) {
            $condition.= $this->makeCityAdminCondition($condition);
        }

        return parent::findAll($condition, $params);
    }
    /**
     * alternate function of find all
     * will help us to get all records
     * without any city id condition
     * @param type $condition
     */
    public function getAll($condition = ''){
        return parent::findAll($condition);
    }
    /**
     * alternate function of find all
     * will help us to get all records
     * without any city id condition
     * @param type $condition
     * @param type $params
     */
    public function get($condition = '', $params = array()){
        return parent::find($condition, $params);
    }
    /**
     * alternate function 
     * @param type $pk
     * @param type $condition
     * @param array $params
     * @return type
     */
    public function getByPk($pk,$condition, $params = array()){
        return parent::findByPk($pk,$condition, $params = array());
    }
    /**
     * over rided function of to make city condition
     * is available
     * @param type $attributes
     * @param type $condition
     * @param type $params
     * @return type
     */
    public function findByAttributes($attributes, $condition = '', $params = array()) {
        if (is_object($condition)) {
            $condition = $this->makeCriteriaCityAdmin($condition);
        } else if (is_string($condition)) {
            $condition.= $this->makeCityAdminCondition($condition);
        }
        return parent::findByAttributes($attributes, $condition, $params);
    }

    /**
     *  for city admin we have to access only city base record
     */
    public function makeCityAdminCondition($condition) {
        /**
         * 
         */
        if (php_sapi_name() == "cli") {
            return "";
        }
        /**
         * PCM special condition
         * for city model it is temporary
         * bcoz it will take problem city id 
         * is primary key of City model
         */
        if (get_class($this) == "City") {
            return empty($condition) ? " 1=1 " : " AND 1=1 ";
        }
        $controller = Yii::app()->controller->id;
        $controllers = array(
            "site",
            "wS", "error",
            "commonSystem",
            "assignment",
            "import",
            "authItem",
            "install"
        );

        $actions = array("login","loginAdmin", "logout", "mailer", "sendEmailinvitation", "storehome", "activate", "index");

        if (!in_array($controller, $controllers) && !in_array($this->_action, $actions) && !empty(Yii::app()->session['city_id'])) {

            $city_id = isset(Yii::app()->session['city_id']) ? Yii::app()->session['city_id'] : $_REQUEST['city_id'];

            if (!Yii::app()->user->isSuperuser && array_key_exists('city_id', $this->attributes)) {
                if (!empty($condition)) {
                    return " AND  t.city_id ='" . $city_id . "'  ";
                }
                return "   t.city_id ='" . Yii::app()->session['city_id'] . "'  ";
            }
        }
        return empty($condition) ? " 1=1 " : " AND 1=1 ";
    }

    /**
     * Make criteria base condition
     * @return string
     */
    public function makeCriteriaCityAdmin($criteria) {
        if (php_sapi_name() == "cli") {
            return "";
        }
        /**
         * PCM special condition
         * for city model it is temporary
         * bcoz it will take problem city id 
         * is primary key of City model
         */
        if (get_class($this) == "City") {
            return $criteria;
        }
        $controller = Yii::app()->controller->id;

        $controllers = array("site", "wS",
            "error",
            "import",
            "user",
            "commonSystem", "assignment",
            "authItem",
            "install");
        $actions = array("login","loginAdmin", "mailer", "sendEmailinvitation", "logout", "storehome", "activate", "index"); // apply the criteria to all dtActiveRec execpt these methods..Ub



        if (!in_array($controller, $controllers) && !in_array($this->_action, $actions) && !empty(Yii::app()->session['city_id'])) {

            $city_id = isset(Yii::app()->session['city_id']) ? Yii::app()->session['city_id'] : $_REQUEST['city_id'];
            if (!Yii::app()->user->isSuperuser && array_key_exists('city_id', $this->attributes)) {
                $criteria->addCondition("t.city_id ='" . $city_id . "'");
            }
        }
        return $criteria;
    }

    /**
     * attach behaviour for our own logic
     */
    public function attachCbehavour() {
        $this->attachBehavior('ml', array(
            'class' => 'MultilingualBehavior',
            'langClassName' => 'CategoriesLang',
            'langTableName' => 'categories_lang',
            'langForeignKey' => 'category_id',
            //'langField' => 'lang_id',
            'localizedAttributes' => array('category_name'), //attributes of the model to be translated
            'localizedPrefix' => '',
            'languages' => Yii::app()->params['translatedLanguages'], // array of your translated languages. Example : array('fr' => 'Français', 'en' => 'English')
            'defaultLanguage' => Yii::app()->params['defaultLanguage'], //your main language. Example : 'fr'
                //'createScenario' => 'insert',
                //'localizedRelation' => 'postLangs',
                //'multilangRelation' => 'multilangPost',
                //'forceOverwrite' => false,
                //'forceDelete' => true, 
                //'dynamicLangClass' => true, //Set to true if you don't want to create a 'PostLang.php' in your models folder
        ));

        return $this;
    }

    /**
     * update elements
     * will be inherit and save the attribute
     * with respect to new time
     * @param type $pk
     * @param type $attributes
     * @param type $condition
     * @param type $params
     */
    public function updateByPk($pk, $attributes, $condition = '', $params = array()) {
        $updateAttr = array("update_time" => new CDbExpression('NOW()'), "update_user_id" => Yii::app()->user->id);
        $attributes = array_merge($attributes, $updateAttr);


        parent::updateByPk($pk, $attributes, $condition, $params);
        return true;
    }

    /**
     * get Relations name
     * against the codes
     */
    public function getRelationNames() {
        $relations = array();
        foreach ($this->relations() as $key => $rel) {
            $relations[$key] = $key;
        }

        return $relations;
    }

}

?>
