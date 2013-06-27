<?php

class m130528_052729_make_some_products_featured extends DTDbMigration {

    public function up() {



        $table = "product";
        $sql = "SELECT * FROM product 
                WHERE product_id >=1 AND product_id <=100 ";

        $featured_products = $this->getQueryAll($sql);
        foreach ($featured_products as $featured) {

            $this->update($table, array('is_featured' => '1'), 'product_id=' . $featured['product_id']);
        }
    }

    public function down() {
          return TRUE;
    }

}