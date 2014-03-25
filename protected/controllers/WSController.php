<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class WSController extends Controller {

    public $layout = '';

    public function actionIndex() {

        if (!isset($_REQUEST['record_set'])) {

            echo CJSON::encode(array("No Selection"));
            return true;
        }
        if ($_REQUEST['record_set'] == 'product') {

            $allBooks = ProductWS::model()->getWsAllBooks();
            $this->layout = "";
            echo CJSON::encode($allBooks);
        } else if ($_REQUEST['record_set'] == 'product_category') {
            // If the request is set to product category 
            //containg all books return by the Model
            $pages=0;
            
            if($_REQUEST['pages_2000']!= 0 )
                $pages=2000;
            else if($_REQUEST['pages_1000']!= 0)
                $pages=1000;
            else if($_REQUEST['pages_500']!= 0)
                $pages=500;
            else if($_REQUEST['pages_200']!= 0)
                $pages=200;
            else if($_REQUEST['pages_100']!= 0)    
                $pages=100;
            else 
                $pages=0;
                    
                    
              
            $allBooks = ProductWS::model()->getWsAllBooksByCategory(
                    $_REQUEST['page'], 
                    $_REQUEST['category'],
                    $_REQUEST['popular'],
                    $_REQUEST['largest_price'],
                    $_REQUEST['lowest_price'],
                    $pages,
                    $_REQUEST['lowrangeprice'],
                    $_REQUEST['highrangeprice'],
                    $_REQUEST['asc'],
                    $_REQUEST['desc']
                   );
        
            
        }
         else if ($_REQUEST['record_set'] == 'product_catalogue') {
            // If the request is set to product category 
            //containg all books return by the Model
            
            $allBooks = ProductWS::model()->getWsAllBooksByCatalogue( $_REQUEST['page'],$_REQUEST['limit'],$_REQUEST['category'], $_REQUEST['author'], $_REQUEST['search'], $_REQUEST['lang']);
        
            
        }
        

        $this->layout = "";

        echo CJSON::encode($allBooks, true);
    }

    /*
     * Iphone service to Send All categories
     * in Daraussalam Database
     * 
     */

    public function actionAllCategories() {
        $criteria = new CDbCriteria();
        $criteria->select = "category_id,category_name";
        $categories = Categories_WS::model()->findAll($criteria);

        $cats = array();
        foreach ($categories as $cat) {
            $cats[] = array(
                "category_id" => $cat->category_id,
                "category_name" => $cat->category_name,
            );
        }

        try {
            $ret_array = array();
            $ret_array['error'] = '';
            $ret_array['data'] = $cats;
            $ret_array['count'] = count($cats);
            echo CJSON::encode($ret_array);
        } Catch (Exception $e) {
            echo CJSON::encode(array("error" => $e->getCode()));
        }
    }

    public function actionGetCategories() {
        $criteria = new CDbCriteria();
        $criteria->select = "category_id,category_name";
        $criteria->condition = "t.parent_id= 57";
        $categories = Categories_WS::model()->findAll($criteria);

        $cats = array();
        foreach ($categories as $cat) {
            $cats[] = array(
                "category_id" => $cat->category_id,
                "category_name" => $cat->category_name,
            );
        }

        try {
            $ret_array = array();
            $ret_array['error'] = '';
            $ret_array['data'] = $cats;
            $ret_array['count'] = count($cats);
            echo CJSON::encode($ret_array);
        } Catch (Exception $e) {
            echo CJSON::encode(array("error" => $e->getCode()));
        }
    }

    /*
     * Iphon service to Send All categories
     * in Daraussalam Database
     * 
     */

    public function actionRequestedCategory($category_id = 0) {

        $requested_cat = ProductWS::model()->getWsRequestByCategory($category_id);
        try {

            $requested_product_arr = array();
            $requested_product_arr['error'] = '';
            $requested_product_arr['data'] = $requested_cat;
            $requested_product_arr['count'] = count($requested_cat);

            echo CJSON::encode($requested_product_arr);
        } catch (Exception $e) {

            echo CJSON::encode(array("error" => $e->getCode()));
        }
    }

}

?>
