<?php

/**
 * @author Ali Abbas
 * @abstract use for 
 *  setting import class
 *  
  /**
 * Application Components 
 */
$conf_component_user = array(
    /* enable cookie-based authentication */
    'allowAutoLogin' => true,
    'class' => 'RWebUser',
);

$conf_email_user = array(
    'class' => 'application.extensions.KEmail.KEmail',
    'host_name' => 'smtp.gmail.com',
    'user' => 'zahid.nadeem@darussalampk.com',
    'password' => 'public420',
    'host_port' => 465,
    'ssl' => 'true',
);

$conf_payPall_user = array(
    'class' => 'application.components.Paypal',
    'apiUsername' => 'zahid.nadeem-facilitator_api1.darussalampk.com',
    'apiPassword' => '1366199236',
    'apiSignature' => 'AFcWxV21C7fd0v3bYYYRCpSSRl31AsZ74UA0FGC.aXRCRZeTDD1bRWiS',
    'apiLive' => false,
    'returnUrl' => '/web/paypal/confirm/', //regardless of url management component
    'cancelUrl' => '/web/paypal/cancel/', //regardless of url management component
);
?>
