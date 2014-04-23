<?php
/* @var $this NotifcationController */
/* @var $model Notifcation */

$this->breadcrumbs=array(
	'Notifcations'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'COPY',
);


?>

<div class="pading-bottom-5">
    <div class="left_float">
        <h1>Forward THIS MESSAGE [<?php echo $model->subject; ?>]</h1>
    </div>

    <?php /* Convert to Monitoring Log Buttons */ ?>
    <div class = "right_float">
      
    </div>
</div>


<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>