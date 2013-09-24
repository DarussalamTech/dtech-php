<?php
/* @var $this TranslatorCompilerController */
/* @var $model TranslatorCompiler */
/* @var $form CActiveForm */
?>

<div class="form wide" >

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'translator-compiler-form',
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

        <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'name'); ?>
<?php echo $form->textField($model, 'name', array('size' => 60, 'maxlength' => 255)); ?>
<?php echo $form->error($model, 'name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'type'); ?>
<?php echo $form->dropDownList($model, 'type', array('translator' => 'translator', 'compiler' => 'compiler')); ?>
<?php echo $form->error($model, 'type'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'btn')); ?>
        <?php
        echo " or ";
        echo CHtml::link('Cancel', '#', array('onclick' => 'dtech.go_history()'));
        ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->