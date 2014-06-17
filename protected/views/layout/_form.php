<?php
/* @var $this LayoutController */
/* @var $model Layout */
/* @var $form CActiveForm */
?>

<div class="form wide">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'layout-form',
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'layout_name'); ?>
        <?php echo $form->textField($model, 'layout_name', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'layout_name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'layout_description'); ?>
        <?php echo $form->textField($model, 'layout_description', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'layout_description'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'layout_color'); ?>
        <?php echo $form->textField($model, 'layout_color', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'layout_color'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'site_id'); ?>
        <?php $ld = CHtml::listData(SelfSite::model()->findAll(), 'site_id', 'site_name'); ?>
        <?php echo $form->dropDownList($model, 'site_id', $ld, array('prompt' => 'Select Site')); ?>
        <?php echo $form->error($model, 'site_id'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array("class" => "btn")); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->