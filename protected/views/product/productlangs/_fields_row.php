<?php
/* mean it is called by ajax. */
if (!isset($display)) {
    $display = 'none';
}
$mName = "ProductLang";
$relationName = "productlangs";
?>

<?php
/* @var $this ProductController */
/* @var $model Product */
/* @var $form CActiveForm */

Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/gridform.css');
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/functions.js');
?>

<div class="form wide">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'product-form',
        'enableAjaxValidation' => false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
    ));
    ?>

    <?php $this->endWidget(); ?>

</div>
<div class="clear"></div>
<div class="grid_fields full_grid_form" style="display:<?php echo $display; ?>">

    <?php
    if ($load_for == "view") {
        echo CHtml::activeHiddenField($model, '[' . $index . ']id');
    }
    ?>


    <div class="row">
        <?php echo CHtml::activeLabelEx($model, 'product_name'); ?>
        <?php
        echo CHtml::activeTextField($model, '[' . $index . ']product_name')
        ?>
        <?php echo CHtml::error($model, 'product_name'); ?>
    </div>

    <div class="clear"></div>


    <div class="row">
        <?php echo CHtml::activeLabelEx($model, 'product_overview'); ?>
        <?php
        echo CHtml::activeTextArea($model, '[' . $index . ']product_overview')
        ?>
        <?php echo CHtml::error($model, 'product_overview'); ?>
    </div>

    <div class="clear"></div>

    <div class="row">
        <?php echo CHtml::activeLabelEx($model, 'lang_id'); ?>
        <?php
        echo CHtml::activeDropDownList($model, '[' . $index . ']lang_id', Yii::app()->params['otherLanguages_arr']);
        ?>
        <?php echo CHtml::error($model, 'lang_id'); ?>
    </div>

    <div class="clear"></div>
    <div class="row">
        <?php echo CHtml::activeLabelEx($model, 'product_description'); ?>
        <?php
        $this->widget('application.extensions.tinymce.ETinyMce', array(
            'editorTemplate' => 'full',
            'model' => $model,
            'attribute' => '[' . $index . ']product_description',
            'options' => array('theme' => 'advanced')));
        ?>
        <?php echo CHtml::error($model, 'product_description'); ?>
    </div>

    <div class="clear"></div>





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
