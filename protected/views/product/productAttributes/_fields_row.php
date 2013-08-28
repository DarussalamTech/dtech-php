<?php
echo 'ehee';
/* mean it is called by ajax. */
if (!isset($display)) {
    $display = 'none';
}
$mName = "ProductAttributes";
$relationName = "productAttributes";
?>
<div class="grid_fields" style="display:<?php echo $display; ?>">


    <div class="field" style="width:300px">
        <?php
        if ($load_for == "view") {
            echo CHtml::activeHiddenField($model, '[' . $index . ']id');
        }
        ?>
        <?php
        $data = CHtml::listData(ConfProductAttributes::model()->findAll(), "id", "title");
        echo CHtml::activeDropDownList($model, '[' . $index . ']product_attribute_conf_id', $data);
        ?>
    </div>

    <div class="field" style="width:300px">
<?php
echo CHtml::activeTextField($model, '[' . $index . ']attribute_value');
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
