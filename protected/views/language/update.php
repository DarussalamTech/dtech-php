<?php
/* @var $this LanguageController */
/* @var $model Language */

$this->breadcrumbs=array(
	'Languages'=>array('index'),
	$model->language_id=>array('view','id'=>$model->language_id),
	'Update',
);

if(!(Yii::app()->user->isGuest)) {
        $this->renderPartial("/common/_left_menu");
}
?>

<h1>Update Language <?php echo $model->language_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>