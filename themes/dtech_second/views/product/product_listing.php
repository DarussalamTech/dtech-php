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
                    <?php
                    foreach ($this->menu_categories as $id => $data):
                        ?>
                        <div class="listing">
                            <p>
                                <a href="javascript:void(0)" onclick="dtech_new.aquardinaMenu(this)">

                                    <?php
                                    echo CHtml::image(
                                            Yii::app()->theme->baseUrl . "/images/list_arrow_03.jpg", '', array(
                                        "visible" => Yii::app()->theme->baseUrl . "/images/bottom_list_03.jpg",
                                        "invisible" => Yii::app()->theme->baseUrl . "/images/list_arrow_03.jpg",
                                        "class" => "aquardian_img",
                                            )
                                    );
                                    echo " ";
                                    echo Yii::t('common', $data['name'], array(), NULL, $this->currentLang);
                                    ?>

                                </a>
                            </p>
                            <?php
                            if (isset($data['data'])):
                                echo CHtml::openTag("div", array(
                                    "class" => "inner_list",
                                    "style" => "display:none",
                                        )
                                );
                                foreach ($data['data'] as $cat):

                                    echo "<li>";
                                    echo CHtml::link($cat->category_name);
                                    echo "</li>";
                                endforeach;

                                echo CHtml::closeTag("div");

                            endif;
                            ?>

                        </div>

                        <?php
                    endforeach;
                    ?>
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