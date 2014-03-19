<?php
/* mean it is called by ajax. */
if (!isset($display)) {
    $display = 'none';
}
$mName = "Country";
$relationName = "countries";
?>
<div class="grid_fields" style="display:<?php echo $display; ?>">


    <div class="field" style="width:200px">
        <?php
        if ($load_for == "view") {
            echo CHtml::activeHiddenField($model, '[' . $index . ']country_id');
        }

        echo CHtml::activeTextField($model, '[' . $index . ']country_name');
        ?>
    </div>
    <div class="field" style="width:200px">

        <?php
        echo CHtml::activeTextField($model, '[' . $index . ']dhl_code');
        ?>
    </div>

    <div class="del del-icon" >
        <?php
         //no need for this this will be from import script or migrations
//        echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl . '/images/icons/plus.gif', 'Add'), '#', array(
//            'class' => 'plus',
//            'onclick' =>
//            "
//                
//		    u = '" . Yii::app()->controller->createUrl("loadChildByAjax", array("mName" => "$mName", "dir" => $dir, "load_for" => $load_for,)) . "&index=' + " . $relationName . "_index_sc;
//                    
//                    
//                    add_new_child_row(u, '" . $dir . "', '" . $fields_div_id . "', 'grid_fields', true);
//                    
//                    " . $relationName . "_index_sc++;
//                    return false;
//                    "
//        ));
        ?>
        <?php
        echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl . '/images/icons/cross.gif', 'Delete'), '#', array('onclick' => 'delete_fields(this, 2, "#' . $relationName . '-form", ".grid_fields"); return false;', 'title' => 'sc'));
        ?>
    </div>

    <div class="clear"></div>
</div>
<div class="clear"></div>
