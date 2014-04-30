<?php
/* @var $this ProductTemplateController */
/* @var $model ProductTemplate */

$this->breadcrumbs=array(
	'Product Templates'=>array('index'),
	$model->product_id=>array('view','id'=>$model->product_id),
	'Update',
);

$this->renderPartial("/common/_left_menu");
?>
<div class="pading-bottom-5">
    <div class="left_float">
       <h1>Update Product Template <?php echo $model->product_name; ?></h1>
    </div>

    <?php /* Convert to Monitoring Log Buttons */ ?>
    <div class = "right_float">

    </div>
</div>
<div class="clear"></div>



<?php echo $this->renderPartial('_form', array('model'=>$model,'authorList' => $authorList)); ?>