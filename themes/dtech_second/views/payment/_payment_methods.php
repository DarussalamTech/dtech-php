<?php
/**
 * form for getting PAYMENT METHOD detail
 * 
 */
?>
<script type="text/javascript">
    
    /*checking payment_method value on page load*/
    $(document).ready(function(){
        if($("#ShippingInfoForm_payment_method").val() == "Credit Card")
        {
            $("#shipping_charges_info").css("display","block");
            $("#shipping_type_lbl").css("display","block");
            $("#ShippingInfoForm_shipping_type").css("display","block");
        }
        else
        {
            $("#shipping_charges_info").css("display","none");    
            $("#shipping_type_lbl").css("display","none");
            $("#ShippingInfoForm_shipping_type").css("display","none");
        }
    });
    
    /** checking the value of the payment method dropdown when selecting credit card
     *  then it will display the applying shipping_type for the payment_method 
     */
    function load_shipping_detail(payment_method)
    {
        if(payment_method.value == "Credit Card")
        {
            $("#shipping_charges_info").css("display","block");
            $("#shipping_type_lbl").css("display","block");
            $("#ShippingInfoForm_shipping_type").css("display","block");
        }
        else
        {
            $("#shipping_charges_info").css("display","none");    
            $("#shipping_type_lbl").css("display","none");
            $("#ShippingInfoForm_shipping_type").css("display","none");
        }
    }
    
    /*shipping type validating rule */
    function is_shipping_type_empty()
    {
        if($("#ShippingInfoForm_payment_method").val() == "Credit Card" && $("#ShippingInfoForm_shipping_type").val() == "select"){
           $("#shipping_type_err").css("display",'block'); 
            return false;
        }else{
            return true;
        }
    }
</script>

<div class="secure_right_form" style="<?php echo empty($paymentMehtods) ? "display:none" : "" ?>">
    <article><span>*</span>Payment Method</article>
    <img src="<?php echo Yii::app()->theme->baseUrl ?>/images/norton_secured_03.png" />

    <div class="secure_input" id="peyment_methods_list">
        <?php
        $_ship_url = $this->createUrl("/web/payment/calculateShipping");
        echo $form->dropDownList($model, 'payment_method', array("" => "Select") +
                CHtml::listData($paymentMehtods, "name", "name"),  array("onchange"=>"load_shipping_detail(this)")
        );
        ?>
        <?php echo $form->error($model, 'payment_method'); ?>
        <div class="clear"></div>
        <p style="display:none;" id="shipping_charges_info">Extra shipping and tax charges will be deducted on Credit Card Payment</p>
        <div class="clear"></div>
        <article style="display: none;" id="shipping_type_lbl"><span >*</span>Shipping Type</article>    
        <?php //echo CHtml::dropDownList("shipping_type", array("local"=>"Local(Within Pakistan)"), array("local"=>"Local(Within Pakistan)","international"=>"International(Other Country)"),array("style"=>"display:none;","id"=>"shipping_type"));?>
        <?php echo $form->dropDownList($model,"shipping_type", array("select"=>"Select","local"=>"Local(Within Pakistan)","international"=>"International(Other Country)"),array("style"=>"display:none"));?>
        
        <?php echo $form->error($model, 'payment_method'); ?>
        <?php //echo $form->span($model, 'shipping_type'); ?>
        <div id="shipping_type_err" style="color:red;font-size : 12px;display:none;">Shipping Type cannot be empty</div>
    </div>

    <?php
    $this->renderPartial("//payment/_credit_card", array(
        "model" => $model,
        "form" => $form,
        "creditCardModel" => $creditCardModel)
    );
    ?>
    <div class="clear"></div>
    <div id="cost_shipping">

    </div>
    <?php echo CHtml::submitButton('Submit', array('class' => 'secure_button','onclick'=>'return is_shipping_type_empty()')); ?>
</div>
