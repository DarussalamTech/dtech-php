<?php
/* @var $this PagesController */
/* @var $model Pages */
/* @var $form CActiveForm */
?>

<div class="form wide">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'pages-form',
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <!--	<div class="row">
    <?php //echo $form->labelEx($model,'city_id'); ?>
    <?php //echo $form->textField($model,'city_id');  ?>
    <?php // echo $form->error($model,'city_id');  ?>
            </div>-->

    <div class="row">
        <?php echo $form->labelEx($model, 'title'); ?>
        <?php echo $form->textField($model, 'title', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'title'); ?>
    </div>

    <div class="row">
        <?php
        echo $form->labelEx($model, 'content');
        ?>
        <?php
        $this->widget('application.extensions.tinymce.ETinyMce', array(
            'editorTemplate' => 'full',
            'model' => $model,
            'attribute' => 'content',
            'options' => array('theme' => 'advanced')));
        ?>
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