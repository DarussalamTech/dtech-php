<?php
$grand_total = 0;
$total_quantity = 0;
$count = 1;
$css_alternat = "";
$cart_html = "";
$cart = $cart->getData();

$cart_html .= "<div class='login_img  '>";
$cart_html .= "<p>";

$cart_html .= "<span style='font-weight:bold;width:150px;float:left;'>Product Title</span>";
$cart_html .= "<span style='font-weight:bold;margin-left:50px;'>Quantity</span> ";
$cart_html .="<b>Item Price</b>";
$cart_html .= "</p>";
$cart_html .= " </div>";

$books_range = array("price_range" => 0, "weight_range" => 0, 'categories' => array());
$other_range = array("price_range" => 0, "weight_range" => 0, 'categories' => array());
foreach ($cart as $pro) {
    $grand_total = $grand_total + ($pro->quantity * $pro->productProfile->price);
    $total_quantity+=$pro->quantity;
    if ($count % 2 == 0) {
        $css_alternat = "alternate_row_cart";
    } else {
        $css_alternat = "";
    }

    /*
     * it is check for pk darussalam
     * to whether they want to use this this
     */
    if ($pro->productProfile->product->parent_category->category_name == "Books" ||
            $pro->productProfile->product->parent_category->category_name == "Quran") {
        $books_range['price_range'] = $books_range['price_range'] + ($pro->quantity * $pro->productProfile->price);
        $books_range['weight_range'] = $books_range['weight_range'] + (isset($pro->productProfile->weight_rel) ? $pro->productProfile->weight_rel->title : 0);
        $books_range['categories'][] = $pro->productProfile->product->parent_cateogry_id;
    } else {
        $other_range['price_range'] = $books_range['price_range'] + ($pro->quantity * $pro->productProfile->price);
        $other_range['weight_range'] = $books_range['weight_range'] + (isset($pro->productProfile->weight_rel) ? $pro->productProfile->weight_rel->title : 0);
        $other_range['categories'][] = $pro->productProfile->product->parent_cateogry_id;
    }

    $cart_html .= "<div class='login_img  " . $css_alternat . "'>";
    $cart_html .= "<p>";

    $cart_html .= "<span style=';width:150px;float:left;'>" . substr($pro->productProfile->product->product_name, 0, 30) . "..</span>";
    $cart_html .= "<span style='font-weight:bold;margin-left:50px;'>" . $pro->quantity . "</span> ";
    $cart_html .="<b>" . Yii::app()->session['currency'] . " " . round($pro->quantity * $pro->productProfile->price, 2) . "</b>";
    $cart_html .= "</p>";
    $cart_html .= " </div>";
    $count++;
}
?> 
<div>
    <?php
    echo $cart_html;
    $shipping_price_books = ShippingClass::model()->calculateShippingCost($books_range['categories'], $books_range['price_range'], "price");
    $shipping_price_other = ShippingClass::model()->calculateShippingCost($other_range['categories'], $other_range['weight_range'], "weight");
    $shipping_cost = $shipping_price_books+$shipping_price_other;
    ?>

    <div class='login_img'>
        <p>
            <span style='font-weight:bold;width:150px;float:left;'>Shipping Cost</span>
            <span style='font-weight:bold;margin-left:50px;'></span>
            <b>
                <?php echo $shipping_cost; ?>
            </b>
        </p>

        <div style="float:right;margin-right: 10px">
            <p>TOTAL : <?php echo Yii::app()->session['currency'] . " " . $grand_total+$shipping_cost; ?> </p>
        </div>
    </div>
    <div class="clear"></div>