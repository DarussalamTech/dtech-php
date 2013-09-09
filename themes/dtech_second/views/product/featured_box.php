<?php
foreach ($products as $product):
    $name = str_replace("_", " ", $product['product_name']);

    $image = $product['no_image'];
    $cssclass = "no_image";
    if (isset($product['image'][0]['image_small'])) {
        $image = $product['image'][0]['image_small'];
        $cssclass = "";
    }
    ?>
    <div class="featured_cover">
        <div class="featured_cover_part">

            <?php
            //echo CHtml::link(CHtml::image($image, ""), $this->createUrl('/web/product/productDetail', array('product_id' => $product['product_id'])), array('title' => $name));
            echo CHtml::link(CHtml::image($image, 'image', array("title" => "", "class" => $cssclass)), $this->createUrl('/web/product/productDetail', array(
                        'country' => Yii::app()->session['country_short_name'],
                        'city' => Yii::app()->session['city_short_name'],
                        'city_id' => Yii::app()->session['city_id'],
                        "pcategory" => $product['category'],
                        "slug" => $product['slug'],
                    )), array('title' => $name));
            ?>
            <h2><?php echo substr($name, 0, 37) . '...'; ?></h2>
            <p>
                <?php
//                if (!empty($product['product_overview'])) {
//                    echo substr($product['product_overview'], 0, 20);
//                } else {
//                    echo "&nbsp;";
//                }
                ?>
            </p>
        </div>
        <div class="featured_bottom">
            <span><?php echo Yii::app()->session['currency'] . " " . round($product['product_price'], 2); ?></span>
            <?php
            /**
             * quantity check for displaying 
             * image that available or not
             */
            if ($product['quantity'] > 0):
                echo CHtml::openTag("div", array(
                    'class' => 'white_basket',
                    'onclick' => '
                           jQuery("#loading").show();
                            jQuery("#status_available").hide();  
                            jQuery("#status_un_available").hide();  
                            jQuery.ajax({
                                type: "POST",
                                dataType: "json",
                                url: "' . $this->createUrl("/cart/addtocart", array("product_profile_id" => $product['product_profile_id'])) . '",
                                data: 
                                    { 
                                        quantity: 1,
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
                         '
                        )
                );

                echo CHtml::image(Yii::app()->theme->baseUrl . '/images/white_basket_03.jpg');
                echo CHtml::closeTag("div");
            else :

                echo CHtml::openTag("div", array(
                    'class' => 'white_basket',
                        )
                );

                echo CHtml::image(Yii::app()->theme->baseUrl . '/images/basket_not-avail.jpg');
                echo CHtml::closeTag("div");
            endif;
            ?>
        </div>
    </div>

    <?php
endforeach;
?>
