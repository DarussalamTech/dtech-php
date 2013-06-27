<?php
/* @var $this CityController */
/* @var $model City */

$this->breadcrumbs=array(
	'Cities'=>array('index'),
	$model->city_id=>array('view','id'=>$model->city_id),
	'Update',
);

if(!(Yii::app()->user->isGuest)) {
        $this->renderPartial("/common/_left_menu");
}
?>

<h1>Update City <?php echo $model->city_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>