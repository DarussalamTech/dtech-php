<?php

/**
 * The AuthorizeNet PHP SDK. Include this file in your project.
 *
 * @package AuthorizeNet
 */


require_once dirname(__FILE__) . '/lib/shared/AuthorizeNetRequest.php';
require_once dirname(__FILE__) . '/lib/shared/AuthorizeNetTypes.php';
require_once dirname(__FILE__) . '/lib/shared/AuthorizeNetXMLResponse.php';
require_once dirname(__FILE__) . '/lib/shared/AuthorizeNetResponse.php';
require_once dirname(__FILE__) . '/lib/AuthorizeNetAIM.php';
require_once dirname(__FILE__) . '/lib/AuthorizeNetARB.php';
require_once dirname(__FILE__) . '/lib/AuthorizeNetCIM.php';
require_once dirname(__FILE__) . '/lib/AuthorizeNetSIM.php';
require_once dirname(__FILE__) . '/lib/AuthorizeNetDPM.php';
require_once dirname(__FILE__) . '/lib/AuthorizeNetTD.php';
require_once dirname(__FILE__) . '/lib/AuthorizeNetCP.php';

if (class_exists("SoapClient")) {
    require_once dirname(__FILE__) . '/lib/AuthorizeNetSOAP.php';
}

/**
 * Exception class for AuthorizeNet PHP SDK.
 *
 * @package AuthorizeNet
 */
class AuthorizeNetException extends Exception {

    public function AuthorizeNetException() {
        
    }

}