<?php
/* @var $this ZoneController */
/* @var $model Zone */

$this->breadcrumbs = array(
    'Zones' => array('index'),
    $model->name => array('view', 'id' => $model->id),
    'Update',
);

if (Yii::app()->user->isAdmin || Yii::app()->user->isSuperAdmin) {
    $this->renderPartial("/common/_left_menu");
}
?>


<div class="pading-bottom-5">
    <div class="left_float">
       <h1>Update Zone <?php echo $model->id; ?></h1>
    </div>

    <?php /* Convert to Monitoring Log Buttons */ ?>
    <div class = "right_float">
        <span class="creatdate">
            <?php
            if (isset($this->OpPermission[ucfirst($this->id) . ".View"]) && $this->OpPermission[ucfirst($this->id) . ".View"]) {
                echo CHtml::link("View", $this->createUrl("view", array("id" => $model->primaryKey)), array('class' => "print_link_btn"));
            }
            ?>
        </span>
    </div>
</div>
<div class="clear"></div>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>