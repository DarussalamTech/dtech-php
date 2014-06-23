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
            //'https +login+LoginAdmin', // Force https, but only on login pages
            "http +array('viewcart',
                    'editcart',
                    'viewwishlist', 'editwishlist', 'allproducts',
                    'featuredproducts',
                    'bestsellings',
                    'productdetail',
                    'productlisting',
                    'productDetailLang', 'category')"
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
                'actions' => array('viewcart',
                    'editcart',
                    'viewwishlist', 'editwishlist', 'allproducts',
                    'featuredproducts',
                    'bestsellings',
                    'productdetail',
                    'productlisting',
                    'productDetailLang', 'category'),
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
            //on browser refresh 


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

    //front site actions
    public function actionCategory($slug) {



        $this->is_cat_filter = true;
        Yii::app()->user->SiteSessions;

        //getting product category information from its slug
        $category_product = array();
        if (!empty($slug)) {
            $slug_array = explode('-', $slug);
            $category_product['category'] = $slug_array[0];

            $criteria = new CDbCriteria();

          
            $catModel = Categories::model()->findByPk($slug_array[count($slug_array)-1], $criteria);
            $category_product['category_name'] = $catModel->category_name;
            $category_product['category_id'] = $catModel->category_id;
            $category_product['parent_id'] = $catModel->parent_id;
           
        }


        /**
         * ajax based
         */
        if (isset($_POST['ajax'])) {
            $this->productfilter($slug,$category_product);
        } else {
            //queries 


            $dataProvider = Product::model()->allProducts("", "", "", $slug);
            $all_products = Product::model()->returnProducts($dataProvider);

            /**
             * Temporary solution
             */
            $parent_cat = Categories::model()->getParentCategoryId("Books");

            $allCategories = Categories::model()->allCategories("", $parent_cat);


            $this->render('//product/all_products', array(
                'products' => $all_products,
                'dataProvider' => $dataProvider,
                'category_product' => $category_product,
                'allCate' => $allCategories));
        }
    }

    /**

     *  to get product on ajax bases
     *  for filter of category

     * @param type $slug
     * @param type $category_product
     */
    public function productfilter($slug = "", $category_product = array()) {
        $dataProvider = Product::model()->allProducts("", "", "", $slug);
        $all_products = Product::model()->returnProducts($dataProvider);
        $category = "";
        if (isset($_REQUEST['slug'])) {
            $title = explode("-", $_REQUEST['slug']);
            $category = $title = $title[0];
        }
        $this->renderPartial("//product/_product_list", array(
            'products' => $all_products,
            'category_product' => isset($category_product) ? $category_product :"",
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
            $id = explode("-", $_REQUEST['slug']);
            $id = $id[count($id) - 1];
            $criteria = new CDbCriteria();
            $criteria->addCondition("t.status = 1");
            $product = Product::model()->localized(Yii::app()->controller->currentLang)->findByPk($id, $criteria);



            /**
             * if no record found in english
             */
            if (empty($product)) {
                $product = Product::model()->findByPk($id, $criteria);
            }

            /** if product not found * */
            if (!empty($product)) {
                /**
                 * defining array for rendarparital for two main categories
                 */
                $view_array = array(
                    "Books" => 'product',
                    "Quran" => 'quran'
                );
                $view = "others";

                if (isset($view_array[$product->parent_category->category_name])) {
                    $view = $view_array[$product->parent_category->category_name];
                }



                /**
                 *  getting value of poduct rating
                 */
                $rating_value = ProductReviews::model()->calculateRatingValue($id);

                $this->render('//product/product_detail', array(
                    'product' => $product,
                    "rating_value" => $rating_value,
                    "view" => $view
                ));
            } else {
                Yii::app()->theme = 'landing_page_theme';
                throw new CHttpException(400, "   Sorry ! Record Not found ");
            }
        } catch (Exception $e) {

            Yii::app()->theme = 'landing_page_theme';
            throw new CHttpException(400, "   Sorry ! Record Not found in this language");
        }
    }

    /**
     * Prview detail
     */
    public function actionproductPreview($id = "") {
        Yii::app()->user->SiteSessions;


        try {


            $product = Product::model()->findByPk($_REQUEST['product_id']);

            /**
             * if no record found in english
             */
            if (empty($product)) {
                $product = Product::model()->findByPk($id);
            }


            /**
             * defining array for rendarparital for two main categories
             */
            $view_array = array(
                "Books" => 'product',
                "Quran" => 'quran'
            );
            $view = "other";

            if (isset($view_array[$product->parent_category->category_name])) {
                $view = $view_array[$product->parent_category->category_name];
            }




            /**
             *  getting value of poduct rating
             */
            $rating_value = ProductReviews::model()->calculateRatingValue($product->product_id);

            $this->render('//product/product_detail', array(
                'product' => $product,
                "rating_value" => $rating_value,
                "view" => $view
            ));
        } catch (Exception $e) {

            Yii::app()->theme = 'landing_page_theme';
            throw new CHttpException(500, "   Sorry ! Record Not found");
        }
    }

    /**
     * product detail change
     */
    public function actionproductDetailLang($id = "") {

        if (isset($_POST['lang_id']) || isset($_REQUEST['profile_id'])) {


            Yii::app()->user->SiteSessions;
            $product = Product::model();

            $product = Product::model()->localized(Yii::app()->controller->currentLang)->findByPk($id);

            if (!empty($_POST['lang_id'])) {

                $product->productProfile = $product->productSelectedProfile;
            } else if (!empty($_REQUEST['profile_id'])) {
                $product->productProfile = $product->productloadProfile;
            }
            /**
             * temporary PCM 
             */
            if (!isset($product->productProfile[0])) {
                echo CJSON::encode(array());
                ;
                return true;
            }

            /**
             *  getting value of poduct rating
             */
            $rating_value = ProductReviews::model()->calculateRatingValue($product->product_id);

            $lower_detail_data = $this->renderPartial("//product/_product_detail_data", array('product' => $product, "rating_value" => $rating_value), true, true);
            $upper_detail_data = $this->renderPartial("//product/_product_add_to_cart", array('product' => $product, "rating_value" => $rating_value), true, true);
            $image_data = $this->renderPartial("//product/_product_detail_image", array('product' => $product), true, false);
            $all_data = array(
                "lower_detail_data" => trim($lower_detail_data),
                "upper_detail_data" => trim($upper_detail_data),
                "image_data" => trim($image_data),
            );
            //CVarDumper::dump($all_data,10,true);
            echo CJSON::encode($all_data);
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
