<?php

/*
 * to handle error from all the system
 */

class ErrorController extends Controller {
    
    public function beforeAction($action) {
        Yii::app()->theme = 'landing_page_theme';
        Yii::app()->controller->layout = '';
        return parent::beforeAction($action);
    }

    public function actionError() {
        $error = Yii::app()->errorHandler->error;
        if ($error)
            $this->render('error', array('error' => $error));
        else
            throw new CHttpException(404, 'Page not found.');
    }

    public function actionUnconfigured() {
        $this->layout = '';
        $error['message'] = " Site is not configured , please contact Darussalam admin!";
        if ($error)
            $this->renderPartial('error', array('error' => $error));
        else
            throw new CHttpException(404, 'Page not found.');
    }

    /*
     * Error message for No Frenchise/ store in current country
     */

    public function actionNoFrenchise() {
         Yii::app()->controller->layout = "";
        Yii::app()->user->SiteSessions;
        Yii::app()->theme = 'landing_page_theme';
        $error = Yii::app()->errorHandler->error;
        if (!$error) {
            $error['message'] = " NO Frenchise in current country...!";
            $this->renderPartial('error', array('error' => $error));
        }
        else
            throw new CHttpException(404, 'Page not found.');
    }

}

?>
