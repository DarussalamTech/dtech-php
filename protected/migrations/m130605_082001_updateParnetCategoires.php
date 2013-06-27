<?php

class m130605_082001_updateParnetCategoires extends DTDbMigration {

    public function up() {
        $table = "categories";

        $sql = "SELECT * FROM city 
                 ";

        $cities = $this->getQueryAll($sql);
        foreach ($cities as $city) {
            $columns = array(
                'parent_id' => 0,
            );

            $this->update($table, $columns, 'category_name = "Books"');
            $this->update($table, $columns, 'category_name = "Educational Toys"');
            $this->update($table, $columns, 'category_name = "Others"');
            $this->update($table, $columns, 'category_name = "Quran"');
            $this->update($table, $columns, 'category_name = "qurqan"');
        }
    }

    public function down() {
        return true;
    }

}