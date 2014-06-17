<?php
/* @var $this LogController */
/* @var $model Log */
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
        <?php echo $form->label($model, 'id'); ?>
        <?php echo $form->textField($model, 'id'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'ip'); ?>
        <?php echo $form->textField($model, 'ip', array('size' => 20, 'maxlength' => 20)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'browser'); ?>
        <?php echo $form->textField($model, 'browser', array('size' => 60, 'maxlength' => 255)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'url'); ?>
        <?php echo $form->textField($model, 'url', array('size' => 60, 'maxlength' => 255)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'line'); ?>
        <?php echo $form->textField($model, 'line', array('size' => 15, 'maxlength' => 15)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'file'); ?>
        <?php echo $form->textField($model, 'file', array('size' => 60, 'maxlength' => 100)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'robots_txt_rule'); ?>
        <?php echo $form->textField($model, 'robots_txt_rule', array('size' => 60, 'maxlength' => 300)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'htaccess_rule'); ?>
        <?php echo $form->textField($model, 'htaccess_rule', array('size' => 60, 'maxlength' => 300)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'message'); ?>
        <?php echo $form->textField($model, 'message', array('size' => 60, 'maxlength' => 200)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'type'); ?>
        <?php echo $form->textField($model, 'type', array('size' => 15, 'maxlength' => 15)); ?>
    </div>



    <div class="row buttons">
        <?php echo CHtml::submitButton('Search', array("class" => "btn")); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->