<?php
/* @var $this TranslatorCompilerController */
/* @var $model TranslatorCompiler */

$this->breadcrumbs=array(
	'Translator Compilers'=>array('index'),
	$model->name,
);

if(!(Yii::app()->user->isGuest)) {
        $this->renderPartial("/common/_left_menu");
}
?>

<h1>View Translator Compiler #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		
		'name',
		'type',
		
	),
)); ?>
