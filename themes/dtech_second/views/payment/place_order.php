<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/form.css');
?>
<div id="login_content" class="place_order">


    <div class="secure_form">
        <div class="payment_method_big_img">
            <?php
            echo CHtml::image(Yii::app()->theme->baseUrl . "/images/place-order2.png", 'Payment_method', array('class' => "payment_method_big_img"));
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
        /*edited by Niki Choudhary*/
        $buying_products = array(); /* this will contain all the products information to send to 2CO for payment*/
        $buyer_info = array();
        
        $cart = $cart->getData();
        /*Saving Shipppin information in the 2Checkout FOrm to submit on 2CO payment environment*/
        $buyer_info['order_id'] = $userShipping['order_id'];
        $buyer_info['user_full_name'] = $userShipping['shipping_first_name']." ".$userShipping['shipping_last_name'];
        $buyer_info['shipping_address1'] = $userShipping['shipping_address1'];
        $buyer_info['shipping_country'] = $userShipping->country['name'];
        $buyer_info['shipping_state'] = $userShipping['shipping_state'];
        $buyer_info['shipping_city'] = $userShipping['shipping_city'];
        $buyer_info['shipping_zip'] = $userShipping['shipping_zip'];
        $buyer_info['shipping_phone'] = $userShipping['shipping_phone'];
        $buyer_info['shipping_mobile'] = $userShipping['shipping_mobile'];
        //set the presentation for user to display his amount on his/her country
        $useCurrency = "";
        if (!empty($userShipping->country->currency_code) && $userShipping->country->currency_code != Yii::app()->session['currency']) {
            $useCurrency = $userShipping->country->currency_code;
        }

        $cart_html .= "<div class='login_img  '>";
        $cart_html .= "<p>";

        $cart_html .= "<span class='p-title'>Product Title</span>";
        $cart_html .= "<span class='p-title'>Quantity</span> ";
        $cart_html .="<b class='p-title'>Item Price</b>";
        
        if ($useCurrency != "") {
           // $cart_html .="<b class='p-title'>Item Price in " . $useCurrency . "</b>";
        }
        $cart_html .= "</p>";
        $cart_html .= " </div>";
        $cart_html .= "<div class='clear'></div>";

        $books_range = array("price_range" => 0, "weight_range" => 0, 'categories' => array());
        $other_range = array("price_range" => 0, "weight_range" => 0, 'categories' => array());
        //will be used in international shipping 
        $total_weight = 0;
        foreach ($cart as $pro) {
            $grand_total = $grand_total + ($pro->quantity * $pro->productProfile->price);
            $total_quantity+=$pro->quantity;
            
            $buying_products[$count]['product_quantity'] = $pro->quantity;
            $buying_products[$count]['product_price'] = ConfPaymentMethods::model()->convertCurrency(($pro->productProfile->price), Yii::app()->session['currency'], "USD");
            $buying_products[$count]['product_name'] = $pro->productProfile->product->product_name;
            $buying_products[$count]['product_id'] = $pro->productProfile->product->product_id;
            
            if ($count % 2 == 0) {
                $css_alternat = "alternate_row_cart";
            } else {
                $css_alternat = "";
            }

            /*
             * it is check for pk darussalam
             * to whether they want to use this this
             */
            
            $prod_weight = (double) (isset($pro->productProfile->weight) ? $pro->productProfile->weight : 0);
            //echo $pro->productProfile->weight_unit . "--=" . $prod_weight . "--" . $pro->productProfile->id;

            if ($pro->productProfile->weight_unit == "g" && $prod_weight > 0) {
                $prod_weight = $prod_weight / 1000;
            }

            if ($pro->productProfile->product->parent_category->category_name == "Books" ||
                    $pro->productProfile->product->parent_category->category_name == "Quran") {



                $books_range['price_range'] = $books_range['price_range'] + ($pro->quantity * $pro->productProfile->price);
                $books_range['weight_range'] = $books_range['weight_range'] + $prod_weight;
                //if unit is gram then it converted to kg


                $books_range['categories'][$pro->productProfile->product->parent_cateogry_id] = $pro->productProfile->product->parent_cateogry_id;
            } else {



                $other_range['price_range'] = $other_range['price_range'] + ($pro->quantity * $pro->productProfile->price);
                $other_range['weight_range'] = $other_range['weight_range'] + $prod_weight;
                $other_range['categories'][$pro->productProfile->product->parent_cateogry_id] = $pro->productProfile->product->parent_cateogry_id;
            }
            $total_weight+=$prod_weight;

            $cart_html .= "<div class='login_img  " . $css_alternat . "'>";
            $cart_html .= "<p>";

            $cart_html .= "<span class='p-values'>" . substr($pro->productProfile->product->product_name, 0, 100) . "</span>";
            $cart_html .= "<span class='p-values'>" . $pro->quantity . "</span> ";
            $cart_html .="<b class='p-values'>" . Yii::app()->session['currency'] . " " . round($pro->quantity * $pro->productProfile->price, 2) . "</b>";
            if ($useCurrency != "") {
               // $cart_html .="<b class='p-values'>" . $useCurrency . " " . ConfPaymentMethods::model()->convertCurrency(round($pro->quantity * $pro->productProfile->price, 2), Yii::app()->session['currency'], $useCurrency) . "</b>";
            }
            $cart_html .= "</p>";
            $cart_html .= " </div>";
            $count++;
        }
        ?> 

        <?php
                
        echo $cart_html;
        $shipping_cost = 0;
        $shippingPresentation = "";
        $total_weight = 35;


        //same is current city of website may pakistan (lahore) , saudi arab (Jaddah)
        if (strtolower(Yii::app()->user->WebCity->country->country_name) == strtolower($userShipping->country->name)) {
            $is_source = 1;
            if (strtolower(Yii::app()->session['city_short_name']) != strtolower($userShipping->shipping_city)) {
                $is_source = 0;
            }

            $shipping_price_books = ShippingClass::model()->calculateShippingCost($books_range['categories'], $books_range['price_range'], "price", $is_source);
            $shipping_price_other = ShippingClass::model()->calculateShippingCost($other_range['categories'], $other_range['weight_range'], "weight", $is_source);

            $shipping_cost = $shipping_price_books + $shipping_price_other;

            $this->setShippingCost($shipping_cost);
        } else {

            $shipping_rate_id = 0;
            $criteria = new CDbCriteria;


            $condition = "zone_id = " . $userShipping->country->zone->id . " AND ";

            $condition.= " rate_type = 'dhl' AND weight >= " . $total_weight;
            $criteria->addCondition($condition);

            if ($zone_rate = ZoneRates::model()->find($criteria)) {
                $shipping_cost = (double) str_replace(",", "", $zone_rate->rate);
                //presentation to show user how we doen

                $shippingPresentation = $this->renderPartial("//payment/_shipping_formula_presentation", array("zone_single_rate" => $zone_rate, "total_weight" => $total_weight,"useCurrency"=>$useCurrency), true);
                $shipping_rate_id = $zone_rate->dhlRatesLastHist->id;
            } else {
                //in case weight not found in category

                $criteria = new CDbCriteria;
                $criteria->limit = 2;
                $criteria->order = "id DESC";
                $condition = "zone_id = " . $userShipping->country->zone->id . " AND ";

                $condition.= " rate_type = 'dhl' ";
                $criteria->addCondition($condition);
                $zone_rate = ZoneRates::model()->findAll($criteria);


                //$zone_rate[1] is last weight rate
                //$zone_rate[0] is multiply rate for increasing of 1000 g or 1 kg

                $incrment_rate = $zone_rate[0]->rate;
                $weight_to_multiply = ceil($total_weight - $zone_rate[1]->weight) * $zone_rate[0]->rate;
                $shipping_cost = $weight_to_multiply + str_replace(",", "", $zone_rate[1]->rate);

                //presentation to show user how we doen
                $shipping_rate_id = $zone_rate[1]->dhlRatesLastHist->id;
                $shippingPresentation = $this->renderPartial("//payment/_shipping_formula_presentation", array("zone_rate" => $zone_rate, "total_weight" => $total_weight,"useCurrency"=>$useCurrency), true);
            }
            $this->setShippingCost($shipping_cost, $shipping_rate_id);
        }
        ?>

        <div class='login_img'>
            <p>
                <span class='p-values'>Sub Total</span>
                <span class='p-values'>&nbsp;</span>

                <b class='p-values'>
                    <?php echo Yii::app()->session['currency'] . " " . $grand_total; ?>
                </b>
                <?php
                if ($useCurrency != "") {
                    //echo "<b class='p-values'>" . $useCurrency . " " . ConfPaymentMethods::model()->convertCurrency($grand_total, Yii::app()->session['currency'], $useCurrency) . "</b>";
                }
                ?>
            </p>
            <?php echo $shippingPresentation; ?>
            <p>
                <span class='p-values'>Shipping Cost</span>
                <span class='p-values'>
                    <?php
                    if ($useCurrency != "") {
                        //echo "<b class='p-values'>" . $useCurrency . " " . ConfPaymentMethods::model()->convertCurrency(str_replace(",","",$shipping_cost), Yii::app()->session['currency'], $useCurrency) . "</b>";
                    }
                    ?>
                </span>
                <b class='p-values p-right-full'>
                    <?php echo Yii::app()->session['currency'] . " " . $shipping_cost; ?>
                    <?php
                    $grand_total = ($grand_total + (double) $shipping_cost);
                    $tax_rate = ConfTaxRates::model()->getTaxRate($grand_total);
                    
                    $this->setTaxAmount($tax_rate);
                    ?>
                </b>
            </p>

            <div class="clear"></div>
            <div style="margin-right: 10px;font-weight: bold">
                <p>
                    <span class="p-values">Tax : </span>  
                    <span class='p-values'>
                        <?php
                        if ($useCurrency != "" && ($tax_rate > 0 || $tax_rate != "")) {
                            //echo "<b class='p-values'>" . $useCurrency . " " . ConfPaymentMethods::model()->convertCurrency($tax_rate, Yii::app()->session['currency'], $useCurrency) . "</b>";
                        }
                        //0775433582
                        ?>
                    </span> 
                    <span class="p-values p-right-full"><?php echo Yii::app()->session['currency'] . " " . $tax_rate; ?></span> 
                </p>
            </div>
            <div class="clear"></div>
            <div style="margin-right: 10px;font-weight: bold">
                <p><span class="p-values">TOTAL : </span>
                    <span class="p-values">
                        <?php
                        if ($useCurrency != "") {
                            $converted_total = ConfPaymentMethods::model()->convertCurrency(($grand_total + (double) $tax_rate), Yii::app()->session['currency'], $useCurrency);
                            $this->setCurrencyAmount($converted_total);
                            echo "<b class='p-values'>" . $useCurrency . " " .$converted_total  . "</b>";
                            
                        }
                        //$buyer_info['grand_total'] = ($grand_total + (double) $tax_rate);
                        $buyer_info['grand_total'] = ConfPaymentMethods::model()->convertCurrency(($grand_total + (double) $tax_rate), Yii::app()->session['currency'], "USD");
                        $buyer_info['total_quantity'] = $total_quantity;
                        ?>
                    </span>
                    <span class="p-right-full"><?php echo Yii::app()->session['currency'] . " " . ($grand_total + (double) $tax_rate); ?> </span></p>
            </div>
        </div>
        <div class="clear"></div>
        <?php
       
        $form = $this->beginWidget('CActiveForm', array(
           'id' => 'myCCForm',
            'action' => Yii::app()->params['TwoCheckout']['twocheckoutPaymentUrlProduction'],
            'method' => 'post',
            /*'enableClientValidation' => true,
            'clientOptions' => array(
                'validateOnSubmit' => false,
            ),*/
        ));
        echo $form->hiddenField($userShipping, 'payment_method');


        //if payment method is credit card then
        if ($userShipping->payment_method == "Credit Card") {
            $this->renderPartial("//payment/_credit_card", array(
                "model" => $userShipping,
                "form" => $form,
                "buyer_info" => $buyer_info,
                "buying_products" => $buying_products,
                "creditCardModel" => $creditCardModel)
            );
        }
        echo CHtml::submitButton('Order', array('class' => 'secure_button'));
        $this->endWidget();
        ?>
    </div>

</div>


