<?php

class m130625_073805_add_dimension_column_to_conf_pro extends CDbMigration {

    public function up() {
        $table = 'product_profile';
        $this->addColumn($table, "dimension", "varchar(255) DEFAULT NULL after paper");
    }

    public function down() {
        $table = 'product_profile';
        $this->dropColumn($table, "dimension");
    }

}