<?php
/* @var $this SelfSiteController */
/* @var $model SelfSite */
/* @var $form CActiveForm */
?>

<div class="form wide">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'self-site-form',
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'site_name'); ?>
        <?php echo $form->textField($model, 'site_name', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'site_name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'site_descriptoin'); ?>
        <?php echo $form->textField($model, 'site_descriptoin', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'site_descriptoin'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'country_id'); ?>


        <?php
        echo $form->dropDownList($model, 'country_id', CHtml::listData(Country::model()->findAll(), 'country_id', 'country_name'), array(
            'empty' => 'Please Select Country',
            'ajax' => array(
                'type' => 'POST',
                'url' => $this->createUrl('/selfSite/getCity'),
                'update' => '#SelfSite_site_headoffice'
        )));
        ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'site_headoffice'); ?>
        <?php echo $form->dropDownList($model, 'site_headoffice', $model->_cites); ?>
        <?php echo $form->error($model, 'site_headoffice'); ?>
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