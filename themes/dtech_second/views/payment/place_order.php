<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/form.css');
?>
<div id="login_content">


    <div class="secure_form">
        <div class="payment_method_big_img">
            <?php
            echo CHtml::image(Yii::app()->theme->baseUrl . "/images/payment_method_big_img_03.png", 'Payment_method', array('class' => "payment_method_big_img"));
            ?>
        </div>
        <div class="secure_payment">
            <div class="secure_heading">
                <h1>Secure Payment</h1>
                <p>This is a secure 128 bit SSL encrypter payment</p>
            </div>
            <div class="payment_bg">
                <article><?php echo CHtml::image(Yii::app()->theme->baseUrl . '/images/tick_payment_img_03.png'); ?></article>
                <section style="cursor: pointer">
                    <?php
                    echo CHtml::image(
                            Yii::app()->theme->baseUrl . '/images/tick_payment_img_03.png', '', array('onclick' => 'window.location = "' . $this->createUrl("/web/payment/paymentmethod", array("step" => "billing")) . '"')
                    );
                    ?>
                </section>
                <section style="cursor: pointer">
                    <?php
                    echo CHtml::image(
                            Yii::app()->theme->baseUrl . '/images/tick_payment_img_03.png', '', array('onclick' => 'window.location = "' . $this->createUrl("/web/payment/paymentmethod") . '"')
                    );
                    ?>
                </section>

                <span>Personal Information</span>
                <h5>Billing Address</h5>
                <h2>Shipping Address.</h2>
            </div>
        </div>
        <div class="clear"></div>
        <?php
        $grand_total = 0;
        $total_quantity = 0;
        $count = 1;
        $css_alternat = "";
        $cart_html = "";
        $cart = $cart->getData();

        $cart_html .= "<div class='login_img  '>";
        $cart_html .= "<p>";

        $cart_html .= "<span style='font-weight:bold;width:400px;float:left;'>Product Title</span>";
        $cart_html .= "<span style='font-weight:bold;margin-left:50px;'>Quantity</span> ";
        $cart_html .="<b>Item Price</b>";
        $cart_html .= "</p>";
        $cart_html .= " </div>";
        $cart_html .= "<div class='clear'></div>";

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

            $cart_html .= "<span style=';width:400px;float:left;'>" . substr($pro->productProfile->product->product_name, 0, 100) . "</span>";
            $cart_html .= "<span style='font-weight:bold;margin-left:50px;'>" . $pro->quantity . "</span> ";
            $cart_html .="<b>" . Yii::app()->session['currency'] . " " . round($pro->quantity * $pro->productProfile->price, 2) . "</b>";
            $cart_html .= "</p>";
            $cart_html .= " </div>";
            $count++;
        }
        ?> 

        <?php
        echo $cart_html;
       
        $shipping_price_books = ShippingClass::model()->calculateShippingCost($books_range['categories'], $books_range['price_range'], "price");
        $shipping_price_other = ShippingClass::model()->calculateShippingCost($other_range['categories'], $other_range['weight_range'], "weight");
        $shipping_cost = $shipping_price_books + $shipping_price_other;

        $this->setTotalAmountSession($grand_total, $total_quantity, "", $shipping_cost);
        ?>

        <div class='login_img'>
            <p>
                <span style='font-weight:bold;width:150px;float:left;'>Shipping Cost</span>
                <span style='font-weight:bold;margin-left:50px;'></span>
                <b>
                    <?php echo $shipping_cost; ?>
                    <?php
                        $grand_total = ($grand_total + (double) $shipping_cost);
                        $tax_rate = ConfTaxRates::model()->getTaxRate($grand_total);
                    ?>
                </b>
            </p>

            <div style="float:right;margin-right: 10px;font-weight: bold">
                <p>Tax : <?php echo Yii::app()->session['currency'] . " " .$tax_rate ; ?> </p>
            </div>
            <div class="clear"></div>
            <div style="float:right;margin-right: 10px;font-weight: bold">
                <p>TOTAL : <?php echo Yii::app()->session['currency'] . " " . ($grand_total + (double) $tax_rate); ?> </p>
            </div>
        </div>
        <div class="clear"></div>
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'card-form',
            'enableClientValidation' => true,
            'clientOptions' => array(
                'validateOnSubmit' => false,
            ),
        ));
        echo $form->hiddenField($userShipping,'payment_method');
        //if payment method is credit card then
        if ($userShipping->payment_method == "Credit Card") {
            $this->renderPartial("//payment/_credit_card", array(
                "model" => $userShipping,
                "form" => $form,
                "creditCardModel" => $creditCardModel)
            );
        }
        echo CHtml::submitButton('Submit', array('class' => 'secure_button'));
        $this->endWidget();
        ?>
    </div>

</div>


