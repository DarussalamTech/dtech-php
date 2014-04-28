<?php
/* @var $this ProductTemplateController */
/* @var $model ProductTemplate */
/* @var $form CActiveForm */
?>

<div class="form wide">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'product-template-form',
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'product_name'); ?>
        <?php echo $form->textField($model, 'product_name', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'product_name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'universal_name'); ?>
        <?php echo $form->textField($model, 'universal_name', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'universal_name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'parent_id'); ?>
        <?php echo $form->textField($model, 'parent_id'); ?>
        <?php echo $form->error($model, 'parent_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'slag'); ?>
        <?php echo $form->textField($model, 'slag', array('size' => 30, 'maxlength' => 30)); ?>
        <?php echo $form->error($model, 'slag'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'parent_cateogry_id'); ?>
        <?php echo $form->textField($model, 'parent_cateogry_id'); ?>
        <?php echo $form->error($model, 'parent_cateogry_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'product_description'); ?>
        <?php echo $form->textArea($model, 'product_description', array('rows' => 6, 'cols' => 50)); ?>
        <?php echo $form->error($model, 'product_description'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'product_overview'); ?>
        <?php echo $form->textArea($model, 'product_overview', array('rows' => 6, 'cols' => 50)); ?>
        <?php echo $form->error($model, 'product_overview'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'status'); ?>
        <?php echo $form->textField($model, 'status'); ?>
        <?php echo $form->error($model, 'status'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'city_id'); ?>
        <?php echo $form->textField($model, 'city_id'); ?>
        <?php echo $form->error($model, 'city_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'is_featured'); ?>
        <?php echo $form->textField($model, 'is_featured', array('size' => 1, 'maxlength' => 1)); ?>
        <?php echo $form->error($model, 'is_featured'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'product_rating'); ?>
        <?php echo $form->textField($model, 'product_rating'); ?>
        <?php echo $form->error($model, 'product_rating'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'authors'); ?>
        <?php echo $form->textField($model, 'authors', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'authors'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'shippable_countries'); ?>
        <?php echo $form->textField($model, 'shippable_countries', array('size' => 60, 'maxlength' => 900)); ?>
        <?php echo $form->error($model, 'shippable_countries'); ?>
    </div>


    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array("class" => "btn")); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->