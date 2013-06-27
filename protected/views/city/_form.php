<?php
/* @var $this CityController */
/* @var $model City */
/* @var $form CActiveForm */
?>

<div class="form wide">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'city-form',
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'country_id'); ?>
        <?php $models = Country::model()->findAll(); ?>
        <?php $list = CHtml::listData($models, 'country_id', 'country_name'); ?>
        <?php echo $form->dropDownList($model, 'country_id', $list, array('prompt' => 'Select Country')); ?>
        <?php //echo $form->textField($model,'country_id');  ?>
        <?php echo $form->error($model, 'country_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'city_name'); ?>
        <?php echo $form->textField($model, 'city_name', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'city_name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'short_name'); ?>
        <?php echo $form->textField($model, 'short_name', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'short_name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'address'); ?>
        <?php echo $form->textField($model, 'address', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'address'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'layout_id'); ?>
        <?php $models = Layout::model()->findAll(); ?>
        <?php $list = CHtml::listData($models, 'layout_id', 'layout_name'); ?>
        <?php echo $form->dropDownList($model, 'layout_id', $list, array('prompt' => 'Select Layout')); ?>
        <?php //echo $form->textField($model,'layout_id');  ?>
        <?php echo $form->error($model, 'layout_id'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array("class" => "btn")); ?>
        <?php
        echo " or ";
        echo CHtml::link('Cancel', '#', array('onclick' => 'dtech.go_history()'));
        ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->