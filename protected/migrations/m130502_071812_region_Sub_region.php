<?php

class m130502_071812_region_Sub_region extends DTDbMigration {

    public function up() {
        $this->truncateTable('subregion');
        $this->truncateTable('region');
        $sql = $this->readJsonData('darussalam_region_data_new.sql');
        $this->execute($sql);
    }

    public function down() {
        $this->truncateTable('subregion');
        $this->truncateTable('region');
    }

}