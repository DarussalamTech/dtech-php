<?php

/**
 * Global Search function
 */
class SearchController extends Controller {

    public function actionDosearch() {
        $connection = Yii::app()->db;
        $term = $_REQUEST['term'];
        $sql = "SELECT * " .
                " FROM ( " .
                " SELECT categories.category_name as name,'cat' as module " .
                " FROM categories WHERE categories.category_name LIKE '%" . $term . "%'  LIMIT 2" .
                " UNION all " .
                " SELECT author.author_name as name ,'author_name' as module " .
                " FROM author WHERE author.author_name LIKE '%" . $term . "%' LIMIT 4 " .
                " UNION all " .
                " SELECT product.product_name as name,'prdo' as module " .
                " FROM product " .
                " WHERE product.product_name LIKE '%" . $term . "%' LIMIT 6 " .
                ") a ";


        $arr = array();

        $command = $connection->createCommand($sql);
        $rows = $command->queryAll();

        foreach ($rows as $row) {
            $arr[] = array(
                'label' => $row['name'], // label for dropdown list          
                'value' => $row['name'], // value for input field          
                'id' => $row['name'], // return value from autocomplete
            );
        }

        echo CJSON::encode($arr);
    }

    public function actionGetSearch() {
        /*
         * for new theme....
         */

        Yii::app()->user->SiteSessions;

        if (isset($_REQUEST['serach_field'])) {
            $q = $_REQUEST['serach_field'];
            $q = utf8_decode($q);
            $sql = "Select " .
            " DISTINCT(product.product_id), " .
            " product.product_name, " .
            " city.short_name as city_short, " .
            " product.city_id, " .
            " product.authors, " .
            // " product.languages, " .
            " country.short_name " .
            " FROM product " .
            " LEFT OUTER JOIN city " .
            " ON city.city_id = product.city_id " .
            " LEFT OUTER JOIN author " .
            " ON author.author_id = product.authors " .
            " LEFT outer JOIN product_profile " .
            " ON product_profile.product_id = product.product_id " .
            " LEFT  JOIN language " .
            " ON language.language_id = product_profile.language_id " .
            " INNER JOIN country " .
            " ON country.country_id = city.country_id " .
            " LEFT OUTER JOIN product_categories ON " .
            " product_categories.product_id = product.product_id " .
            "  LEFT OUTER JOIN categories ON " .
            " categories.category_id = product_categories.category_id " .
            " WHERE " .
            " ( " .
            " product.product_name LIKE '%" . $q . "%' " .
            " OR " .
            " author.author_name LIKE '%" . $q . "%' " .
            " OR " .
            " categories.category_name LIKE '%" . $q . "%' " .
            " OR " .
            " city.short_name LIKE '%" . $q . "%' " .
            " OR " .
            " city.city_name LIKE '%" . $q . "%' " .
            " OR " .
            " language.language_name LIKE '%" . $q . "%' " .
            " OR " .
            " country.country_name LIKE '%" . $q . "%' " .
            " OR " .
            " country.short_name LIKE '%" . $q . "%' " .
            " OR " .
            " categories.category_name LIKE '%" . $q . "%' ) ";
          
            $connection = Yii::app()->db;
            $command = $connection->createCommand($sql);
            $rows = $command->queryAll();

            $product_array = array();
            foreach ($rows as $row) {
                $product_array[$row['product_id']] = $row['product_id'];
            }
            
            $dataProvider = Product::model()->allProducts($product_array);
           
            $all_products = Product::model()->returnProducts($dataProvider);



            $allCategories = Categories::model()->allCategories();

            if (isset($_POST['ajax'])) {
                $this->productfilter($dataProvider, $all_products);
            } else {


                $this->render('//product/all_products', array('products' => $all_products, 'allCate' => $allCategories, "dataProvider" => $dataProvider));
            }
        } else {

            $dataProvider = Product::model()->allProducts();
            $all_products = Product::model()->returnProducts($dataProvider);
            
            $this->productfilter($dataProvider, $all_products);


            $allCategories = Categories::model()->allCategories();
        }
    }

    /**
     *  to get product on ajax bases
     *  for filter of category
     */
    public function productfilter($dataProvider, $all_products) {

        $this->renderPartial("//product/_product_list", array('products' => $all_products,
            'dataProvider' => $dataProvider,));
    }

    public function actionSearchDetail() {
        Yii::app()->user->SiteSessions;

        $criteria = new CDbCriteria();

        $product = Product::model()->findByPk($_REQUEST['product_id'], $criteria);

        $view_array = array(
            "Books" => array(
                "controller" => "product",
                "view" => "_books/_book_info"
            ),
            "Educational Toys" => array(
                "controller" => "educationToys",
            ),
            "Quran" => array(
                "controller" => "quran",
                "view" => "_quran/_quran_info"
            ),
            "Others" => array(
                "controller" => "others",
            ),
        );

        if (!isset($view_array[$product->parent_category->category_name])) {
            $view_array[$product->parent_category->category_name] = "product";
        }

        $uri = $this->createUrl('/web/' . $view_array[$product->parent_category->category_name]['controller'] . '/productDetail', array('country' => Yii::app()->session['country_short_name'], 'city' => Yii::app()->session['city_short_name'], 'city_id' => Yii::app()->session['city_id'], 'product_id' => $_REQUEST['product_id']));
        $this->redirect($uri);
    }

}

?>
