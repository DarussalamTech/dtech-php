<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="form wide">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'user-form',
        'enableClientValidation' => true,
    ));
    ?>


    <div class="row">
        <?php echo $form->label($model, 'status'); ?>
        <?php
        echo $form->dropDownList($model, 'status', array(
            'pending' => "pending",
            'process' => "process",
            'completed' => "completed",
            'declined' => "declined",
                )
        );
        ?>
    </div>
    <div class="row">
        <?php echo $form->label($model, 'comment'); ?>
        <?php
            echo $form->textArea($model, 'comment',array("cols"=>"10","style"=>"width:200px;height:60px"));
        ?>
    </div>
    <div class="row">
        <?php echo $form->label($model, 'is_notify_customer'); ?>
        <?php
            echo $form->checkBox($model, 'is_notify_customer');
        ?>
    </div>
    <div class="row">
        <?php echo $form->label($model, 'include_comment'); ?>
        <?php
            echo $form->checkBox($model, 'include_comment');
        ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array("class" => "btn")); ?>

    </div>

    <?php $this->endWidget(); ?>


</div>