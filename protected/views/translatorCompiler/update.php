<?php
/* @var $this TranslatorCompilerController */
/* @var $model TranslatorCompiler */

$this->breadcrumbs=array(
	'Translator Compilers'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

if(!(Yii::app()->user->isGuest)) {
        $this->renderPartial("/common/_left_menu");
}
?>

<h1>Update TranslatorCompiler <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>