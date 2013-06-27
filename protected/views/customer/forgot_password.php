<div class="form"> 
<?php
 $form=$this->beginWidget('CActiveForm', array(
         'id'=>'email-form',
           'enableClientValidation'=>true,
            ));
 ?>
    <?php if(Yii::app()->user->hasFlash('incorrect_email') || Yii::app()->user->hasFlash('password_reset')
       || Yii::app()->user->hasFlash('superAdmin')) { ?>

<div class="flash-success" align="center">
	<?php echo Yii::app()->user->getFlash('incorrect_email'); ?>
            <?php echo Yii::app()->user->getFlash('password_reset'); ?>
    <?php echo Yii::app()->user->getFlash('superAdmin'); ?>
</div>

<?php } ?>
    <div class="row" align="center">
         
        <?php echo $form->labelEx(User::model(),'Please enter your email address'); ?>
		<?php echo CHtml::textField('email'); ?>
		<?php echo CHtml::submitButton('Send'); ?>
                <?php echo $form->error(User::model(),'user_email'); ?>
          
        
          
</div></div>
<?php   $this->endWidget(); ?>