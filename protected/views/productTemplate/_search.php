<?php
/* @var $this ProductTemplateController */
/* @var $model ProductTemplate */
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
		<?php echo $form->label($model,'universal_name'); ?>
		<?php echo $form->textField($model,'universal_name',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'parent_id'); ?>
		<?php echo $form->textField($model,'parent_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'slag'); ?>
		<?php echo $form->textField($model,'slag',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'parent_cateogry_id'); ?>
		<?php echo $form->textField($model,'parent_cateogry_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'product_description'); ?>
		<?php echo $form->textArea($model,'product_description',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'product_overview'); ?>
		<?php echo $form->textArea($model,'product_overview',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'city_id'); ?>
		<?php echo $form->textField($model,'city_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'is_featured'); ?>
		<?php echo $form->textField($model,'is_featured',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'product_rating'); ?>
		<?php echo $form->textField($model,'product_rating'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'authors'); ?>
		<?php echo $form->textField($model,'authors',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'shippable_countries'); ?>
		<?php echo $form->textField($model,'shippable_countries',array('size'=>60,'maxlength'=>900)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'create_time'); ?>
		<?php echo $form->textField($model,'create_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'create_user_id'); ?>
		<?php echo $form->textField($model,'create_user_id',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'update_time'); ?>
		<?php echo $form->textField($model,'update_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'update_user_id'); ?>
		<?php echo $form->textField($model,'update_user_id',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search',array("class"=>"btn")); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->