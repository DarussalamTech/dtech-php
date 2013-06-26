<?php

/**
 * @author Ali Abbas
 * @abstract use for 
 *  setting new  module
 *  
 */
$modules = array(
    // uncomment the following to enable the Gii tool
    // uncomment the following to enable the Gii tool

    'web',
    'blog',
    'gii' => array(
        'class' => 'system.gii.GiiModule',
        'password' => '123',
        // If removed, Gii defaults to localhost only. Edit carefully to taste.
        'ipFilters' => array('127.0.0.1', '::1'),
    ),
     'rights' => array(
        'superuserName' => 'SuperAdmin', // Name of the role with super user privileges.
        'authenticatedName' => 'Authenticated', // Name of the authenticated user role.
        'userIdColumn' => 'user_id', // Name of the user id column in the database.
        'userNameColumn' => 'user_name', // Name of the user name column in the database.
        'enableBizRule' => false, // Whether to enable authorization item business rules.
        'enableBizRuleData' => false, // Whether to enable data for business rules.
        'displayDescription' => true, // Whether to use item description instead of name.
        'flashSuccessKey' => 'RightsSuccess', // Key to use for setting success flash messages.
        'flashErrorKey' => 'RightsError', // Key to use for setting error flash messages.
        'install' => false, // Whether to install rights.
        'baseUrl' => '/rights', // Base URL for Rights. Change if module is nested.
        'layout' => 'rights.views.layouts.main', // Layout to use for displaying Rights.
        'appLayout' => 'webroot.themes.admin.views.layouts.main', // Application layout.

        'debug' => false, // Whether to enable debug mode.
    ),

);


$conf_component_authManager = array(
    'class' => 'RDbAuthManager', // Provides support authorization item sorting. ...... 
);
?>
