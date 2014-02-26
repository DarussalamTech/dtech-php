<?php

class m140226_044316_delete_dummy_data extends DTDbMigration {

    public function up() {
        $table = 'product_image';
        $table2 = 'product_categories';
        $table5 = 'cart';
        $table6 = 'order_Detal';
        $table3 = 'product_profile';
        $table4 = 'product';
        $ryd = $this->getRiyadhCityId();

        $data = $this->getQueryAll('SELECT t.id,product_profile_id FROM `product_image`as t inner join product_profile as p on t.product_profile_id=p.id  inner join product on p.product_id=product.product_id where product.city_id=' . $ryd[0]);
        $data_cart = $this->getQueryAll('SELECT t.cart_id,product_profile_id FROM `cart`as t inner join product_profile as p on t.product_profile_id=p.id  inner join product on p.product_id=product.product_id where product.city_id=' . $ryd[0]);
        $data_orderDetail = $this->getQueryAll('SELECT t.user_order_id,product_profile_id FROM `order_detail`as t inner join product_profile as p on t.product_profile_id=p.id  inner join product on p.product_id=product.product_id where product.city_id=' . $ryd[0]);
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
        
        // Deleting all the order's detail
        if (!empty($data_orderDetail)) {
            foreach ($data_categories as $columns) {

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

        return true;
    }

    public function down() {
        echo "m140226_044316_delete_dummy_data does not support migration down.\n";
        return true;
    }

}