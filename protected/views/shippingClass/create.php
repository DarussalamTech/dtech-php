<?php
/* @var $this ShippingClassController */
/* @var $model ShippingClass */

$this->breadcrumbs=array(
	'Shipping Classes'=>array('index'),
	'Create',
);

if (!(Yii::app()->user->isGuest)) {
    $this->renderPartial("/common/_left_menu");
}
?>

<h1>Create Shipping Class</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>