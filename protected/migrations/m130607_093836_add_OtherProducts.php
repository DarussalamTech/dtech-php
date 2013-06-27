<?php

class m130607_093836_add_OtherProducts extends DTDbMigration {

    public function up() {
        require_once Yii::app()->basePath . '/data/data_of_other_products.php';

        $sql = "SELECT language_id FROM language WHERE LOWER(language_name) = LOWER('English')";
        $english_lang = $this->getQueryRow($sql);

        $sql = "SELECT category_id FROM categories WHERE city_id = 1";
        $sql.= " AND category_name ='Others' ";

        $parent_category = $this->getQueryRow($sql);

        foreach ($data as $product) {
            $columns = array(
                "product_name" => $product['name'],
                "product_description" => $product['desc'],
                "parent_cateogry_id" => $parent_category['category_id'],
                "city_id" => 1,
            );
            $this->insert('product', $columns);
            $id = Yii::app()->db->getLastInsertID();
            $columns = array(
                "language_id" => $english_lang['language_id'],
                "item_code" => "other_" . $id,
                "price" => $product['price'],
                "product_id" => $id,
            );

            $this->insert("product_profile", $columns);
        }
    }

    public function down() {
        return true;
    }

}