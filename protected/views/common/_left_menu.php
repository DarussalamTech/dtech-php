<?php
/*
 * Render Partial Left Menu
 * 
 */
$this->menu = array(
    array('label' => 'Operations', 'url' => "javascript:void(0)", 'visible' => true,"htmlOptions"=>array("class"=>"operations")),
    array('label' => 'List All', 'url' => array('index'), 'visible' => true),
    array('label' => 'Create New', 'url' => array('create'), 'visible' => true),
);

?>
