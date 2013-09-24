<?php

class m130607_052442_updateBooksParent_cat extends DTDbMigration {

    public function up() {
        $table = "product";
        $sql = "SELECT * FROM " . $table;
        $products = $this->getQueryAll($sql);
        foreach ($products as $row) {
            //echo $row['product_name'] . "===" . $row['city_id'];


            if (empty($row['parent_cateogry_id'])) {
                $sql = "SELECT category_id FROM categories WHERE city_id = " . $row['city_id'];
                $sql.= " AND category_name ='Books' ";
                $parent_cat = $this->getQueryRow($sql);
                echo $parent_cat['category_id'];
                echo "\n";
                if (!empty($parent_cat['category_id'])) {
                    $this->update($table, array("parent_cateogry_id" => $parent_cat['category_id']), "product_id = " . $row['product_id']);
                }
            }
        }

        
    }

    public function down() {
        return true;
    }

}