<?php
/* @var $this ZoneController */
/* @var $model Zone */

$this->breadcrumbs=array(
	'Zones'=>array('index'),
	'Create',
);

if (Yii::app()->user->isAdmin || Yii::app()->user->isSuperAdmin) {
    $this->renderPartial("/common/_left_menu");
}
?>


<div class="pading-bottom-5">
    <div class="left_float">
       <h1>Create Zone</h1>
    </div>
</div>
<div class="clear"></div>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>