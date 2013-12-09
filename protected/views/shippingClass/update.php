<?php
/* @var $this ShippingClassController */
/* @var $model ShippingClass */

$this->breadcrumbs=array(
	'Shipping Classes'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

if (!(Yii::app()->user->isGuest)) {
    $this->renderPartial("/common/_left_menu");
}
?>
<div class="pading-bottom-5">
    <div class="left_float">
        <h1>Update Shipping Class [<?php echo $model->title; ?>]</h1>
    </div>

    <?php /* Convert to Monitoring Log Buttons */ ?>
    <div class = "right_float">
        <span class="creatdate">
            <?php
            //if (isset($this->OpPermission[ucfirst($this->id) . ".Update"]) && $this->OpPermission[ucfirst($this->id) . ".Update"]) {
                echo CHtml::link("view", $this->createUrl("view", array("id" => $model->primaryKey)), array('class' => "print_link_btn"));
           // }
            ?>
        </span>
    </div>
</div>
<div class="clear"></div>


<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>