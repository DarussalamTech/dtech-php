<div id="left_description">
    <div id="image_detail">
        <?php //$this->dtdump($product);die; ?>
        <div class="left_detail">

            <?php
            $detail_img = $product->no_image;
            if (!empty($product->productProfile[0])) {
                if (!empty($product->productProfile[0]->productImages[0])) {
                    $detail_img = CHtml::image($product->productProfile[0]->productImages[0]->image_url['image_large'], '', array("id" => "large_image", 'style' => 'width:124px; height:181px'));
                    echo CHtml::link($detail_img, $product->productProfile[0]->productImages[0]->image_url['image_large'], array("rel" => 'lightbox[_default]'));
                } else {
                    $detail_img = CHtml::image($product->no_image);
                    echo CHtml::link($detail_img, $product->no_image, array("rel" => 'lightbox[_default]'));
                }
            }
            ?>



            <?php //echo CHtml::image(Yii::app()->theme->baseUrl . "/images/gems_and_jewels_book_03.png");  ?>
        </div>
        <div class="right_detail">
            <h1>Gems and Jewels</h1>
            <h2>Author: <span> 
                    <?php
                    echo isset($product->author->author_name) ? $product->author->author_name : "";
                    ?>
                </span></h2>
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
                echo '('.round($rating_value).')';
                ?>
            </p>
            <article>Length :500 Pages</article>
            <div class="add_to_cart_button">
                <input type="button" value="Add to Cart >" class="add_to_cart_arrow" />
                <script>
                    (function(d, s, id) {
                        var js, fjs = d.getElementsByTagName(s)[0];
                        if (d.getElementById(id))
                            return;
                        js = d.createElement(s);
                        js.id = id;
                        js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=<?php echo Yii::app()->params['fb_key']; ?>";
                        fjs.parentNode.insertBefore(js, fjs);
                    }(document, 'script', 'facebook-jssdk'));
                </script>

                <!--            <div class="fly_product_hover">
                            </div>
                            <div class="f_product_hover">
                            </div>
                            <div class="t_product_hover">
                            </div>-->
                <a href="#">
                    <div class="fb-like" data-href="<?php echo Yii::app()->request->hostInfo . Yii::app()->request->requestUri; ?>" data-send="false" data-layout="button_count" data-width="200" data-show-faces="true"></div>

                </a>
                <a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo Yii::app()->request->hostInfo . Yii::app()->request->requestUri; ?>">Tweet</a>
                <script>!function(d, s, id) {
                        var js, fjs = d.getElementsByTagName(s)[0], p = /^http:/.test(d.location) ? 'http' : 'https';
                        if (!d.getElementById(id)) {
                            js = d.createElement(s);
                            js.id = id;
                            js.src = p + '://platform.twitter.com/widgets.js';
                            fjs.parentNode.insertBefore(js, fjs);
                        }
                    }(document, 'script', 'twitter-wjs');</script>


                <script src="//platform.linkedin.com/in.js" type="text/javascript">
                    lang: en_US
                </script>
                <script type="IN/Share" data-counter="right"></script>
                <?php //echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl . "/images/f_imgs_03.png"), $this->createUrl('/web/hybrid/login/', array("provider" => "facebook")), array("onclick" => "dtech.doSocial('login-form',this);return false;"));   ?>
                <?php //echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl . "/images/bird_img_03.png"), $this->createUrl('/web/hybrid/login/', array("provider" => "twitter")), array("onclick" => "dtech.doSocial('login-form',this);return false;")); ?>
                <?php //echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl . "/images/p_img_03.png"), $this->createUrl('/web/hybrid/login/', array("provider" => "google")), array("onclick" => "dtech.doSocial('login-form',this);return false;")); ?>
            </div>
        </div>
        <div class="product_detail">
            <h3>Product Detail</h3>
            <section>Product Details</section>
            <section>Hardcover: 416 pages</section>
            <section>Publisher: Harper Collins; 1st edition (March 2, 2004)</section>
            <section>Language: English</section>
            <section>ISBN-10: 0060391448</section>
            <section>ISBN-13: 978-0060391447</section>
            <section>Product Dimensions: 9.4 x 6.6 x 1.4 inches</section>
            <section>Shipping Weight: 1.2 pounds (View shipping rates and policies)</section>
            <section>Average Customer Review: 3.5 out of 5 stars  See all reviews (2,006 customer reviews)</section>
        </div>
    </div>
</div>