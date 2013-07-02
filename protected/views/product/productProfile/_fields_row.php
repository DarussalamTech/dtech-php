<?php
/* mean it is called by ajax. */
if (!isset($display)) {
    $display = 'none';
}
$mName = "ProductProfile";
$relationName = "productProfile";
?>


<div class="clear"></div>
<div class="grid_fields full_grid_form" style="display:<?php echo $display; ?>">

    <?php
    if ($load_for == "view") {
        echo CHtml::activeHiddenField($model, '[' . $index . ']id');
    }

    echo CHtml::activeHiddenField($model, '[' . $index . ']upload_index', array("value" => $index));
    ?>


    <div class="row">
        <?php echo CHtml::activeLabelEx($model, 'isbn'); ?>
        <?php
        echo CHtml::activeTextField($model, '[' . $index . ']isbn')
        ?>
        <?php echo CHtml::error($model, 'isbn'); ?>
    </div>

    <div class="row">
        <?php echo CHtml::activeLabelEx($model, 'price'); ?>
        <?php
        echo CHtml::activeTextField($model, '[' . $index . ']price')
        ?>
        <?php echo CHtml::error($model, 'price'); ?>
    </div>

    <div class="clear"></div>
    <div class="row">
        <?php echo CHtml::activeLabelEx($model, 'language_id'); ?>
        <?php
        $criteria = new CDbCriteria();
        $criteria->select = "language_id,language_name";
        $languages = Language::model()->findAll($criteria);
        echo CHtml::activeDropDownList($model, '[' . $index . ']language_id', CHtml::listData($languages, "language_id", "language_name"));
        ?>
        <?php echo CHtml::error($model, 'language_id'); ?>
    </div>

    <div class="row">
        <?php echo CHtml::activeLabelEx($model, 'translator_id'); ?>
        <?php
        $criteria = new CDbCriteria();
        $criteria->select = "id,type,name";
        $criteria->condition = "type='translator'";
        $prod_pro = TranslatorCompiler::model()->findAll($criteria);
        echo CHtml::activeDropDownList($model, '[' . $index . ']translator_id', CHtml::listData($prod_pro, "id", "name"), array('prompt' => 'Select a Translator'));
        ?>
        <?php echo CHtml::error($model, 'translator_id'); ?>
    </div>


    <div class="clear"></div>

    <div class="row">
        <?php echo CHtml::activeLabelEx($model, 'compiler_id'); ?>
        <?php
        $criteria = new CDbCriteria();
        $criteria->select = "id,type,name";
        $criteria->condition = "type='compiler'";
        $prod_pro = TranslatorCompiler::model()->findAll($criteria);
        //CVarDumper::dump(CHtml::listData($prod_pro, "id", "type"),20,TRUE);die;        
        echo CHtml::activeDropDownList($model, '[' . $index . ']compiler_id', CHtml::listData($prod_pro, "id", "name"), array('prompt' => 'Select a Compiler'));
        ?>
        <?php echo CHtml::error($model, 'compiler_id'); ?>
    </div>
    <div class="row">
        <?php echo CHtml::activeLabelEx($model, 'dimension'); ?>
        <?php
        $criteria = new CDbCriteria();
        $criteria->select = "id,type,title";
        $criteria->condition = "type='Dimensions'";
        $prod_pro = ConfProducts::model()->findAll($criteria);
        echo CHtml::activeDropDownList($model, '[' . $index . ']dimension', CHtml::listData($prod_pro, "id", "title"), array('prompt' => 'Select a Dimension'));
        ?>
        <?php echo CHtml::error($model, 'dimension'); ?>
    </div>

    <div class="clear"></div>
    <div class="row">
        <?php echo CHtml::activeLabelEx($model, 'binding'); ?>
        <?php
        $criteria = new CDbCriteria();
        $criteria->select = "id,type,title";
        $criteria->condition = "type='binding'";
        $prod_pro = ConfProducts::model()->findAll($criteria);
        echo CHtml::activeDropDownList($model, '[' . $index . ']binding', CHtml::listData($prod_pro, "id", "title"), array('prompt' => 'Select a Binding'));
        ?>
        <?php echo CHtml::error($model, 'binding'); ?>
    </div>
    <div class="row">
        <?php echo CHtml::activeLabelEx($model, 'printing'); ?>
        <?php
        $criteria = new CDbCriteria();
        $criteria->select = "id,type,title";
        $criteria->condition = "type='printing'";
        $prod_pro = ConfProducts::model()->findAll($criteria);
        echo CHtml::activeDropDownList($model, '[' . $index . ']printing', CHtml::listData($prod_pro, "id", "title"), array('prompt' => 'Select a Printing'));
        ?>
        <?php echo CHtml::error($model, 'printing'); ?>
    </div>

    <div class="clear"></div>

    <div class="row">
        <?php echo CHtml::activeLabelEx($model, 'paper'); ?>
        <?php
        $criteria = new CDbCriteria();
        $criteria->select = "id,type,title";
        $criteria->condition = "type='paper'";
        $prod_pro = ConfProducts::model()->findAll($criteria);
        echo CHtml::activeDropDownList($model, '[' . $index . ']paper', CHtml::listData($prod_pro, "id", "title"), array('prompt' => 'Select a Paper'));
        ?>
        <?php echo CHtml::error($model, 'paper'); ?>
    </div>

    <!--    <div class="row">
    <?php echo CHtml::activeLabelEx($model, 'size'); ?>
    <?php
    echo CHtml::activeTextField($model, '[' . $index . ']size')
    ?>
    <?php echo CHtml::error($model, 'size'); ?>
        </div>-->

    <div class="row">
        <?php echo CHtml::activeLabelEx($model, 'no_of_pages'); ?>
        <?php
        echo CHtml::activeTextField($model, '[' . $index . ']no_of_pages')
        ?>
        <?php echo CHtml::error($model, 'no_of_pages'); ?>
    </div>


    <div class="clear"></div>
    <div class="row">
        <?php echo CHtml::activeLabelEx($model, 'edition'); ?>
        <?php
        echo CHtml::activeTextField($model, '[' . $index . ']edition')
        ?>
        <?php echo CHtml::error($model, 'edition'); ?>
    </div>





    <div class="clear"></div>

    <div class="del del-icon" >
        <?php
        echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl . '/images/icons/plus.gif', 'Add'), '#', array(
            'class' => 'plus',
            'onclick' =>
            "
                   
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
<?php
/*
  $this->renderPartial(
  'productImages/_container', array('model' => $model,
  "type" => "field", "index" => $index));
 */
?>
