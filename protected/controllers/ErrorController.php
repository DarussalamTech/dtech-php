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
        if ($error) {

            $email['From'] = Yii::app()->params['adminEmail'];
            $email['To'] = array(
                'ali.abbas@darussalampk.com',
                'itsgeniusstar@gmail.com', 'ubaidullah@darussalampk.com',
                'ammar.rana@darussalampk.com'
            );


            $email['Subject'] = "Error in " . Yii::app()->name . " " . $error['code'];

            $body = "<div style='color:red'>url= " . Yii::app()->request->hostInfo . Yii::app()->request->url . "<br/>";
            $body = $body . "code= " . $error['code'] . "<br/>";
            $body = $body . "type= " . $error['type'] . "<br/>";
            $body = $body . "message= " . $error['message'] . "<br/>";
            $body = $body . "file= " . $error['file'] . "<br/>";
            $body = $body . "line= " . $error['line'] . "<br/>";
            $body = $body . "Browser= " . Yii::app()->request->userAgent . "<br/>";
            $body = $body . "trace= " . $error['trace'] . "<br/></div>";

            $email['Body'] = $body;

            $email['Body'] = $this->renderPartial('/common/_email_template', array('email' => $email), true, false);

            $this->render('error', array('error' => $error));
            $this->sendEmail2($email);
        } else {
            throw new CHttpException(404, 'Page not found.');
        }
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
