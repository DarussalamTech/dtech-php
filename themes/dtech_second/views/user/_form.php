<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableClientValidation'=>true,
	
)); ?>
<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
        <?php $modelp = UserProfile::model(); ?>
        <?php if(!Yii::app()->user->isGuest) { ?>
	<div class="row">
             
		<?php echo $form->labelEx($modelp,'first_name'); ?>
		<?php echo $form->textField($modelp,'first_name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($modelp,'first_name'); ?>
	</div>

      <div class="row">
             
		<?php echo $form->labelEx($modelp,'last_name'); ?>
		<?php echo $form->textField($modelp,'last_name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($modelp,'last_name'); ?>
	</div>
        <?php }?>
        <div class="row">
            
                <?php echo $form->labelEx($model,'user_email'); ?>
                <?php echo $form->textField($model,'user_email'); ?>
                <?php echo $form->error($model,'user_email'); ?>
        </div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_password'); ?>
		<?php echo $form->passwordField($model,'user_password',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'user_password'); ?>
	</div>

       <div class="row">
		<?php echo $form->labelEx($model,'user_password2'); ?>
		<?php echo $form->passwordField($model,'user_password2',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'user_password2'); ?>
	</div>
        
	 <?php if(!Yii::app()->user->isGuest) { ?>

	<div class="row">
		<?php echo $form->labelEx($model,'city_id'); ?>

            <?php //$models = City::model()->findAll(); ?>
               <?php $lsd=CHtml::listData(City::model()->findAll(),'city_id','city_name');?>
                 <?php echo $form->dropDownList($model,'city_id',$lsd,array('prompt'=>'Select city'));?>
		<?php //echo $form->textField($model,'city_id'); ?>
		<?php echo $form->error($model,'city_id'); ?>
	</div>
      
	
 

        <div class="row">
		<?php echo $form->labelEx($model,'activation_key'); ?>
		<?php echo $form->textField($model,'activation_key',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'activation_key'); ?>
	</div>

	<div class="row">
                <?php //$listd=CHtml::listData(User::model()->findAll(),'user_id','is_active');?>
		<?php  echo $form->labelEx($model,'is_active'); ?>
		<?php // echo $form->activeDropDownList($model,'is_active',$listd, array('prompt'=>'Select status')); ?>
                <?php echo zHtml::enumDropDownList( $model,'is_active' ); ?>
            
		<?php echo $form->error($model,'is_active'); ?>
	</div>
  

	<div class="row">
		<?php echo $form->labelEx($model,'site_id'); ?>
		<?php $ld=CHtml::listData(SelfSite::model()->findAll(),'site_id','site_name');?>
                 <?php echo $form->dropDownList($model,'site_id',$ld,array('prompt'=>'Select Site'));?>
		<?php echo $form->error($model,'site_id'); ?>
        </div>

        <div class="row">
		<?php echo $form->labelEx($model,'role_id'); ?>
		<?php $rolels=CHtml::listData(UserRole::model()->findAll(),'role_id','role_title');?>
                <?php //echo  $form->dropDownList($model,'role_id',$rolels,array('prompt'=>'Select a Role'));?>
               <?php  // showing data from the webuser class AND the user getAccesslevellist method ?>
		 <?php echo  $form->dropDownList($model,'role_id',$model->accessLevelList); ?>
                 <?php echo $form->error($model,'role_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status_id'); ?>
		<?php echo $form->textField($model,'status_id'); ?>
		<?php echo $form->error($model,'status_id'); ?>
	</div>
     


             
		<?php echo $form->labelEx($modelp,'address'); ?>
		<?php echo $form->textField($modelp,'address',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($modelp,'address'); ?>
	</div>
	    <div class="row">
                    <?php echo $form->labelEx($model,'join_date'); ?>
                    <?php
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'model' => $model,
                        'attribute' => 'join_date',
                        'options' => array(
                      'mode'=>'focus',
                      'dateFormat'=>'d MM, yy',
                      'showAnim' => 'slideDown',
                      ),    
                        'htmlOptions' => array(
                            'size' => '15',// textField size
                            'value'=>date("d F, Y"),
                            'maxlength' => '10',    // textField maxlength
                        ),
                    ));
                    ?>
            <?php echo $form->error($model,'join_date'); ?>
            </div>
       <div class="row"><?php }?>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->