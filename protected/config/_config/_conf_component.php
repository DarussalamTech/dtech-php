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
    'apiUsername' => 'waseem-developer_api1.darussalampk.com',
    'apiPassword' => '1400841145',
    'apiSignature' => 'AgZ3RW-PX6fp5AIDbvMljvyR1LFwAInpN2LDx6P9258e-eeCa2X0irbF',
    'apiLive' => false,
    'returnUrl' => '/web/paypal/confirm/', //regardless of url management component
    'cancelUrl' => '/web/paypal/cancel/', //regardless of url management component
);
/**
 * 
 * 
 */
$curl = array(
    'class' => 'application.components.classes.Curl',

);
?>
