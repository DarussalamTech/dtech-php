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
                    <?php $this->renderPartial("//layouts/_categories") ?>
                    <?php $this->renderPartial("//layouts/_sidebars") ?>
                </div>
       
            </div>



            <div id="list_featured">
                <h6><?php echo Yii::t('common', 'Education Toys', array(), NULL, $this->currentLang); ?></h6>
                <?php
                $this->renderPartial("//quran/_product_list", array(
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