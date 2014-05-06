<?php $this->beginContent('//layouts/main'); ?>
<script type="text/javascript">
    /**
     * slider timings
     * @type undefined
     */
    var slider_timings = <?php echo!empty(Yii::app()->params['slider_time']) ? Yii::app()->params['slider_time'] : 10; ?>;
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
        $criteria = new CDbCriteria;
        $criteria;
        $criteria->select = "id,image,title,product_id";
        $criteria->addCondition("t.city_id = ".$_REQUEST['city_id']);
        $slider = Slider::model()->with('slider')->findAll($criteria);

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
                        echo Chtml::link(CHtml::image(Yii::app()->baseUrl . "/uploads/slider/" . $data->id . "/" . $data->image), $this->createUrl('/web/product/productDetail', array(
                                    'country' => Yii::app()->session['country_short_name'],
                                    'city' => Yii::app()->session['city_short_name'],
                                    'city_id' => Yii::app()->session['city_id'],
                                    "pcategory" => $data->slider->parent_category->category_slug,
                                    "slug" => $data->slider->slag,
                        )));
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

                    echo Chtml::link('Product Detail', $this->createUrl('/web/product/productDetail', array(
                                'country' => Yii::app()->session['country_short_name'],
                                'city' => Yii::app()->session['city_short_name'],
                                'city_id' => Yii::app()->session['city_id'],
                                "pcategory" => $data->slider->parent_category->category_slug,
                                "slug" => $data->slider->slag,
                            )), array('class' => 'sliderDetail'));
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
                        if (!empty($data->slider->productProfile[0]->price)) {
                            echo Yii::app()->session['currency'] . " " . number_format($data->slider->productProfile[0]->price, 2, '.', '');
                        }
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

        <div class="best_book">
            <p>Best Book:<?php
                $order_detail = new OrderDetail;
                $dataProvider = $order_detail->bestSellings('1');
                $products = $order_detail->getBestSelling($dataProvider);
                foreach ($products as $best) {
                    echo CHtml::link($best['product_name'], $this->createUrl('/web/product/productDetail', array(
                                'country' => Yii::app()->session['country_short_name'],
                                'city' => Yii::app()->session['city_short_name'],
                                'city_id' => Yii::app()->session['city_id'],
                                "pcategory" => $best['category'],
                                "slug" => $best['slug'],
                    )));
                    break;
                }
                ?></p>
        </div>

    </div>
</div>

<?php echo $content; ?>

<?php $this->endContent(); ?>