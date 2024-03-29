<?php

/**
 * @author Ali Abbas
 * @abstract use for 
 *  setting extra param
 * @updated NaeemChoudhary
 */
$params = array(
    // this is used in contact page
    'adminEmail' => 'zahid.nadeem@darussalampk.com', //Should be same component->email->user, use for sending emails to customer (sign up conformation, sending activation link, sending new password)
    'replyTo' => 'zahid.nadeem@darussalampk.com',
    'cc' => 'zahid.nadeem@darussalampk.com',
    'bcc' => 'zahid.nadeem@darussalampk.com',
    'supportEmail' => 'zahid.nadeem@darussalampk.com', //receiveing customer emails
    'dateformat' => 'y/m/d1',
    'email' => array(
        'class' => 'application.extensions.KEmail.KEmail',
        'host_name' => 'smtp.gmail.com',
        'user' => 'zahid.nadeem@darussalampk.com',
        'password' => 'public420',
        'host_port' => 465,
        'ssl' => 'true',
    ),
    'Paypal' => array(
        'class' => 'application.components.Paypal',
        'apiUsername' => 'zahid.nadeem-facilitator_api1.darussalampk.com',
        'apiPassword' => '1366199236',
        'apiSignature' => 'AFcWxV21C7fd0v3bYYYRCpSSRl31AsZ74UA0FGC.aXRCRZeTDD1bRWiS',
        'apiLive' => false,
        'returnUrl' => 'paypal/confirm/', //regardless of url management component
        'cancelUrl' => 'paypal/cancel/', //regardless of url management component
    ),
    /*'TwoCheckout'=> array(  // darussalamPK 2CO merchant account settings .. it was disabled as we will shift to only one 2CO account that is of Islamic Library or darussalamp ebooks
        'sellerId' => '202363463',
        'publishableKey' => 'C3E17998-5986-11E4-81C5-FB713A5D4FFE',
        'privateKey' => 'C3E17A38-5986-11E4-81C5-FB713A5D4FFE',
        'twocheckoutPaymentUrlProduction' => 'https://www.2checkout.com/checkout/purchase',
        'twocheckoutPaymentUrlSandbox' => 'https://sandbox.2checkout.com/checkout/purchase',
        'twocheckoutSuccessUrl' => 'http://darussalampk.com/web/payment/placeOrder',
    ),*/
    'TwoCheckout'=> array( // 2CO merchant account settings of the daurssalampublishers ebooks or islamic-library payments or sales
        'sellerId' => '202391468',
        'publishableKey' => 'A0154622-6A0F-11E4-B171-45733A5D4FFE',
        'privateKey' => 'A01546CC-6A0F-11E4-B171-45733A5D4FFE',
        'twocheckoutPaymentUrlProduction' => 'https://www.2checkout.com/checkout/purchase',
        'twocheckoutPaymentUrlSandbox' => 'https://sandbox.2checkout.com/checkout/purchase',
        'twocheckoutSuccessUrl' => 'http://darussalampk.com/web/payment/placeOrder',
    ),
    'adminEmail' => 'no_reply@darussalam.com',
    'default_admin' => 'webmaster@darussalampk.com',
    'dateformat' => 'm/d/y',
    'mailHost' => 'smtp.gmail.com',
    'smtp' => true,
    //'mailPort' => 587,
    'mailPort' => 465,
    'mailUsername' => 'darussalamecom2014@gmail.com',
    'mailPassword' => 'abc123AB12',
    'mailSecuity' => 'ssl',
    'defaultLanguage' => 'en',
    'translatedLanguages' => array('en', 'ar', 'ur'),
    'text_position' => array('en' => 'ltr', 'ar' => 'rtl', 'ur' => 'rtl'),
    'otherLanguages' => array('ar', 'ur'),
    'otherLanguages_arr' => array('ar' => "Arabic", 'ur' => "Urdu"),
    'https' => false,
    'notAllowedRequestUri' => 'option=com_virtuemart',
    'notAllowedRequestOptions' => array('com_virtuemart', 'com_br'),
    'notallowdCharactorsUrl' => array('[', ']', '@', '!', '$', '&', '(', ')', '*', '+', ';', "'", ",", "?", ":", " "),
);
?>
