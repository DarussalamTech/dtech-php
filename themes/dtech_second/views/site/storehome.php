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
                <div id="tweets">
                    <h3><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/tweets_img_03.jpg" /><span>Tweets</span></h3>
                    <p>http://en.wikipedia.org/wiki/ Tweets_For_My_Sweet</p>
                    <p>http://en.wikipedia.org/wiki/ Tweets_For_My_Sweet</p>
                    <p>http://en.wikipedia.org/wiki/ Tweets_For_My_Sweet</p>
                    <p>http://en.wikipedia.org/wiki/ Tweets_For_My_Sweet</p>
                    <p>http://en.wikipedia.org/wiki/ Tweets_For_My_Sweet</p>
                    <article>http://en.wikipedia.org/wiki/ Tweets_For_My_Sweet</article>
                </div>
                <div class="right_under_content">
                    <h5>Bookshelf Favorites</h5>
                    <h6>Save <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/up_to_03.jpg" /> 50%</h6>
                    <article>on Selected Books</article>
                    <p>>Learn more</p>
                    <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/book_with_pages_img_07.png" width="210px" />
                </div>
            </div>
        </div>

    </div>

</div>
