<?php

/**
 * 
 */
class m140429_050648_addPRoductsForSuperAdmin extends DTDbMigration {

    public function up() {
        $table = "product";
        $columns = array(
            "product_id", "product_name", "parent_id", "slag", "parent_cateogry_id",
            "product_description", "product_overview", "status", "city_id",
            "is_featured", "product_rating", "authors", "shippable_countries",
            "create_time", "create_user_id", "update_time", "update_user_id",
        );
        $columns_str = implode(",", $columns);

        $sql = "SELECT DISTINCT(universal_name), " . $columns_str . " FROM " . $table;
        $data = $this->getQueryAll($sql);
        $super_city = $this->getSuperCityId();
        foreach ($data as $column) {
            unset($column['product_id']);
            unset($column['create_time']);
            unset($column['create_user_id']);
            unset($column['update_time']);
            unset($column['update_user_id']);

            $column['city_id'] = $super_city[0];
            $this->insert($table, $column);
        }
        
    }

    public function down() {
        $super_city = $this->getSuperCityId();
        $this->delete("product","city_id = ".$super_city[0]);
    }

}