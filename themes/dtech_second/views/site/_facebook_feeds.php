<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

if(!empty($feeds)){
    foreach($feeds as $data){
       echo "<p>";
        echo CHtml::link($data['title'],$data['alternate'],array("target"=>"_blank"));
       echo "</p>";
    }
}
?>
