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
<div class="pading-bottom-5">
    <div class="left_float">
       <h1>Create Shipping Class</h1>
    </div>

    <?php /* Convert to Monitoring Log Buttons */ ?>
    <div class = "right_float">
 
    </div>
</div>
<div class="clear"></div>


<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>