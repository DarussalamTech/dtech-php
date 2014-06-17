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


<div class="pading-bottom-5">
    <div class="left_float">
      <h1>Update Translator Compiler <?php echo $model->id; ?></h1>
    </div>
</div>

<div class="clear"></div>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>