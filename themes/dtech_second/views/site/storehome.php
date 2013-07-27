<?php
/*
 * jquery code to load the featurd product on page loading by:ubd
 */
Yii::app()->clientScript->registerScript('load_featured', 'jQuery(document).ready(function() {
        jQuery("#featured_buttons,input.feature_btn ").children().eq(0).trigger("click")})');
?>
<div id="main_features_part">
    <div id="features_part">
        <div id="main_features">
            <h1>Main Features</h1>
            <div class="main_features_books_part">
                <div class="qurani_books">
                    <?php
                    echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl . "/images/quran.png", '', array(
                            )), $this->createUrl('/web/quran/index'));
                    ?>

                    <h2>
                        <?php echo Yii::t('common', 'Quran', array(), NULL, $this->currentLang); ?>
                    </h2>
                    <p>&nbsp;</p>

                    <?php
                    echo CHtml::button(Yii::t('common', 'Shop Now', array(), NULL, $this->currentLang), array(
                        "class" => "shop_now",
                        "onclick" => "window.location ='" . $this->createUrl('/web/quran/index') . "'"
                    ));
                    ?>
                </div>

                <div class="qurani_books">
                    <?php
                    echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl . "/images/books.png", '', array(
                            )), $this->createUrl('/web/product/allproducts'));
                    ?>

                    <h2>
                        <?php echo Yii::t('common', 'Books', array(), NULL, $this->currentLang); ?>
                    </h2>
                    <p>&nbsp;</p>

                    <?php
                    echo CHtml::button(Yii::t('common', 'Shop Now', array(), NULL, $this->currentLang), array(
                        "class" => "shop_now",
                        "onclick" => "window.location ='" . $this->createUrl('/web/product/allproducts') . "'"
                    ));
                    ?>
                </div>

                <div class="qurani_books">
                    <?php
                    echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl . "/images/toys.png", '', array(
                            )), $this->createUrl('/web/educationToys/index'));
                    ?>

                    <h2>
                        <?php echo Yii::t('common', 'Educational Toys', array(), NULL, $this->currentLang); ?>
                    </h2>
                    <p>&nbsp;</p>

                    <?php
                    echo CHtml::button(Yii::t('common', 'Shop Now', array(), NULL, $this->currentLang), array(
                        "class" => "shop_now",
                        "onclick" => "window.location ='" . $this->createUrl('/web/educationToys/index') . "'"
                    ));
                    ?>
                </div>

                <div class="qurani_books">
                    <?php
                    echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl . "/images/other.png", '', array(
                            )), $this->createUrl('/web/others/index'));
                    ?>

                    <h2>
                        <?php echo Yii::t('common', 'Other Items', array(), NULL, $this->currentLang); ?>
                    </h2>
                    <p>&nbsp;</p>

                    <?php
                    echo CHtml::button(Yii::t('common', 'Shop Now', array(), NULL, $this->currentLang), array(
                        "class" => "shop_now",
                        "onclick" => "window.location ='" . $this->createUrl('/web/others/index') . "'"
                    ));
                    ?>
                </div>


            </div>
        </div>

        <div id="featured_books">
            <div id="left_featured">
                <h1>
                    <?php echo Yii::t('common', 'Featured Books', array(), NULL, $this->currentLang); ?>
                </h1>
                <div id="featured_buttons">
                    <?php
                    echo CHtml::button(Yii::t('common', 'Featured', array(), NULL, $this->currentLang), array(
                        "class" => "feature_btn",
                        "url" => $this->createUrl("/site/fillFeaturedBox"),
                        "onclick" => "dtech_new.fillFeaturedBox(this)"));
                    ?>
                    <?php
                    echo CHtml::button(Yii::t('common', 'Latest', array(), NULL, $this->currentLang), array(
                        "class" => "feature_btn",
                        "url" => $this->createUrl("/site/fillFeaturedBox"),
                        "onclick" => "dtech_new.fillFeaturedBox(this)"));
                    ?>
                    <?php
                    echo CHtml::button(Yii::t('common', 'Best Seller', array(), NULL, $this->currentLang), array(
                        "class" => "feature_btn",
                        "url" => $this->createUrl("/site/fillFeaturedBox"),
                        "onclick" => "dtech_new.fillFeaturedBox(this)"));
                    ?>


                </div>

                <div class='featured_box'>

                </div>

            </div>
            <div id="right_featured">
                <?php $this->renderPartial("//layouts/_sidebars") ?>
            </div>
        </div>

    </div>

</div>
