<?php

/**
 * For parent category insertion
 */
class m140217_054152_category_createing extends DTDbMigration {

    public function up() {
        $lhr = $this->getLahoreCityId();
        $ryd = $this->getRiyadhCityId();
        $table = 'categories';

        $dat = $this->getQueryAll("SELECT category_name,user_order,parent_id,city_id,added_date FROM `categories` where  city_id=" . $lhr[0] . " and parent_id='0' and category_name not in (select category_name from categories where city_id=" . $ryd[0] . " and parent_id=0 )");

        if (!empty($dat)) {
            foreach ($dat as $columns) {

                $ryd = $this->getRiyadhCityId();
                $columns['city_id'] = $ryd[0];
                $columns['added_date'] = time();
                $this->insertRow($table, $columns);
            }
        }
        return true;
    }

    public function down() {
        echo "m140217_054152_category_createing does not support migration down.\n";
        return true;
    }

}