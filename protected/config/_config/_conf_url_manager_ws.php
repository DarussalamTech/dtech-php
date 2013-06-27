<?php

/**
 * @author Ali Abbas
 * @abstract use for 
 *  setting import class
 *  
 */
$url_manager = array(
    'urlFormat' => 'path',
    'showScriptName' => true,
    'rules' => array(
        /** New admin urls * */
        /** other urls * */
        '/WS/index/' => '/WS/index/',
        '/WS/allCategories/' => '/WS/allCategories/',
        '/WS/requestedCategory/<category_id:[\w-\.]+>' => '/WS/requestedCategory/',
    ),
);
?>
