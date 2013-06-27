<?php
/* @var $this OrderController */
/* @var $model Order */
/* @var $form CActiveForm */
?>

<div class="wide form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
    ));
    ?>




    <div class="row">
        <?php echo $form->label($model, 'total_price'); ?>
        <?php echo $form->textField($model, 'total_price', array('size' => 10, 'maxlength' => 10)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'status'); ?>
        <?php echo $form->dropDownList($model, 'status', 
                    array(
                        'process' => "process", 
                        'approved' => "approved",
                        'completed' => "completed",
                        'declined' => "declined",
                      )
                ); ?>
    </div>


    <div class="row">
        <?php echo $form->label($model, 'payment_method_id'); ?>
        <?php
        $criteria = new CDbCriteria();
        $criteria->select = "id,name";
        $paymentModels = ConfPaymentMethods::model()->findAll($criteria);
        echo $form->dropDownList(
                $model, 'payment_method_id', CHtml::listData($paymentModels, "id", "name"));
        ?>
    </div>

    <div class="row buttons">
<?php echo CHtml::submitButton('Search'); ?>
    </div>

        <?php $this->endWidget(); ?>

</div><!-- search-form -->