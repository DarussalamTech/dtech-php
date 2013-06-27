<?php

class m130426_120056_add_record_in_region_subregion extends DTDbMigration {

    public function up() {
        $sql = $this->readJsonData('darussalam_region_data.sql');

        $this->execute($sql);
        

    }

    public function down() {
        $this->truncateTable('subregion');
        $this->truncateTable('region');
    }

}