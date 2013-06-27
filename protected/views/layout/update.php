<?php
/* @var $this LayoutController */
/* @var $model Layout */

$this->breadcrumbs=array(
	'Layouts'=>array('index'),
	$model->layout_id=>array('view','id'=>$model->layout_id),
	'Update',
);

if(!(Yii::app()->user->isGuest)) {
        $this->renderPartial("/common/_left_menu");
}
?>

<h1>Update Layout <?php echo $model->layout_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>