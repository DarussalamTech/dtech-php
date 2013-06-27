<?php

class m130503_094921_add_default_field_product_images extends CDbMigration {

    public function up() {
       $table = "product_image";
       $this->addColumn($table, "is_default", "tinyint(11) NOT NULL after image_large");
    }

    public function down() {
       $table = "product_image";
       $this->dropColumn($table, "is_default");
    }

}