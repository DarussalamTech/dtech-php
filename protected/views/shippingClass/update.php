<?php
/* @var $this ShippingClassController */
/* @var $model ShippingClass */

$this->breadcrumbs=array(
	'Shipping Classes'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

if (!(Yii::app()->user->isGuest)) {
    $this->renderPartial("/common/_left_menu");
}
?>

<h1>Update Shipping Class <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>