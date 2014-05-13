<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->user_id=>array('view','id'=>$model->user_id),
	'Update',
);

$this->menu=array();
?>
<div class="pading-bottom-5">
    <div class="left_float">
       <h1>Dear: <?php echo $model->user_email; ?>  Update your Profile</h1>
    </div>

</div>
<div class="clear"></div>


<?php echo $this->renderPartial('_form_profile', array('model'=>$model)); ?>