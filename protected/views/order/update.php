<h1>Update Status</h1>
<?php
if (!(Yii::app()->user->isGuest)) {
    $this->renderPartial("/common/_left_single_menu");
}
?>
<p>
    <b>Information:</b>
    <br/>
    If Order Status changes Completed to Declined = Then Quantity will be reverted to Products
    <br/>
    If Order Status changes process to Completed = Then Quantity will be decreased to Products

    <br/><br/>

    Pending > Shipped = Decrease in stock<br/>
    Pending >Process> Shipped = Decrease in stock<br/>
    Shipped > Refund = Increase in stock<br/>
    Shipped > Cancel = Increase in stock<br/>
</p>
<div class="form wide">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'layout-form',
        'enableAjaxValidation' => false,
    ));
    ?>
    <div class="row">
        <?php echo $form->label($model, 'status'); ?>
        <?php
        /**
         * only situation that user wont be shown its old staus in drop donw
         */
        echo ($orderStatuses[$model->status]);
        ?>
    </div>
    <div class="row">
        <?php echo $form->label($model, 'Change'); ?>
        <?php
        /**
         * only situation that user wont be shown its old staus in drop donw
         */
        echo $model->listing_status;
        ?>
    </div>
    <div class="row">
        <?php echo $form->label($model, 'notifyUser'); ?>
        <?php
        echo $form->checkBox($model, 'notifyUser');
        ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array("class" => "btn")); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- for