<?php
/* @var $this AuthorController */
/* @var $model Author */

$this->breadcrumbs=array(
	'Authors'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Author', 'url'=>array('index')),
	array('label'=>'Manage Author', 'url'=>array('admin')),
);
?>
<div class="pading-bottom-5">
    <div class="left_float">
        <h1>Create Author</h1>
    </div>

    <?php /* Convert to Monitoring Log Buttons */ ?>
    <div class = "right_float">

    </div>
</div>
<div class="clear"></div>


<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>