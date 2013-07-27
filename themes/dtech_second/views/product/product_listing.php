<?php
$cs = Yii::app()->clientScript;
$cs->registerCssFile(Yii::app()->theme->baseUrl . '/css/list.css');
?>
<div id="main_features_part">
    <div id="features_part">
        <div id="featured_books">
            <div id="right_featured">
                <div class="list_all">
                    <h1>List All</h1>
                    <div class="listing">
                        <p><a href="#">
                                <img src="<?php echo Yii::app()->theme->baseUrl ?>/images/bottom_list_03.jpg"> Quran</a>
                        </p>
                        <div class="inner_list">
                            <li><a href="#">ABC</a></li>
                            <li><a href="#">DEF</a></li>
                            <li><a href="#">GHI</a></li>
                        </div>
                    </div>
                    <div class="listing">
                        <p><a href="#"><img src="<?php echo Yii::app()->theme->baseUrl ?>/images/list_arrow_03.jpg"> Books</a></p>
                    </div>
                    <div class="listing">
                        <p><a href="#"><img src="<?php echo Yii::app()->theme->baseUrl ?>/images/list_arrow_03.jpg"> Books</a></p>
                    </div>
                    <div class="listing">
                        <p><a href="#"><img src="<?php echo Yii::app()->theme->baseUrl ?>/images/list_arrow_03.jpg"> Books</a></p>
                    </div>
                    <div class="listing">
                        <p><a href="#"><img src="<?php echo Yii::app()->theme->baseUrl ?>/images/list_arrow_03.jpg"> Books</a></p>
                    </div>
                    <div class="listing">
                        <p><a href="#"><img src="<?php echo Yii::app()->theme->baseUrl ?>/images/list_arrow_03.jpg"> Books</a></p>
                    </div>
                </div>
                <div id="tweets">
                    <h3><img src="<?php echo Yii::app()->theme->baseUrl ?>/images/tweets_img_03.jpg"><span>Tweets</span></h3>
                    <p>http://en.wikipedia.org/wiki/ Tweets_For_My_Sweet</p>
                    <p>http://en.wikipedia.org/wiki/ Tweets_For_My_Sweet</p>
                    <p>http://en.wikipedia.org/wiki/ Tweets_For_My_Sweet</p>
                    <p>http://en.wikipedia.org/wiki/ Tweets_For_My_Sweet</p>
                    <p>http://en.wikipedia.org/wiki/ Tweets_For_My_Sweet</p>
                    <article>http://en.wikipedia.org/wiki/ Tweets_For_My_Sweet</article>
                </div>
                <div class="right_under_content">
                    <h5>Bookshelf Favorites</h5>
                    <h6>Save <img src="<?php echo Yii::app()->theme->baseUrl ?>/images/up_to_03.jpg"> 50%</h6>
                    <article>on Selected Books</article>
                    <p>&gt;Learn more</p>
                    <img width="210px" src="<?php echo Yii::app()->theme->baseUrl ?>/images/book_with_pages_img_07.png">
                </div>
            </div>

       
           
            <div id="list_featured">
                <h6><?php echo Yii::t('common', 'All Books', array(), NULL, $this->currentLang); ?></h6>
                <?php
                $this->renderPartial("//product/_product_list", array(
                    'products' => $products,
                    'dataProvider' => $dataProvider,
                    'allCate' => $allCate));
                ?>
            </div>
             <div class="clear"></div>
                 <div class="pagingdiv" style="display: none" >
                <?php
                $this->widget('DTScroller', array(
                    'pages' => $dataProvider->pagination,
                    'ajax' => true,
                    'append_param' => (!empty($_REQUEST['serach_field'])) ? "serach_field=" . $_REQUEST['serach_field'] : "",
                    'jsMethod' => 'dtech.updateListingOnScrolling(this);return false;',
                        )
                );
                ?>
            </div>
        </div>
    </div>
</div>
<style>
    .clear {
        clear: both;
    }
</style>    