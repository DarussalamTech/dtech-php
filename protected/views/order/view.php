<?php
/* @var $this OrderController */
/* @var $model Order */
//ColorBox::registerScripts();
$this->breadcrumbs = array(
    'Orders' => array('index'),
    $model->order_id,
);
if (!(Yii::app()->user->isGuest)) {
    $this->renderPartial("/common/_left_single_menu");
}
if (Yii::app()->user->hasFlash('status')) {
    echo CHtml::openTag("div", array("class" => "flash-success"));
    echo Yii::app()->user->getFlash("status");
    echo CHtml::closeTag("div");
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
            <?php
            if (isset($this->OpPermission[ucfirst($this->id) . ".Update"]) && $this->OpPermission[ucfirst($this->id) . ".Update"]) {
                echo CHtml::link("print", $this->createUrl("print", array("id" => $model->primaryKey)), 
                        array('class' => "print_link_btn","onclick"=>"dtech.printPreview(this);return false;"));
            }
            ?>
        </span>
    </div>
</div>
<div class="clear"></div>
<p>
    <b>Information:</b>
    <br/>
    If Order Status changes Completed to Declined = Then Quantity will be reverted to Products
    <br/>
    If Order Status changes process to Completed = Then Quantity will be decreased to Products
</p>

<div class="clear"></div>
<div style="width:50%;float:left">
    <?php
    $this->widget('zii.widgets.CDetailView', array(
        'data' => $model,
        'attributes' => array(
            array(
                'name' => 'user_id',
                'value' => !empty($model->user->user_email) ? $model->user->user_email : "",
            ),
            'transaction_id',
            'status',
            'order_date',
            'update_time',
            'total_price',
            array('name' => 'currency', 'value' => Yii::app()->session["currency"]),
            array(
                'name' => 'payment_method_id',
                'value' => !empty($model->paymentMethod->name) ? $model->paymentMethod->name : "",
            ),
        ),
    ));
    ?>
</div>
<div style="width:50%;float:left">
    <?php
    /**
     * if allow update 
     */
    if ($this->OpPermission['Order.Update'] == true) {
        $this->widget('zii.widgets.jui.CJuiTabs', array(
            'tabs' => array(
                'Order Status Change' => $this->renderPartial("_order_status_change", array("model" => $order_history,), true, true), 'Order History' => $this->renderPartial("_order_status_grid", array("model" => $model), true, true)
            ),
            'options' => array(),
        ));
    }
    ?>
</div>

<div class="clear"></div>
<h1>User information of [<?php echo $model->user->user_email ?>]</h1>
<div class="clear"></div>
<div style="float: left;width:49%">
    <?php
    /**
     * user information
     */ $this->renderPartial('_user_billing_information', array(
        'user_id' => $model->user->user_id,
        'user_name' => $model->user->user_email,
    ));
    ?>
</div>

<div style="float: left;width:49%">
    <?php
    /**
     * user information
     */ $this->renderPartial('_user_shipping_information', array(
        'user_id' => $model->user->user_id,
        'user_name' => $model->user->user_email,
    ));
    ?>
</div>
<div class="clear"></div>
<div>
    <?php
    /**
     * product stock
     */ $this->renderPartial('_order_detail', array(
        'model' => $model_d,
        'user_name' => $model->user->user_email,
    ));
    ?>
</div>

