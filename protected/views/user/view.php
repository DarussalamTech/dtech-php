<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs = array(
    'Users' => array('index'),
    $model->user_id,
);

if (!(Yii::app()->user->isGuest)) {
    $this->renderPartial("/common/_left_menu");
}
?>


<div class="pading-bottom-5">
    <div class="left_float">
        <h1>View User #<?php echo $model->user_id; ?></h1>
    </div>

    <?php /* Convert to Monitoring Log Buttons */ ?>
    <div class = "right_float">
        <span class="creatdate">
            <?php
            if (isset($this->OpPermission[ucfirst($this->id) . ".Update"]) && $this->OpPermission[ucfirst($this->id) . ".Update"]) {
                echo CHtml::link("Edit", $this->createUrl("update", array("id" => $model->primaryKey)), array('class' => "print_link_btn"));
            }
            ?>
        </span>
    </div>
</div>
<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'user_email',
        array(
            'name' => 'status_id',
            'value' => $model->status->title,
        ),
        array(
            'name' => 'city_id',
            'value' => !empty($model->city) ? $model->city->city_name : "",
        ),
        'site_id',
    ),
));
?>
