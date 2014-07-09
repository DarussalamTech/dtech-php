<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class DashBoardController extends Controller {

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            // 'accessControl', // perform access control for CRUD operations
            'rights',
            'https + index + view + update + create',
        );
    }

    public function allowedActions() {
        return '@';
    }

    public function beforeAction($action) {
        Yii::app()->theme = "abound";
       
        parent::beforeAction($action);
        unset(Yii::app()->clientScript->scriptMap['jquery.js']);
        $operations = array('index',);
        parent::setPermissions($this->id, $operations);

        return true;
    }
    /**
     * Dashbaord action call  from here
     */
    public function actionIndex() {
        $this->render("index");
    }

}

?>
