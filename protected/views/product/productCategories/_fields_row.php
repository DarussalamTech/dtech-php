<?php
/* mean it is called by ajax. */
if (!isset($display)) {
    $display = 'none';
}
$mName = "ProductCategories";
$relationName = "productCategories";
?>
<div class="grid_fields" style="display:<?php echo $display; ?>">


    <div class="field" style="width:500px">
        <?php
        if ($load_for == "view") {
            echo CHtml::activeHiddenField($model, '[' . $index . ']product_category_id');
        }

        $criteria = new CDbCriteria();
        $criteria->select = "category_id,category_name";
        $criteria->order = "parent_id";
        $parent_cat = !empty($_GET['parent_cat']) ? $_GET['parent_cat'] : $parent_category;
        $criteria->addCondition("city_id=" . Yii::app()->session['city_id'] . " AND parent_id =" . $parent_cat);
        $data = array("" => "Select") + CHtml::listData(Categories::model()->findAll($criteria), "category_id", "category_name");
        echo CHtml::activeDropDownList($model, '[' . $index . ']category_id', $data);
        ?>
    </div>

    <div class="field" style="width:50px">

    </div>



    <div class="del del-icon" >
        <?php
        echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl . '/images/icons/plus.gif', 'Add'), '#', array(
            'class' => 'plus',
            'onclick' =>
            "
                    parent_cat = '';
                    if(typeof(jQuery('#Product_parent_cateogry_id').val()) =='undefined'){
                        parent_cat = jQuery('#parent_cat_id').val();
                    }
                    else {
                        parent_cat = jQuery('#Product_parent_cateogry_id').val();
                    }
		    u = '" . Yii::app()->controller->createUrl("loadChildByAjax", array("mName" => "$mName", "dir" => $dir, "load_for" => $load_for,)) . "&index=' + " . $relationName . "_index_sc;
                    u+='&parent_cat='+parent_cat; 
                    
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
