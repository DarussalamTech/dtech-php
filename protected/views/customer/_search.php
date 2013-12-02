<?php
/* @var $this UserController */
/* @var $model User */
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
        <?php echo $form->label($model, 'user_id'); ?>
        <?php echo $form->textField($model, 'user_id'); ?>
    </div>


    <div class="row">
        <?php echo $form->label($model, 'role_id'); ?>
        <?php echo $form->textField($model, 'role_id'); ?>
    </div>


    <div class="row">
        <?php echo $form->label($model, 'user_email'); ?>
        <?php echo $form->textField($model, 'user_email'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Search', array("class" => "btn")); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->