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
                <?php $this->renderPartial("//layouts/_sidebars") ?>
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