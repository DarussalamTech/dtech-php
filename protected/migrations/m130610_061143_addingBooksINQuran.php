<?php

class m130610_061143_addingBooksINQuran extends DTDbMigration {

    public function up() {
        $table = "categories";
        $parent_sql = "SELECT 
                category_id,
                category_name
                FROM
                  categories t
                WHERE
                  (parent_id = 0) AND 
                  (city_id = 1)
                AND category_name = 'Books'";
        $parent_category = $this->getQueryRow($parent_sql);
        $parent_category = $parent_category['category_id'];

        $parent_sql = "SELECT 
                category_id,
                category_name
                FROM
                  categories t
                WHERE
                  (parent_id = 0) AND 
                  (city_id = 1)
                AND category_name = 'Quran'";
        $parent_category_q = $this->getQueryRow($parent_sql);
       
        $parent_category_q = $parent_category_q['category_id'];
        
        $sql = "SELECT *
                    FROM
                      product
                    WHERE
                      (LOWER(product.product_name) LIKE 'quran_%')
                      AND
                      product.parent_cateogry_id = " . $parent_category;

        $all_quran_books = $this->getQueryAll($sql);
        foreach ($all_quran_books as $quran) {
            echo $quran['product_id'] . "--------" . $quran['product_name']."------".$parent_category_q;
            

            $this->update("product", array("parent_cateogry_id" => $parent_category_q), "product_id = " . $quran['product_id']);
        }
        
    }

    public function down() {
        return true;
    }

}