<?php
/* @var $this NotifcationController */
/* @var $model Notifcation */
/* @var $form CActiveForm */

$admin_users = User::model()->getAll(" (role_id = 2 OR role_id = 1 ) AND  user_id <> " . Yii::app()->user->id);
$admin_users = CHtml::listData($admin_users, "user_email", "user_email");
$admin_users = CJSON::encode($admin_users);

Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/media/tag/css/jquery.tagit.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/media/tag/css/tagit.ui-zendesk.css');
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/packages/jui/js/jquery-ui.min.js');
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/media/tag/js/tag-it.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScript('tag', "
        
        var users = $admin_users;
        emails_arr = new Array()
        for ( user in users){
            emails_arr.push(user)
        }
            
        $(function(){
             $('#Notifcation_to').tagit({
                availableTags: emails_arr
            });
        })

", CClientScript::POS_END);

if (Yii::app()->user->hasFlash('status')) {
    echo CHtml::openTag("div", array("class" => "flash-success"));
    echo Yii::app()->user->getFlash("status");
    echo CHtml::closeTag("div");
}
?>
<div class="clear"></div>

<div class="form wide">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'notifcation-form',
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'from'); ?>
        <?php echo $form->dropDownList($model, 'from', array(Yii::app()->user->user->user_id => Yii::app()->user->user->user_email)); ?>
        <?php echo $form->error($model, 'from'); ?>
        <?php echo $form->hiddenField($model, 'type', array('value' => 'sent')); ?>
    </div>
    <div class="clear_from_tag_five"></div>
    <div class="row">
        <?php echo $form->labelEx($model, 'to'); ?>
        <?php echo $form->textField($model, 'to', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'to'); ?>
    </div>
    <div class="clear_from_tag_ten"></div>


    <div class="row">
        <?php echo $form->labelEx($model, 'subject'); ?>
        <?php echo $form->textField($model, 'subject', array('class' => 'four_hundered')); ?>
        <?php echo $form->error($model, 'subject'); ?>
    </div>
    <div class="clear_from_tag_ten"></div>
    <div class="row">
        <?php echo $form->labelEx($model, 'body'); ?>
        <?php //echo $form->textArea($model, 'body'); ?>
        <?php
        $this->widget('application.extensions.tinymce.ETinyMce', array(
            'editorTemplate' => 'full',
            'model' => $model,
            'attribute' => 'body',
            'options' => array('theme' => 'advanced')));
        ?>
        <?php echo $form->error($model, 'body'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'email_sent'); ?>
        <?php echo $form->checkBox($model, 'email_sent'); ?>
        <?php echo $form->error($model, 'email_sent'); ?>
    </div>



    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Send' : 'Save', array("class" => "btn")); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->