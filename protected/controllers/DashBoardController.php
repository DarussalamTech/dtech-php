<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class DashBoardController extends Controller {

    public function beforeAction($action) {
        Yii::app()->theme = "abound";
        parent::beforeAction($action);
        unset(Yii::app()->clientScript->scriptMap['jquery.js']);


        return true;
    }
    
    public function actionIndex(){
        $this->render("index");
    }

}

?>
