<?php

class m130606_053547_delete_extra_others extends DTDbMigration {

    public function up() {
        $table = "categories";

        $sql = "SELECT * FROM city ";


        $cities = $this->getQueryAll($sql);
        foreach ($cities as $city) {

            $sql = "SELECT * FROM categories WHERE category_name = 'Others' 
                AND city_id = '" . $city['city_id'] . "'";

            $catgories = $this->getQueryAll($sql);
            $i = 0;
            foreach ($catgories as $cat) {

                if ($i > 0) {

                    $this->delete($table, "category_id=" . $cat['category_id']);
                }
                $i++;
            }
        }
    }

    public function down() {
        $table = "categories";
        return true;
    }

}