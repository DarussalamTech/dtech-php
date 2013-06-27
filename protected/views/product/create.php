<?php
/* @var $this ProductController */
/* @var $model Product */

$this->breadcrumbs=array(
	'Products'=>array('index'),
	'Create',
);

$this->renderPartial("/common/_left_menu");
?>

<h1>Create Product</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,
         
			'cityList'=>$cityList,
			'languageList'=>$languageList,
			'authorList'=>$authorList
    )); ?>