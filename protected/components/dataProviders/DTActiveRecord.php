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

    public function __construct($scenario = 'insert') {
        parent::__construct($scenario);
        $this->_action = Yii::app()->controller->action->id;
        $this->_controller = Yii::app()->controller->id;
    }

    public function afterFind() {
        if (isset(Yii::app()->controller->action->id)) {
            $this->_action = Yii::app()->controller->action->id;
        }
        parent::afterFind();
    }

    protected function beforeValidate() {


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
        /**
          special conidtion
         */
        if (empty(Yii::app()->user->id)) {
            $this->create_user_id = 1;
            $this->update_user_id = 1;
        }
        parent::beforeValidate();
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

    public function findAll($condition = '', $params = array()) {
        if (is_object($condition)) {
            $condition = $this->makeCriteriaCityAdmin($condition);
        } else if (is_string($condition)) {
            $condition.= $this->makeCityAdminCondition($condition);
        }

        return parent::findAll($condition, $params);
    }

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

        $controller = Yii::app()->controller->id;
        $controllers = array(
            "search", "site",
            "wS", "error",
            "commonSystem",
            "assignment",
            "authItem",
            "install"
        );

        $actions = array("login", "logout", "storehome", "activate");

        if (!in_array($controller, $controllers) && !in_array($this->_action, $actions) && !empty(Yii::app()->session['city_id'])) {
            $isSuper = Yii::app()->session['isSuper'];
            //$isSuper = 0;

            if ($isSuper != 1 && array_key_exists('city_id', $this->attributes)) {
                if (!empty($condition)) {
                    return " AND  t.city_id ='" . Yii::app()->session['city_id'] . "'  ";
                }
                return "   t.city_id ='" . Yii::app()->session['city_id'] . "'  ";
            }
        }
        return "";
    }

    /**
     * Make criteria base condition
     * @return string
     */
    public function makeCriteriaCityAdmin($criteria) {

        $controller = Yii::app()->controller->id;

        $controllers = array("search", "site", "wS",
            "error",
            "commonSystem", "assignment",
            "authItem",
            "install");
        $actions = array("login", "logout", "storehome", "activate"); // apply the criteria to all dtActiveRec execpt these methods..Ub

        if (!in_array($controller, $controllers) && !in_array($this->_action, $actions) && !empty(Yii::app()->session['city_id'])) {
            $isSuper = Yii::app()->session['isSuper'];
            //$isSuper = 0;
            if ($isSuper != 1 && array_key_exists('city_id', $this->attributes)) {
                $criteria->addCondition("t.city_id ='" . Yii::app()->session['city_id'] . "'");
            }
        }
        return $criteria;
    }

}

?>
