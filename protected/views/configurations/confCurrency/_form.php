<?php
/* @var $this SectionController */
/* @var $model Section */
/* @var $form CActiveForm */
?>

<div class="form wide">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'currency-form',
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <div class="row">
        <?php echo $form->labelEx($model, 'name'); ?>
        <?php echo $form->textField($model, 'name', array('size' => 255, )); ?>
        <?php echo $form->error($model, 'name'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'symbol'); ?>
        <?php echo $form->textField($model, 'symbol', array('size' => 20,)); ?>
        <?php echo $form->error($model, 'symbol'); ?>
    </div>


    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array("class" => "btn"));
        ?>
        <?php
        echo CHtml::link('Cancel', array('load', 'm' => "Currency"));
        ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->