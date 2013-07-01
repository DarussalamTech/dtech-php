<?php
/* @var $this OrderController */
/* @var $model Order */

$this->breadcrumbs = array(
    'Orders' => array('index'),
    $model->order_id,
);
if (!(Yii::app()->user->isGuest)) {
    $this->renderPartial("/common/_left_single_menu");
}
?>


<div class="pading-bottom-5">
    <div class="left_float">
        <h1>View Order #<?php echo $model->order_id; ?></h1>
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
        array(
            'name' => 'user_id',
            'value' => !empty($model->user->user_email) ? $model->user->user_email : "",
        ),
        'total_price',
        'order_date',
        'status',
        'transaction_id',
        array(
            'name' => 'payment_method_id',
            'value' => !empty($model->paymentMethod->name) ? $model->paymentMethod->name : "",
        ),
    ),
));
?>

<div>
    <?php
    $this->renderPartial('_order_detail', array(
        'model' => $model_d,
        'user_name' => $model->user->user_email,
    ));
    ?>
</div>
