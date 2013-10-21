<?php

/**
 * @author Ali Abbas
 * @abstract use for 
 *  for log array
 *  
 */
$logs = array(
    'class' => 'CLogRouter',
    'routes' => array(
        array(
            'class' => 'CFileLogRoute',
            'levels' => 'error, warning',
        ),
        array(
            'class' => 'CFileLogRoute',
            'logFile' => 'invalidurl.log',
            'levels' => 'info',
        )

    // uncomment the following to show log messages on web pages
    /*
      array(
      'class'=>'CWebLogRoute',
      ),
     */
    ),
);
?>
