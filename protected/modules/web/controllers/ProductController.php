<?php

class ProductController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * for category filter
     * @var type 
     */
    public $is_cat_filter = false;

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('viewcart', 'editcart', 'viewwishlist', 'editwishlist', 'allproducts',
                    'featuredproducts', 'bestsellings', 'productdetail', 'productlisting',
                    'productfilter',
                    'productDetailLang'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array(),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    //front site actions
    public function actionallProducts() {

        $this->is_cat_filter = true;
        Yii::app()->user->SiteSessions;


        /**
         * ajax based
         */
        if (isset($_POST['ajax'])) {
            $this->productfilter();
        } else {
            //queries 


            $dataProvider = Product::model()->allProducts();
            $all_products = Product::model()->returnProducts($dataProvider);

            /**
             * Temporary solution
             */
            $parent_cat = Categories::model()->getParentCategoryId("Books");

            $allCategories = Categories::model()->allCategories("", $parent_cat);




            $this->render('//product/all_products', array(
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
        $dataProvider = Product::model()->allProducts();
        $all_products = Product::model()->returnProducts($dataProvider);
        $this->renderPartial("//product/_product_list", array('products' => $all_products,
            'dataProvider' => $dataProvider,));
    }

    /**
     *  to get product on ajax bases
     *  for based on ajax
     */
    public function productBestfilter() {
        //queries 
        $order_detail = new OrderDetail;
        $dataProvider = $order_detail->bestSellings();
        $best_sellings = $order_detail->getBestSelling($dataProvider);
        $this->renderPartial("//product/_product_list", array('products' => $best_sellings,
            'dataProvider' => $dataProvider,));
    }

    /**
     * get Featured Products
     */
    public function actionfeaturedProducts() {
        if (isset($_POST['ajax'])) {
            $this->productFeaturedfilter();
        } else {
            Yii::app()->user->SiteSessions;

            //queries 
            $order_detail = new OrderDetail;
            $dataProvider = $order_detail->featuredBooks();
            $featured_products = $order_detail->getFeaturedProducts($dataProvider);

            $categories = new Categories();
            $allCategories = $categories->allCategories("featured");


            $this->render('//product/featured_products', array(
                'products' => $featured_products,
                'dataProvider' => $dataProvider,
                'allCate' => $allCategories));
        }
    }

    /**
     *  to get product on ajax bases
     *  for based on ajax
     */
    public function productFeaturedfilter() {
        //queries 

        $order_detail = new OrderDetail;
        $dataProvider = $order_detail->featuredBooks();
        $featured_products = $order_detail->getFeaturedProducts($dataProvider);
        $this->renderPartial("//product/_product_list", array('products' => $featured_products,
            'dataProvider' => $dataProvider,));
    }

    public function actionbestSellings() {
        /**
         * ajax based
         */
        if (isset($_POST['ajax'])) {
            $this->productBestfilter();
        } else {

            Yii::app()->user->SiteSessions;
            Yii::app()->theme = Yii::app()->session['layout'];
            //queries 
            $order_detail = new OrderDetail;
            $dataProvider = $order_detail->bestSellings();
            $best_sellings = $order_detail->getBestSelling($dataProvider);

            $categories = new Categories();
            $allCategories = $categories->allCategories("bestselling");

            Yii::app()->controller->layout = '//layouts/main';
            $this->render('best_sellings', array(
                'products' => $best_sellings,
                'dataProvider' => $dataProvider,
                'allCate' => $allCategories));
        }
    }

    /**
     * product detail
     */
    public function actionproductDetail() {
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

    /**
     * product detail change
     */
    public function actionproductDetailLang($id) {

        if (isset($_POST['lang_id'])) {


            Yii::app()->user->SiteSessions;
            $product = Product::model();

            $product = $product->findByPk($id);
            $product->productProfile = $product->productSelectedProfile;


            /**
             *  getting value of poduct rating
             */
            $rating_value = ProductReviews::model()->calculateRatingValue($product->product_id);
            $right_data = $this->renderPartial("//product/_product_detail_data", array('product' => $product, "rating_value" => $rating_value), true, true);
            $left_data = $this->renderPartial("//product/_product_detail_image", array('product' => $product), true, false);

            echo CJSON::encode(array(
                "right_data" => $right_data,
                "left_data" => $left_data,
            ));
        }
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Product the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Product::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

}
