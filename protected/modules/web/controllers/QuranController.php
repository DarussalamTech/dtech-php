<?php

/**
 * Quran Controller 
 */
class QuranController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/main';

    /**
     * for category filter
     * @var type 
     */
    public $is_cat_filter = false;

    //front site actions
    public function actionIndex() {

        $this->is_cat_filter = true;


        /**
         * ajax based
         */
        if (isset($_POST['ajax'])) {
            $this->productfilter();
        } else {
            //queries 

            Yii::app()->user->SiteSessions;


            $dataProvider = Product::model()->allProducts(array(), 30, "Quran");
            $all_products = Product::model()->returnProducts($dataProvider);
            /**
             * Temporary solution
             */
            $parent_cat = Categories::model()->getParentCategoryId("Quran");

            $allCategories = Categories::model()->allCategories("", $parent_cat);


            $this->render('//quran/index', array(
                'products' => $all_products,
                'dataProvider' => $dataProvider,
                'allCate' => $allCategories));
        }
    }

    /**
     *  to get product on ajax bases
     *  for filter of category
     */
    public function productfilter() {
        $dataProvider = Product::model()->allProducts(array(), 30, "Quran");
        $all_products = Product::model()->returnProducts($dataProvider);
        $this->renderPartial("//quran/_product_list", array('products' => $all_products,
            'dataProvider' => $dataProvider,));
    }

    public function actionProductDetail() {

        $product = Product::model()->findByPk($_REQUEST['product_id']);

        /**
         *  getting value of poduct rating
         */
        $rating_value = ProductReviews::model()->calculateRatingValue($product->product_id);

        $this->render('//quran/product_detail', array('product' => $product, "rating_value" => $rating_value));
    }

    /**
     * product detail change
     */
    public function actionproductDetailLang($id) {

        if (isset($_POST['lang_id'])) {



            $product = Product::model();

            $product = $product->findByPk($id);
            $product->productProfile = $product->productSelectedProfile;


            /**
             *  getting value of poduct rating
             */
            $rating_value = ProductReviews::model()->calculateRatingValue($product->product_id);
            $right_data = $this->renderPartial("_product_detail_data", array('product' => $product, "rating_value" => $rating_value), true, true);
            $left_data = $this->renderPartial("_product_detail_image", array('product' => $product), true, false);

            echo CJSON::encode(array(
                "right_data" => $right_data,
                "left_data" => $left_data,
            ));
        }
    }

}

?>
