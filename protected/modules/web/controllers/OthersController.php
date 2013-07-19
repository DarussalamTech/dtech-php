<?php

/**
 * 
 */
class OthersController extends Controller {
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */

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


            $dataProvider = Product::model()->allProducts(array(), 30, "Others");
            $all_products = Product::model()->returnProducts($dataProvider);
            /**
             * Temporary solution
             */
            $parent_cat = Categories::model()->getParentCategoryId("Others");

            $allCategories = Categories::model()->allCategories("", $parent_cat);


            $this->render('//others/index', array(
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
        Yii::app()->user->SiteSessions;
        $dataProvider = Product::model()->allProducts(array(), 30, "Others");
        $all_products = Product::model()->returnProducts($dataProvider);
        $this->renderPartial("//others/_product_list", array('products' => $all_products, 'dataProvider' => $dataProvider,));
    }

    public function actionProductDetail() {
        Yii::app()->user->SiteSessions;

        try {
            $product = Product::model()->findByPk($_REQUEST['product_id']);



            /**
             *  getting value of poduct rating
             */
            $rating_value = ProductReviews::model()->calculateRatingValue($product->product_id);

            $this->render('//others/product_detail', array('product' => $product, "rating_value" => $rating_value));
        } catch (Exception $e) {
            Yii::app()->theme = 'landing_page_theme';
            throw new CHttpException(500, "   Sorry ! Record Not found");
        }
    }

    /**
     * Prview detail
     */
    public function actionproductPreview() {
        Yii::app()->user->SiteSessions;


        try {
            $product = Product::model()->findByPk($_REQUEST['product_id']);


            /**
             *  getting value of poduct rating
             */
            $rating_value = ProductReviews::model()->calculateRatingValue($product->product_id);

            $this->render('//product/product_detail', array('product' => $product, "rating_value" => $rating_value));
        } catch (Exception $e) {
            Yii::app()->theme = 'landing_page_theme';
            throw new CHttpException(500, "   Sorry ! Record Not found");
        }
    }

}

?>
