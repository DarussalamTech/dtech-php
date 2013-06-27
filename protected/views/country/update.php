<?php
/* @var $this CountryController */
/* @var $model Country */

$this->breadcrumbs=array(
	'Countries'=>array('index'),
	$model->country_id=>array('view','id'=>$model->country_id),
	'Update',
);

if(!(Yii::app()->user->isGuest)) {
        $this->renderPartial("/common/_left_menu");
}
?>

<h1>Update Country <?php echo $model->country_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>