<?php
/* @var $this AuthorController */
/* @var $model Author */

$this->breadcrumbs=array(
	'Authors'=>array('index'),
	$model->author_id=>array('view','id'=>$model->author_id),
	'Update',
);

if(!(Yii::app()->user->isGuest)) {
        $this->renderPartial("/common/_left_menu");
}
?>

<h1>Update Author <?php echo $model->author_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>