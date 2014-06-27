<?php

class m140627_101900_create_galary_attributeImage extends DTDbMigration {

    public function up() {
        $table = "product_image";
        $this->addColumn($table, "image_gallery", "varchar(255) DEFAULT NULL after image_large");
    }

    public function down() {
        $table = "product_image";
        $this->dropColumn($table, "image_gallery");
    }

}