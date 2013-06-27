<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class WSController extends Controller {

    public $layout = '';

    public function actionIndex() {
        if(!isset($_REQUEST['record_set'])){
            echo CJSON::encode(array("No Selection"));
            return true;
        }
        if ($_REQUEST['record_set'] == 'product') {
         
            $allBooks = ProductWS::model()->getWsAllBooks();
            $this->layout = "";
            echo CJSON::encode($allBooks);
        } else if ($_REQUEST['record_set'] == 'product_category') {
            
            $allBooks = ProductWS::model()->getWsAllBooksByCategory();

            $this->layout = "";
            echo CJSON::encode($allBooks);
        }
    }

    /*
     * Iphon service to Send All categories
     * in Daraussalam Database
     * 
     */

    public function actionAllCategories() {
        $criteria = new CDbCriteria();
        $criteria->select = "category_id,category_name";
        $categories = Categories_WS::model()->findAll($criteria);
        
        $cats = array();
        foreach($categories as $cat){
            $cats[] = array(
                "category_id"=>$cat->category_id,
                "category_name"=>$cat->category_name,
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
