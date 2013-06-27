<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class PageController extends Controller {

    //$models=new Pages();

    public function actionViewPage($id) {
        Yii::app()->user->SiteSessions;
        $page = Pages::model()->findByPk($id);
        if ($page->title == "FAQ's") {

            $this->render('//page/faq_page', array('page' => $page));
        } else {

            $this->render('//page/view_page', array('page' => $page));
        }
    }

}

?>
