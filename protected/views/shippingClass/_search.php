<?php
/* @var $this ShippingClassController */
/* @var $model ShippingClass */
/* @var $form CActiveForm */
?>

<div class="wide form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
    ));
    ?>


    <div class="row">
        <?php echo $form->label($model, 'destination_city'); ?>
        <?php
        echo $form->dropDownList($model, 'destination_city', array(Yii::app()->session['city_id'] => "Same as source", "0" => "Out of Source"));
        ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'title'); ?>
        <?php echo $form->textField($model, 'title', array('size' => 60, 'maxlength' => 255)); ?>
    </div>
    <div class="row">
        <?php echo $form->label($model, 'is_fix_shpping'); ?>
        <?php echo $form->checkBox($model, 'is_fix_shpping'); ?>
    </div>
    <div class="row">
        <?php echo $form->label($model, 'fix_shipping_cost'); ?>
        <?php echo $form->textField($model, 'fix_shipping_cost'); ?>
    </div>


    <div class="row">
        <?php echo $form->label($model, 'is_pirce_range'); ?>
        <?php echo $form->checkBox($model, 'is_pirce_range'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'start_price'); ?>
        <?php echo $form->textField($model, 'start_price'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'end_price'); ?>
        <?php echo $form->textField($model, 'end_price'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'is_weight_based'); ?>
        <?php echo $form->checkBox($model, 'is_weight_based'); ?>
    </div>
    <div class="row">
        <?php echo $form->label($model, 'min_weight_id'); ?>
        <?php echo $form->textField($model, 'min_weight_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'max_weight_id'); ?>
        <?php echo $form->textField($model, 'max_weight_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'categories'); ?>
        <?php
        $categories = CHtml::listData(Categories::model()->getMenuParentCategories(), "category_id", "category_name");
        
        echo $form->ListBox($model, 'categories', $categories, array("multiple" => "multiple"));
        
        ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'class_status'); ?>
        <?php echo $form->dropDownList($model, 'class_status', array("0" => "Disable", "1" => "Enable")); ?>
    </div>


    <div class="row buttons">
        <?php echo CHtml::submitButton('Search', array("class" => "btn")); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->