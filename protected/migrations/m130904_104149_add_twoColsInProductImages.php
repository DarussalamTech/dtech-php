<?php

class m130904_104149_add_twoColsInProductImages extends DTDbMigration {

    public function up() {
        $table = "product_image";
        $this->addColumn($table, "image_detail", "varchar(255) DEFAULT NULL after image_small");
        $this->addColumn($table, "image_cart", "varchar(255) DEFAULT NULL after image_detail");
    }

    public function down() {
         $table = "product_image";
         $this->dropColumn($table, "image_detail");
         $this->dropColumn($table, "image_cart");
    }

}