<?php
$cs = Yii::app()->clientScript;
$cs->registerCssFile(Yii::app()->theme->baseUrl . '/css/list.css');
?>
<div id="main_features_part">
    <div id="features_part">
        <div id="featured_books">
            <div id="right_featured">
                <div class="list_all">
                    <h1>Search items by</h1>

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

                        /*
                         * to handle the category name
                         * to be displayed in the product listing
                         * of all category ..making from the slug

                          if (!empty($products[0]['category'])) {
                          echo Yii::t('common', $products[0]['category'] . "-->", array(), NULL, $this->currentLang);
                          }
                          $slug_array = split('-', $_REQUEST['slug']);
                          $last_element = array_pop($slug_array);
                          foreach ($slug_array as $catego) {
                          echo $catego . ' ';
                          }
                         */
                        $slug_array = split('-', $_REQUEST['slug']);
                        $last_element = array_pop($slug_array);
                        $criteria = new CDbCriteria();
                        $criteria->select = "category_name";
                        $category_name = Categories::model()->findByPk($last_element, $criteria)->category_name;
                        echo $category_name;
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