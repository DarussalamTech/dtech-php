<?php
$grand_total = 0;
$total_quantity = 0;
$count = 1;
$css_alternat = "";
$cart_html = "";
$cart = $cart->getData();
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
    $cart_html .= $pro->quantity;
    $cart_html .= substr($pro->productProfile->product->product_name, 0, 20) . "..";
    $cart_html .="<b>" . Yii::app()->session['currency'] . " " . round($pro->quantity * $pro->productProfile->price, 2) . "</b>";
    $cart_html .= "</p>";
    $cart_html .= " </div>";
    $count++;
}
?> <div  >
    <?php
    echo $cart_html;
    ?>
    <div >
        <p>TOTAL : <?php echo Yii::app()->session['currency'] . " " . $grand_total; ?> </p>


    </div>
</div>