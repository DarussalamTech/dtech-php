<?php
/* @var $this CountryController */
/* @var $model Country */
/* @var $form CActiveForm */
?>

<div class="form wide">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'country-form',
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

        <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'country_name'); ?>
<?php echo $form->textField($model, 'country_name', array('size' => 60, 'maxlength' => 255)); ?>
<?php echo $form->error($model, 'country_name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'short_name'); ?>
<?php echo $form->textField($model, 'short_name', array('size' => 60, 'maxlength' => 255)); ?>
<?php echo $form->error($model, 'short_name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'site_id'); ?>
        <?php $ld = CHtml::listData(SelfSite::model()->findAll(), 'site_id', 'site_name'); ?>
<?php echo $form->dropDownList($model, 'site_id', $ld, array('prompt' => 'Select Site')); ?>
<?php echo $form->error($model, 'site_id'); ?>
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