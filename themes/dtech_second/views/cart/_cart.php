<div id="cart_row" onclick='jQuery("#cart_click").trigger("click");'>
    <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/shopping_cart_img_03.jpg" 
         class="cart_img" />
    <span>Shopping Cart</span>
    <?php
    $cart = $cart->getData();
    ?>
    <article>
        <?php
            if(count($cart)<=1){
                echo count($cart) . " item";
            }
            else {
                echo count($cart) . " item(s)";
            }
        ?>
    </article> 
</div>

<?php
$grand_total = 0;
$total_quantity = 0;
$count = 1;
$css_alternat = "";
$cart_html = "";
foreach ($cart as $pro) {
    $grand_total = $grand_total + ($pro->quantity * $pro->productProfile->price);
    $total_quantity+=$pro->quantity;
    if ($count % 2 == 0) {
        $css_alternat = "alternate_row_cart";
    } else {
        $css_alternat = "";
    }
    $cart_html .= "<div class='login_img  " . $css_alternat . "'>";
    $cart_html .= "<p>";
    $cart_html .= CHtml::textField('quantity' . $pro->cart_id, $pro->quantity, array(
                "class" => "tafsir_text",
                "onkeyup" => "
                            dtech_new.updateCart('" . $this->createUrl('/web/cart/editcart') . "',this,'" . $pro->cart_id . "');
                    ")
    );
    $cart_html .= substr($pro->productProfile->product->product_name, 0, 20) . "..";
    $cart_html .="<b>" . Yii::app()->session['currency'] . " " . round($pro->quantity * $pro->productProfile->price, 2) . "</b>";
    $cart_html .= "</p>";
    $cart_html .= " </div>";
    $count++;
}
$this->setTotalAmountSession($grand_total, $total_quantity, "");
?>

<span id="cart_span" onclick='jQuery("#cart_click").trigger("click");'> - <?php echo Yii::app()->session['currency'] . " " . $grand_total; ?></span>
<div class="cart_arrow">

    <?php
    echo CHtml::image(Yii::app()->theme->baseUrl . "/images/cart_down_arrow_03.png", '', array(
        "unhover" => Yii::app()->theme->baseUrl . "/images/cart_down_arrow_03.png",
        "hover" => Yii::app()->theme->baseUrl . "/images/cart_up_arrow_03.jpg",
        "id" => "cart_click",
        "onclick" => "dtech_new.showCartBox(this)"
    ));
    ?>
    <div style="clear:both"></div>
    <div class="cart_bx" id="scroll-pane" >
        <?php
        echo $cart_html;
        ?>
        <div class="checkout">
            <p>TOTAL : <?php echo Yii::app()->session['currency'] . " " . $grand_total; ?> </p>

            <?php
            if (!empty($cart)) {
                echo CHtml::button("CHECKOUT", array(
                    "class" => "checkout_btn",
                    "onclick" => "window.location = '" . $this->createUrl('/web/cart/viewcart') . "'"));
            } else {
                echo CHtml::button("CHECKOUT", array(
                    "class" => "checkout_btn",
                    "onclick" => "window.location = '" . $this->createUrl('/web/cart/viewcart') . "'"));
            }
            ?>
        </div>
    </div>
</div>

<style>
    #scroll-pane,.scroll-pane { overflow:scroll;height:300px;border:1px solid #666;}


</style>