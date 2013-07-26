<?php $this->beginContent('//layouts/main'); ?>
<div id="banner_part">
    <div id="banner">
        <div class="left_banner">
            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/banner_book_img_03.jpg" />
        </div>
        <div class="right_banner">
            <p><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/left_colons_03.jpg" class="left_colon" />A Man who does not read</p><p>has no advantage over</p><p>the man who cannot read.<img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/right_colons_03.jpg" class="right_colon" /></p>
            <article>~ Mark Twain</article>
            <input type="button" value="Shop Now" class="shop_now_button" />
            <div class="banner_dots">
                <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/banner_dots_03.jpg" />
            </div>
        </div>
        <div id="shipping_right_banner">
            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/basket_img_03.jpg" />
            <span>$185.99</span>
            <p>FREE SHIPPING</p>
        </div>
    </div>
</div>
<div id="best_seller_tikker">
    <div id="best_seller_tikker_bar">
        <p>Best Sellers Tikker bar</p>
    </div>
</div>

<?php echo $content; ?>

<?php $this->endContent(); ?>