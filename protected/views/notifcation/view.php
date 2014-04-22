<?php
/* @var $this NotifcationController */
/* @var $model Notifcation */

$this->breadcrumbs = array(
    'Notifcations' => array('index'),
    $model->id,
);

?>


<div class="pading-bottom-5">
    <div class="left_float">
        <h1>View Notification</h1>
    </div>

    <?php /* Convert to Monitoring Log Buttons */ ?>
    <div class = "right_float">
        <span class="creatdate">
            <?php
            echo CHtml::link("Forward", $this->createUrl("/notifcation/copy", array("id" => $model->primaryKey)), array(
                'class' => "print_link_btn",
            ));
            ?>
        </span>
    </div>
</div>

<div class="clear"></div>
<?php
if (Yii::app()->user->hasFlash('status')) {
    echo CHtml::openTag("div", array("class" => "flash-success"));
    echo Yii::app()->user->getFlash("status");
    echo CHtml::closeTag("div");
}
echo '<div class="clear"></div>';
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        array(
            'name' => 'form',
            'value' => $model->from_rel->user_email
        ),
        array(
            'name' => 'to',
            'value' => $model->to
        ),
        array(
            'name' => 'subject',
            'value' => $model->subject
        ),
        array(
            'name' => 'body',
            'value' => $model->body,
            "type" => 'raw',
        ),
    ),
));
?>
