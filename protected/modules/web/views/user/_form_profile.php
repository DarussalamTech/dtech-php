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
        
	

	<div class="row">
		<?php echo $form->labelEx($model,'city_id'); ?>

            <?php //$models = City::model()->findAll(); ?>
               <?php $lsd=CHtml::listData(City::model()->findAll(),'city_id','city_name');?>
                 <?php echo $form->dropDownList($model,'city_id',$lsd,array('prompt'=>'Select city'));?>
		<?php //echo $form->textField($model,'city_id'); ?>
		<?php echo $form->error($model,'city_id'); ?>
	</div>
      
	


      <?php if(!Yii::app()->user->isSuperAdmin) { ?> 

	<div class="row">
                <?php //$listd=CHtml::listData(User::model()->findAll(),'user_id','is_active');?>
		<?php  echo $form->labelEx($model,'is_active'); ?>
		<?php // echo $form->activeDropDownList($model,'is_active',$listd, array('prompt'=>'Select status')); ?>
                <?php echo zHtml::enumDropDownList( $model,'is_active' ); ?>
            
		<?php echo $form->error($model,'is_active'); ?>
	</div>
  
      <?php } ?>
       <div class="row">
             
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

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->