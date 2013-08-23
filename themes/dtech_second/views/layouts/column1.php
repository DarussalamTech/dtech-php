<?php $this->beginContent('//layouts/main'); ?>
<script type="text/javascript">
    $(document).ready(function() {
        dtech_new.makeSlider();
    });
</script>
<div id="banner_part">
    <div id="banner">
        <?php
        /**
         * slider images come from here
         */
        $slider = slider::model()->findAll();
        $counter = 1;
        foreach ($slider as $data):
            $style = "display:none";
            /**
             * if first image then it wont be
             * hidden
             */
            if ($counter == 1) {
                $style = "";
            }
            ?>
            <div id="banner_slider_<?php echo $counter ?>" 
                 class="banner_slider" style="<?php echo $style; ?>">
                <div class="left_banner">
                    <?php
                    if (empty($slider->image)) {
                        echo CHtml::image(Yii::app()->baseUrl . "/uploads/slider/" . $data->id . "/" . $data->image);
                    } else {
                        echo CHtml::image(Yii::app()->theme->baseUrl . "/images/banner_book_img_03.jpg");
                    }
                    ?>

                </div>
                <div class="right_banner">
                    <p><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/left_colons_03.jpg" class="left_colon" />
                        <?php echo $data->title ?>
                        <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/right_colons_03.jpg" class="right_colon" /></p>

                    <?php
                    echo CHtml::Button("Shop Now", array(
                        'class' => 'shop_now_button',
                        'onclick' => '
                            jQuery("#loading").show();
                            jQuery("#status_available").hide();  
                            jQuery("#status_un_available").hide();  
                            jQuery.ajax({
                                type: "POST",
                                dataType: "json",
                                url: "' . $this->createUrl("/cart/addtocart", array("product_profile_id" => $data->slider->productProfile[0]->id)) . '",
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
                    ?>

                    <div class="banner_dots">
                        <?php
                        /**
                         * slider logo
                         */
                        $count = 1;
                        foreach ($slider as $data2):
                            ?>
                            <a id="cs-button-coin-<?php echo $count; ?>" class="cs-button-coin <?php echo ($count == 1) ? "cs-active" : ""; ?>" href="javascript:void(0)"><?php echo $count; ?></a>
                            <?php
                            $count++;
                        endforeach;
                        ?>
                    </div>
                </div>
                <div id="shipping_right_banner">

                    <span>
                        <?php
                        echo Yii::app()->session['currency'] . " " . $data->slider->productProfile[0]->price;
                        ?>
                    </span>

                </div>
            </div>

            <?php
            $counter++;
        endforeach;
        ?>
    </div>
</div>
<div id="best_seller_tikker">
    <div id="best_seller_tikker_bar">
        <p>Best Sellers Tikker bar</p>
    </div>
</div>

<?php echo $content; ?>

<?php $this->endContent(); ?>