<h2><?php echo $product->product_name; ?></h2>

<section>
    <?php
    echo Yii::t('model_labels', 'Price', array(), NULL, $this->currentLang) . ":";
    ?> <b>
        <?php
        echo isset($product->productProfile[0]->price) ? round($product->productProfile[0]->price, 2) . ' ' . Yii::app()->session['currency'] : "";
        ?>
    </b>
</section>
<article><?php
    echo Yii::t('model_labels', 'Quantity', array(), NULL, $this->currentLang) . ":";
    ?> 
    <?php
    $total_in_cart = Cart::model()->getTotalCountProduct($product->productProfile[0]->id);
    $total_av = $product->productProfile[0]->quantity - $total_in_cart;
    echo $total_av;
    ?>
</article>
<?php
/** rating value is comming from controller * */
$this->widget('CStarRating', array(
    'name' => 'ratings',
    'minRating' => 1,
    'maxRating' => 5,
    'starCount' => 5,
    'value' => round($rating_value),
    'readOnly' => true,
));
?>
<article>
    <?php
    if ($total_av >= 1) {
        echo CHtml::textField('quantity', '1', array('onKeyUp' => 'javascript:totalPrice(this.value,"' . $product->productProfile[0]->price . '")', 'style' => 'width:40px', 'maxlength' => '3'));
    }
    ?>
     <span id="status_available" style="display:none">
        <?php echo CHtml::image(Yii::app()->theme->baseUrl . '/images/tick_03.jpg'); ?>

        <?php
        echo Yii::t('model_labels', ' Available in this quantity', array(), NULL, $this->currentLang) . ":";
        ?>
    </span>
    <span id="status_un_available" style="display:none">
        <?php echo CHtml::image(Yii::app()->theme->baseUrl . '/images/no.png'); ?>

        <?php
        echo Yii::t('model_labels', ' Not available in this quantity', array(), NULL, $this->currentLang) . ":";
        ?>
    </span>
</article>
<div class="detail_shop_now">
    <?php
    if ($total_av > 1) {
        echo CHtml::button(Yii::t('common', 'SHOP NOW', array(), NULL, $this->currentLang), array('onclick' => '
                            jQuery("#loading").show();
                            jQuery("#status_available").hide();  
                            jQuery("#status_un_available").hide();  
                            jQuery.ajax({
                                type: "POST",
                                dataType: "json",
                                url: "' . $this->createUrl("/cart/addtocart", array("product_profile_id" => $product->productProfile[0]->id)) . '",
                                data: 
                                    { 
                                        quantity: jQuery("#quantity").val(),
                                    }
                                }).done(function( msg ) {
                               
                                jQuery("#loading").hide();
                                if(msg["total_available"]>0){
                                    jQuery("#status_available").show();  
                                    dtech.custom_alert("Item has added to cart" ,"Add to Cart");
                                }
                                else {
                                    jQuery("#status_un_available").show();    
                                    dtech.custom_alert("Item is out of stock" ,"Add to Cart");
                                }
                                dtech_new.loadCartAgain("' . $this->createUrl("/web/cart/loadCart") . '");
                               
                            });    
                      ',
            'class' => 'add_to_cart_arrow',
        ));
    } else {
        if (!empty(Yii::app()->user->id)) {
            echo CHtml::button(Yii::t('common', 'Email me when available', array(), NULL, $this->currentLang), array('onclick' => '
                                dtech_new.loadWaitmsg();
                               jQuery("#load_subpanel_div").toggle(); 
                               jQuery.ajax({
                                    type: "POST",
                                    dataType: "json",
                                    url: "' . $this->createUrl("/cart/emailtous", array("product_profile_id" => $product->productProfile[0]->id)) . '",
                                    data: 
                                        { 

                                        }
                                    }).done(function( msg ) {      
                                        jQuery("#load_subpanel_div").hide(); 
                                        dtech.custom_alert("You will be notified by email" ,"Notification");
                                }); 
                          ', 'class' => 'add_to_cart_arrow email_cart_arrow'));
        } else {

            echo CHtml::button(Yii::t('common', 'Email me when available', array(), NULL, $this->currentLang), array(
                'onclick' => '
                       window.open(
                        "' . $this->createUrl("/web/cart/emailtoAdmin", array("id" => $product->productProfile[0]->id)) . '", "" )     
                ', 'class' => 'add_to_cart_arrow email_cart_arrow'));
        }
    }
    ?>

    <?php
    echo CHtml::ajaxButton(Yii::t('common', 'ADD TO WISHLIST', array(), NULL, $this->currentLang), $this->createUrl('/cart/addtowishlist'), array('data' => array(
            'product_profile_id' => $product->productProfile[0]->id,
            'city_id' => !empty($_REQUEST['city_id']) ? $_REQUEST['city_id'] : Yii::app()->session['city_id'],
            'city' => !empty($_REQUEST['city_id']) ? $_REQUEST['city_id'] : Yii::app()->session['city_id'],
        ),
        'type' => 'POST',
        'dataType' => 'json',
        'success' => 'function(data){
                                           old_counter = jQuery.trim(jQuery("#wishlist_counter").html());
                                           jQuery(".wishlist_counter span").html(data.wishlist_counter);
                                           if(old_counter < data.wishlist_counter){
                                                 dtech.custom_alert("Item has added to Wishlist","Add to Wishlist");
                                           }
                                           else {
                                                dtech.custom_alert("Already in Wishlist", "Add to Wishlist");
                                           }
                                      }',
            ), array('id' => 'add-wish-list' . uniqid(), 'class' => 'add_to_wish_list')
    );
    ?>



</div>

<script>
    function totalPrice(quantity, price)
    {
        if (dtech.isNumber(quantity))
        {
            //total_price = quantity * price;
            //jQuery('#price').html('$ ' + total_price);
        }
        else
        {
            dtech.custom_alert('Quantity should be Numeric....!');
            jQuery('#quantity').val('1');
        }
    }
</script>
