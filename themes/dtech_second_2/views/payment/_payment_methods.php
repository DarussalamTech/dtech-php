<?php
/**
 * form for getting PAYMENT METHOD detail
 * 
 */
?>
<div class="secure_right_form" style="<?php echo empty($paymentMehtods) ? "display:none" : "" ?>">
    <article><span>*</span>Payment Method</article>
    <img src="<?php echo Yii::app()->theme->baseUrl ?>/images/norton_secured_03.png" />
    <div class="secure_input">
        <?php
        
        echo $form->dropDownList($model, 'payment_method', array("" => "Select") +
                CHtml::listData($paymentMehtods, "name", "name"), array("onchange" => "dtech_new.showPaymentMethods(this)")
        );
        ?>
     
    </div>
    <?php
    
    $this->renderPartial("//payment/_credit_card", array(
        "model" => $model,
        "form" => $form,
        "creditCardModel" => $creditCardModel)
    );
     
    ?>
 <?php echo CHtml::submitButton('Submit', array('class' => 'secure_button')); ?>
</div>
