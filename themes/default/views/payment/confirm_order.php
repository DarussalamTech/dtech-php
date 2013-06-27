<?php
$this->webPcmWidget['filter'] = array('name' => 'DtechSecondSidebar',
    'attributes' => array(
        'cObj' => $this,
        'cssFile' => Yii::app()->theme->baseUrl . "/css/side_bar.css",
        'is_cat_filter' => 1,
        ));
?>
<?php
$this->webPcmWidget['best'] = array('name' => 'DtechBestSelling',
    'attributes' => array(
        'cObj' => $this,
        'cssFile' => Yii::app()->theme->baseUrl . "/css/side_bar.css",
        'is_cat_filter' => 0,
        ));
?>
<div id="login_content">
    <div class="payment_method_big_img">
        <?php
        echo CHtml::image(Yii::app()->theme->baseUrl . "/images/place_order_img_03.png", '', array('class' => "payment_method_big_img"));
        ?>
    </div>
    <div class="secure_payment">
        <h2 style="font-size:17px; color:#003366; margin: 20px 0 0 15px;">Your Order Placed Successfully.....</h2>
    </div>
</div>