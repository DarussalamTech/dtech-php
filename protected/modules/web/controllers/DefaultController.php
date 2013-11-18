<?php

class DefaultController extends Controller {

    public function actionIndex() {
        $this->render('index');
    }

    /**
     * get Face book page 
     * feeds 
     */
    public function actionGetFacebookFeeds() {
        Yii::app()->user->SiteSessions;
        $feeds = array();
        $json_res = Yii::app()->curl
                ->setOption(CURLOPT_HTTPHEADER, array('Content-type: application/json'))
                ->post("https://www.facebook.com/feeds/page.php?id=175377742595349&format=json", array());
        $json_arr = CJSON::decode($json_res);
        if (!empty($json_arr['entries'])) {
            $feeds = array_slice($json_arr['entries'], 0, 5);
        }

        $this->renderPartial("//site/_facebook_feeds", array("feeds" => $feeds));
    }

}