<?php

class m130701_123222_renameTable extends CDbMigration {

    public function up() {
        $table = "product_attributes_conf";
        $this->renameTable($table, "conf_product_attributes");
        $this->renameColumn("conf_product_attributes", "product_type", "type");
    }

    public function down() {
        $table = "conf_product_attributes";
        $this->renameTable($table, "product_attributes_conf");

        $this->renameColumn("product_attributes_conf", "type", "product_type");
    }

}