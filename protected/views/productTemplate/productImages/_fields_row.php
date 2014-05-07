<?php
/* mean it is called by ajax. */
if (!isset($display)) {
    $display = 'none';
}
$mName = "ProductImage";
$relationName = "productImages";
?>
<div class="grid_fields" style="display:<?php echo $display; ?>">


    <div class="field" style="width:500px">
        <?php
        if ($load_for == "view") {
            echo CHtml::activeHiddenField($model, '[' . $index . ']id');
        }
        
        echo CHtml::activeHiddenField($model, '[' . $index . ']upload_index', array("value" => $upload_index));

        if (!empty($model->id)) {
            echo CHtml::link("View Image", $model->image_url["image_large"], array("rel" => "lightbox[_default]"));
        }
        echo CHtml::activeHiddenField($model, '[' . $index . ']upload_key', array("value" => $index));
        ?>

        <?php
        echo CHtml::activeFileField($model, '[' . $index . ']image_large');
        ?>
    </div>

    <div class="field" style="width:50px">
        <?php
        echo CHtml::activeCheckBox($model, '[' . $index . ']is_default', array(
            "class" => "default_checkbox", "onclick" => "
                                 cobj = this;
                                 jQuery('.default_checkbox').each(function()
                                 {
                                    if(jQuery(cobj).is(':checked') && jQuery(this).attr('id') != jQuery(cobj).attr('id')){
                                        jQuery(this).removeAttr('checked');
                                    }
                                 })  
                                "
        ));
        ?>
    </div>



    <div class="del del-icon" >
        <?php
        echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl . '/images/icons/plus.gif', 'Add'), '#', array(
            'class' => 'plus',
            'onclick' =>
            "
                
					u = '" . Yii::app()->controller->createUrl("loadChildByAjax", array("mName" => "$mName", "dir" => $dir, "load_for" => $load_for,)) . "&index=' + " . $relationName . "_index_sc;
                    add_new_child_row(u, '" . $dir . "', '" . $fields_div_id . "', 'grid_fields', true);
                    
                    " . $relationName . "_index_sc++;
                    return false;
                    "
        ));
        ?>
        <?php
        echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl . '/images/icons/cross.gif', 'Delete'), '#', array('onclick' => 'delete_fields(this, 2, "#' . $relationName . '-form", ".grid_fields"); return false;', 'title' => 'sc'));
        ?>
    </div>

    <div class="clear"></div>
</div>
<div class="clear"></div>
