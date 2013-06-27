<?php
/* @var $this CategoriesController */
/* @var $model Categories */

$this->breadcrumbs=array(
	'Categories'=>array('index'),
	'Create',
);

if(!(Yii::app()->user->isGuest)) {
        $this->renderPartial("/common/_left_menu");
}
?>

<h1>Create Categories</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,
                        'categoriesList'=>$categoriesList,
                        'cityList'=>$cityList)); ?>