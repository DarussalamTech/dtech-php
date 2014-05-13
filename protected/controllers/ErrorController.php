<?php

/*
 * to handle error from all the system
 */

class ErrorController extends Controller {

    public function beforeAction($action) {

        Yii::app()->theme = 'landing_page_theme';
        Yii::app()->controller->layout = '';
        //return parent::beforeAction($action);
        return true;
    }

    public function actionError() {

        $error = Yii::app()->errorHandler->error;


        if (!empty($error)) {


            $email['From'] = Yii::app()->params['adminEmail'];
            $email['To'] = array(
                'ali.abbas@darussalampk.com',
                'itsgeniusstar@gmail.com',
                    //'ammar.rana@darussalampk.com'
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

            Yii::log(str_replace("<br/>", "\n", $body), "info");


            $log = new Log();
            $log->ip = CHttpRequest::getUserHostAddress();
            $log->browser = Yii::app()->request->userAgent;
            $log->url = Yii::app()->request->hostInfo . Yii::app()->request->url;
            $log->line = $error['line'];
            $log->file = $error['file'];
            $log->message = $error['message'];
            $log->type = $error['type'];
            $log->trace = $error['trace'];

            if (strstr($log->browser, "bot.html")) {
                $log->htaccess_rule = "RedirectMatch 301 " . Yii::app()->request->url . " " . Yii::app()->request->hostInfo . Yii::app()->request->baseUrl;
                $log->robots_txt_rule = "User-agent: * \n";
                $log->robots_txt_rule.=" Disallow:" . Yii::app()->request->url;
            }
            $log->save();
            /**
             * if error of db then the layout will be changed
             */
            if ($error['code'] == 500 && $error['type'] == 'CDbException' && $error['errorCode'] == 2002) {
                Yii::app()->theme = 'dtech_second';
                Yii::app()->controller->layout = 'site_down';
                $this->render('error', array('error' => $error));
            } else {
                $this->render('error', array('error' => $error));
            }

            if ($error['code'] != "404") {
                $this->sendEmail2($email);
            }
        } else {
            throw new CHttpException(404, 'Page not found.');
        }
    }

    public function actionUnderconstruction() {

        $this->layout = '';
        $error['message'] = " Site is under construction!";
        if ($error)
            $this->renderPartial('underconstruction', array('error' => $error));
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
