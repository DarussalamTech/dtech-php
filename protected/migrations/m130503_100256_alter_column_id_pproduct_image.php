<?php

class m130503_100256_alter_column_id_pproduct_image extends CDbMigration {

    public function up() {
        $table = "product_image";
        $this->renameColumn($table, "product_image_id", "id");
    }

    public function down() {
        $table = "product_image";
        $this->renameColumn($table, "id", "product_image_id");
    }

}