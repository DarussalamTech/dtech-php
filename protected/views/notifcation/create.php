<?php
/* @var $this NotifcationController */
/* @var $model Notifcation */

$this->breadcrumbs=array(
	'Notifcations'=>array('index'),
	'Create',
);


?>
<div class="pading-bottom-5">
    <div class="left_float">
        <h1>Compose Notification</h1>
    </div>

    <?php /* Convert to Monitoring Log Buttons */ ?>
    <div class = "right_float">
        <span class="creatdate">
     
        </span>
    </div>
</div>

<div class="clear"></div>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>