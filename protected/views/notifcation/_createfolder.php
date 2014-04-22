<div class="pading-bottom-5">
    <div class="left_float">
        <h1>Create Folder</h1>
    </div>

    <?php /* Convert to Monitoring Log Buttons */ ?>
    <div class = "right_float">

    </div>
</div>
<div class="form wide color-box-width">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'notifcation-form',
        'enableAjaxValidation' => false,
    ));
    ?>
    <div class="row">
        <?php echo $form->labelEx($model, 'name'); ?>
        <?php echo $form->textField($model, 'name'); ?>
        <?php echo $form->error($model, 'name'); ?>
    </div>
    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Send' : 'Save', array("class" => "btn")); ?>
    </div>
    <?php $this->endWidget(); ?>
</div>