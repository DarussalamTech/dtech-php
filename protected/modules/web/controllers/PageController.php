<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class PageController extends Controller {

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            //'https +login+LoginAdmin', // Force https, but only on login pages
            "http +array('ViewPage','pagesPreview')"
        );
    }

    //$models=new Pages();

    public function actionViewPage($id) {
        $id = explode('-',$id);
        $id = $id[count($id)-1];
        Yii::app()->user->SiteSessions;
        $page = Pages::model()->findByPk($id);
        if ($page->title == "FAQ's") {

            $this->render('//page/faq_page', array('page' => $page));
        } else {

            $this->render('//page/view_page', array('page' => $page));
        }
    }

    /**
     * Prview detail
     */
    public function actionpagesPreview($id) {
        Yii::app()->user->SiteSessions;


        try {
            $page = Pages::model()->findByPk($id);
            if ($page->title == "FAQ's") {

                $this->render('//page/faq_page', array('page' => $page));
            } else {

                $this->render('//page/view_page', array('page' => $page));
            }
        } catch (Exception $e) {
            Yii::app()->theme = 'landing_page_theme';
            throw new CHttpException(500, "   Sorry ! Record Not found");
        }
    }

}

?>
