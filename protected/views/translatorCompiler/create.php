<?php
/* @var $this TranslatorCompilerController */
/* @var $model TranslatorCompiler */

$this->breadcrumbs=array(
	'Translator Compilers'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TranslatorCompiler', 'url'=>array('index')),
	array('label'=>'Manage TranslatorCompiler', 'url'=>array('admin')),
);
?>

<h1>Create Translator Compiler</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>