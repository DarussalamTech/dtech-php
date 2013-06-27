<?php

class m130606_082058_add_field_inProduct_parent_cat extends CDbMigration {

    public function up() {
        $table = "product";
        $this->addColumn($table, "parent_cateogry_id", "int(10) DEFAULT NULL after product_name");
    }

    public function down() {
         $table = "product";
        $this->dropColumn($table, "parent_cateogry_id");
    }

}