<div class="form wide">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'user-change-form',
        'enableClientValidation' => true,
    ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>
    <?php
    if (Yii::app()->user->hasFlash('changPass')) {
        ?>
        <div class="flash-success" align="center">
            <?php echo Yii::app()->user->getFlash('changPass'); ?>
        </div>

    <?php } ?>

    <div class="row">
        <?php echo $form->labelEx($model, '_user_name'); ?>
        <?php echo Yii::app()->user->name ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'old_password'); ?>
        <?php echo $form->passwordField($model, 'old_password'); ?>
        <?php echo $form->error($model, 'old_password'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'user_password'); ?>
        <?php echo $form->passwordField($model, 'user_password'); ?>
        <?php echo $form->error($model, 'user_password'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'user_conf_password'); ?>
        <?php echo $form->passwordField($model, 'user_conf_password'); ?>
        <?php echo $form->error($model, 'user_conf_password'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Change', array("class" => "btn")); ?>
        <?php
        echo " or ";
        echo CHtml::link('Cancel', '#', array('onclick' => 'dtech.go_history()'));
        ?>
    </div>
    <?php $this->endWidget(); ?>

</div>