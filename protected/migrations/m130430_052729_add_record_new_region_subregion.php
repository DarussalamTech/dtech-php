<?php

class m130430_052729_add_record_new_region_subregion extends DTDbMigration {

    public function up() {
        $sql = $this->readJsonData('darussalam_region_data_new.sql');
        $this->execute($sql);
    }

    public function down() {
        $this->truncateTable('subregion');
        $this->truncateTable('region');
    }
}