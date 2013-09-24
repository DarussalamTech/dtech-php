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

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>
    <?php $modelp = UserProfile::model(); ?>
    <?php
    if (!Yii::app()->user->isGuest) {
        ?>
        <div class="row">

            <?php echo $form->labelEx($modelp, 'first_name'); ?>
            <?php echo $form->textField($modelp, 'first_name', array('size' => 60, 'maxlength' => 255)); ?>
            <?php echo $form->error($modelp, 'first_name'); ?>
        </div>

        <div class="row">

            <?php echo $form->labelEx($modelp, 'last_name'); ?>
            <?php echo $form->textField($modelp, 'last_name', array('size' => 60, 'maxlength' => 255)); ?>
            <?php echo $form->error($modelp, 'last_name'); ?>
        </div>
    <?php } ?>
    <div class="row">

        <?php echo $form->labelEx($model, 'user_email'); ?>
        <?php echo $form->textField($model, 'user_email'); ?>
        <?php echo $form->error($model, 'user_email'); ?>
    </div>

    <?php
    if ($model->isNewRecord):
        ?>
        <div class="row">
            <?php echo $form->labelEx($model, 'user_password'); ?>
            <?php echo $form->passwordField($model, 'user_password', array('size' => 60, 'maxlength' => 255)); ?>
            <?php echo $form->error($model, 'user_password'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'user_password2'); ?>
            <?php echo $form->passwordField($model, 'user_password2', array('size' => 60, 'maxlength' => 255)); ?>
            <?php echo $form->error($model, 'user_password2'); ?>
        </div>
        <?php
    endif;
    ?>

    <?php
    if (!Yii::app()->user->isGuest) {
        ?>

        <?php
        $this->renderPartial("/common/_city_field", array("form" => $form, "model" => $model, "cityList" => $cityList));
        ?>


        <div class="row">
            <?php echo $form->labelEx($model, 'site_id'); ?>
            <?php $ld = CHtml::listData(SelfSite::model()->findAll(), 'site_id', 'site_name'); ?>
            <?php echo $form->dropDownList($model, 'site_id', $ld, array('prompt' => 'Select Site')); ?>
            <?php echo $form->error($model, 'site_id'); ?>
        </div>

        <?php echo $form->hiddenField($model, 'role_id', array("value" => 3)); ?>
        <div class="row">
            <?php echo $form->labelEx($model, 'status_id'); ?>
            <?php
            $criteria = new CDbCriteria();
            $criteria->select = "id,title";
            $criteria->addCondition("module = 'User'");
            $status = CHtml::listData(Status::model()->findAll(), "id", "title");
            echo $form->dropDownList(
                    $model, 'status_id', $status
            );
            ?>
            <?php echo $form->error($model, 'status_id'); ?>
        </div>


        <div class="row">
            <?php echo $form->labelEx($modelp, 'address'); ?>
            <?php echo $form->textField($modelp, 'address', array('size' => 60, 'maxlength' => 255)); ?>
            <?php echo $form->error($modelp, 'address'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model, 'join_date'); ?>
            <?php
            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'model' => $model,
                'attribute' => 'join_date',
                'options' => array(
                    'mode' => 'focus',
                    'dateFormat' => Yii::app()->params['dateformat'],
                    'showAnim' => 'slideDown',
                ),
                'htmlOptions' => array(
                    'size' => '15', // textField size
                    'maxlength' => '10', // textField maxlength
                ),
            ));
            ?>
            <?php echo $form->error($model, 'join_date'); ?>
        </div>
    <?php } ?>


    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array("class" => "btn")); ?>
        <?php
        echo " or ";
        echo CHtml::link('Cancel', '#', array('onclick' => 'dtech.go_history()'));
        ?>
    </div>

    <?php $this->endWidget(); ?>


</div>