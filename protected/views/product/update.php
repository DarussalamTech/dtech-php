<?php
/* @var $this ProductController */
/* @var $model Product */

$this->breadcrumbs=array(
	'Products'=>array('index'),
	$model->product_id=>array('view','id'=>$model->product_id),
	'Update',
);

$this->renderPartial("/common/_left_menu");
?>


<div class="pading-bottom-5">
    <div class="left_float">
       <h1>Update Product <?php echo $model->product_id; ?></h1>
    </div>

    <?php /* Convert to Monitoring Log Buttons */ ?>
    <div class = "right_float">
        <span class="creatdate">
            <?php
            echo CHtml::link("View", $this->createUrl("view", array("id" => $model->primaryKey)), array('class' => "print_link_btn"))
            ?>
        </span>
    </div>
</div>
<div class="clear"></div>
<?php echo $this->renderPartial('_form', array('model'=>$model,

			'cityList'=>$cityList,
			'languageList'=>$languageList,
			'authorList'=>$authorList
    )); ?>