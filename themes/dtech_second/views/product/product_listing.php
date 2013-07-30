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

                <div id="list_featured">
                    <h6>
                        <?php
                        $title = "All Books";
                        $category = "";
                        if (isset($_REQUEST['slug'])) {
                            $title = explode("-", $_REQUEST['slug']);
                            $category = $title = $title[0];
                        }
                        echo Yii::t('common', $title, array(), NULL, $this->currentLang);
                        ?>
                    </h6>
                    <div id="right_main_conent">
                        <?php
                        $this->renderPartial("//product/_product_list", array(
                            'products' => $products,
                            'category' => $category,
                            'dataProvider' => $dataProvider,
                            'allCate' => $allCate));
                        ?>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <style>
        .clear {
            clear: both;
        }
    </style>    