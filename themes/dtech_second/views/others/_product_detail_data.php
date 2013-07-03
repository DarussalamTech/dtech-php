<div class="right_detail">
    <h1><?php echo $product->product_name; ?></h1>

    <p>
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
        echo "(" . round($rating_value) . ")";
        ?>
    </p>
    <h2>
        Price: 
        <span>
            <?php
            echo isset($product->educationToys[0]->price) ? round($product->productProfile[0]->price, 2) . ' ' . Yii::app()->session['currency'] : "";
            ?>

        </span>
    </h2>

    <article>
        <?php
        echo CHtml::textField('quantity', '1', array('onKeyUp' => 'javascript:totalPrice(this.value,"' . $product->productProfile[0]->price . '")', 'style' => 'width:40px', 'maxlength' => '3'));
        ?>
    </article>
    <div class="add_to_cart_button">

        <?php
        echo CHtml::button('Add to Cart', array('onclick' => '
                            jQuery("#loading").show();
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
                                    dtech.custom_alert("Item has added to cart" ,"Add to Cart");
                                }
                                else {
                                    dtech.custom_alert("Item is out of stock" ,"Add to Cart");
                                }
                                dtech_new.loadCartAgain("' . $this->createUrl("/web/cart/loadCart") . '");
                               
                            });    
                      ', 'class' => 'add_to_cart_arrow'));
        ?>
        <?php
        echo CHtml::ajaxLink(' Add to wishlist', $this->createUrl('/cart/addtowishlist'), array('data' => array(
                'product_profile_id' => $product->productProfile[0]->id,
                'city_id' => !empty($_REQUEST['city_id']) ? $_REQUEST['city_id'] : Yii::app()->session['city_id'],
                'city' => !empty($_REQUEST['city_id']) ? $_REQUEST['city_id'] : Yii::app()->session['city_id'],
            ),
            'type' => 'POST',
            'dataType' => 'json',
            'success' => 'function(data){
                                           old_counter = jQuery.trim(jQuery("#wishlist_counter").html());
                                           jQuery("#wishlist_counter").html(data.wishlist_counter);
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
</div>
<div class="product_detail">


    <section>
        Item Code:    <?php
        echo isset($product->educationToys[0]->item_code) ? $product->educationToys[0]->item_code : "";
        ?>
    </section>
    <section>Availability : 
        <?php
        if ($product->productProfile[0]->quantity == 0) {
            echo "No";
        } else {
            echo "Yes";
        }
        ?>
    </section>
    <section>Category: <?php
        if (!empty($product->productCategories)) {
            $cat_count = 0;
            foreach ($product->productCategories as $cat) {
                if ($cat_count == 0) {
                    echo $cat->category->category_name;
                } else {
                    echo ' / ' . $cat->category->category_name;
                }
                $cat_count++;
            }
        }
        ?>
    </section>
    <section>
        <?php
        $profile_id = $product->productProfile[0]->id;
        $attributes = ProductAttributes::model()->ConfAttributes($profile_id);

        foreach ($attributes as $att) {
            echo $att->books_rel->title, ' : ';
            echo $att->attribute_value;
            echo '</br>';
        }
        ?>
    </section>
    <section>Price: <?php
        echo isset($product->educationToys[0]->price) ? round($product->educationToys[0]->price, 2) . ' ' . Yii::app()->session['currency'] : "";
        ?>
    </section>

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