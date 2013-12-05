<?php

class m131205_050510_add_weightColumninproduct extends CDbMigration {

    public function up() {
        $table = 'product_profile';
        $this->addColumn($table, "weight", "varchar(255) DEFAULT NULL after dimension");
    }

    public function down() {
        $table = 'product_profile';
        $this->dropColumn($table, "weight");
    }

}