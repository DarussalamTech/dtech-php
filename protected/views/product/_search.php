<?php
/* @var $this ProductController */
/* @var $model Product */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'product_id'); ?>
		<?php echo $form->textField($model,'product_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'product_name'); ?>
		<?php echo $form->textField($model,'product_name',array('size'=>60,'maxlength'=>255)); ?>
	</div>



	<div class="row">
		<?php echo $form->label($model,'is_featured'); ?>
		<?php echo $form->dropDownList($model,'is_featured',array("1"=>"Yes","0"=>"No")); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search', array("class" => "btn")); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->