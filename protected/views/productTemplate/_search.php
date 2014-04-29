<?php
/* @var $this ProductTemplateController */
/* @var $model ProductTemplate */
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
        <?php echo $form->label($model, 'product_name'); ?>
        <?php echo $form->textField($model, 'product_name', array('size' => 60, 'maxlength' => 255)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'universal_name'); ?>
        <?php echo $form->textField($model, 'universal_name', array('size' => 60, 'maxlength' => 255)); ?>
    </div>



    <div class="row">
        <?php echo $form->label($model, 'slag'); ?>
        <?php echo $form->textField($model, 'slag', array('size' => 30, 'maxlength' => 30)); ?>
    </div>



    <div class="row buttons">
        <?php echo CHtml::submitButton('Search', array("class" => "btn")); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->