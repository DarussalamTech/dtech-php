<?php

/*
 * Class to handle and filter http
 * on based on security of the controller's
 * action 
 * ubd: 
 */

class DTHttpFilter extends CFilter {

    protected function preFilter($filterChain) {
        //CVarDumper::dump($filterChain,10,TRUE);die;
        if (Yii::app()->getRequest()->isSecureConnection) {

            # Redirect to the secure version of the page.
            $url = 'http://' .
                    Yii::app()->getRequest()->serverName .
                    Yii::app()->getRequest()->requestUri;
            Yii::app()->request->redirect($url);
            return false;
        }

        return true;
    }

}

?>
