<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs = array(
    'Users' => array('index'),
    $model->user_id => array('view', 'id' => $model->user_id),
    'Update',
);

$this->renderPartial("/common/_left_single_menu");
?>


<div class="pading-bottom-5">
    <div class="left_float">
        <h1>Update User <?php echo $model->user_id; ?></h1>

        <?php /* Convert to Monitoring Log Buttons */ ?>
        <div class = "right_float">
            <span class="creatdate">

            </span>
        </div>
    </div>
</div>    
<div class="clear"></div> 

<?php echo $this->renderPartial('_form', array('model' => $model, 'cityList' => $cityList,)); ?>