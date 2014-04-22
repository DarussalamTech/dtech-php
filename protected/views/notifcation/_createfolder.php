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
    <?php $this->endWidget(); ?>
</div>