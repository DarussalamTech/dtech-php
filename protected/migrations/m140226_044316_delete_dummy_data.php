<?php

class m140226_044316_delete_dummy_data extends DTDbMigration {

    public function up() {
        $table = 'product_image';
        $table2 = 'product_categories';
        $table5 = 'cart';
        $table6 = 'order_detail';
        $table3 = 'product_profile';
        $table4 = 'product';
        $ryd = $this->getRiyadhCityId();

        $data = $this->getQueryAll('SELECT t.id,product_profile_id FROM `product_image`as t inner join product_profile as p on t.product_profile_id=p.id  inner join product on p.product_id=product.product_id where product.city_id=' . $ryd[0]);
        $data_cart = $this->getQueryAll('SELECT t.cart_id,product_profile_id FROM `cart`as t inner join product_profile as p on t.product_profile_id=p.id  inner join product on p.product_id=product.product_id where product.city_id=' . $ryd[0]);

        $order_detail_sql = 'SELECT t.user_order_id,product_profile_id FROM `order_detail`as t inner join product_profile as p on t.product_profile_id=p.id  inner join product on p.product_id=product.product_id where product.city_id=' . $ryd[0];

        $order_detail_id_sql = 'SELECT t.user_order_id 	 FROM `order_detail`as t inner join product_profile as p on t.product_profile_id=p.id  inner join product on p.product_id=product.product_id where product.city_id=' . $ryd[0];

        $data_orderDetail_history = $this->getQueryAll("SELECT id FROM order_history_detail WHERE id IN ( " . $order_detail_id_sql . ")");

        $data_orderDetail = $this->getQueryAll($order_detail_sql);

        $data_categories = $this->getQueryAll('SELECT t.product_category_id,p.product_id FROM `product_categories`as t left join product as p on t.product_id=p.product_id  where p.city_id=' . $ryd[0]);


        $data_profiles = $this->getQueryAll('SELECT t.id FROM `product_profile`as t inner join product as p on t.product_id=p.product_id  where p.city_id=' . $ryd[0]);
        $data_products = $this->getQueryAll('SELECT product_id FROM `product`  where city_id=' . $ryd[0]);
        $basePath = Yii::app()->basePath . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "uploads";
        $basePath.= DIRECTORY_SEPARATOR . "product" . DIRECTORY_SEPARATOR;
        // Deleting product images from the uploads directory
        // Removing all the product images from the database tables

        if (!empty($data)) {
            foreach ($data as $columns) {
                if (is_dir($basePath . $columns['product_profile_id']))
                    echo exec('rm -fr ' . $basePath . $columns['product_profile_id']);
                if (!empty($columns['id']))
                    $this->delete($table, "id=" . $columns['id']);
            }
        }
        // Delete  all the categories from product_cateogries

        if (!empty($data_categories)) {
            foreach ($data_categories as $columns) {

                if (!empty($columns['product_category_id']))
                    $this->delete($table2, "product_category_id=" . $columns['product_category_id']);
            }
        }
        // Deleting all the cart's data

        if (!empty($data_cart)) {
            foreach ($data_cart as $columns) {

                if (!empty($columns['cart_id']))
                    $this->delete($table5, "cart_id=" . $columns['cart_id']);
            }
        }

        if (!empty($data_orderDetail_history)) {
            foreach ($data_orderDetail_history as $columns) {
                if (!empty($columns['user_order_id']))
                    $this->delete("order_history_detail", "user_order_id=" . $columns['user_order_id']);
            }
        }

        // Deleting all the order's detail
        if (!empty($data_orderDetail)) {
            foreach ($data_orderDetail as $columns) {

                if (!empty($columns['user_order_id']))
                    $this->delete($table6, "user_order_id=" . $columns['user_order_id']);
            }
        }

        // Deleteing all the product profiles
        if (!empty($data_profiles)) {
            foreach ($data_profiles as $columns) {

                if (!empty($columns['id']))
                    $this->delete($table3, "id=" . $columns['id']);
            }
        }

        // Delete the products for darussalamksa
        if (!empty($data_products)) {
            foreach ($data_products as $columns) {

                if (!empty($columns['product_id']))
                    $this->delete($table4, "product_id=" . $columns['product_id']);
            }
        }

        //deleting orders now

        $order_sql = "SELECT order_id FROM ".$this->getDBName().".order WHERE city_id = " . $ryd[0];
        $order_his_sql = "SELECT id FROM order_history WHERE order_id IN (".$order_sql.")";

        $order_hist = $this->getQueryAll($order_his_sql);
        if(!empty($order_hist)){
            foreach($order_hist as $columns){
                if(!empty($columns['id'])){
                    $this->delete("order_history", "id=" . $columns['id']);
                }
            }
        }
        
        $orders = $this->getQueryAll($order_sql);
        
        if(!empty($orders)){
            foreach($orders as $columns){
                if(!empty($columns['order_id'])){
                    $this->delete("order", "id=" . $columns['order_id']);
                }
            }
        }
        return true;
    }

    public function down() {
        echo "m140226_044316_delete_dummy_data does not support migration down.\n";
        return true;
    }

}