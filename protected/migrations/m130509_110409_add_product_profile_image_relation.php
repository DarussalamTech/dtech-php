<?php

class m130509_110409_add_product_profile_image_relation extends CDbMigration {

    public function up() {
        $table = "product_image";
        $this->dropForeignKey("product_image_ibfk_1", $table);

        $this->renameColumn($table, "product_id", "product_profile_id");
        
        $this->addForeignKey("fk_product_profile_image", $table, "product_profile_id", "product_profile", "id");
    }

    public function down() {

        $table = "product_image";
        
        $this->dropForeignKey("fk_product_profile_image", $table);
        
        
        $this->renameColumn($table, "product_profile_id", "product_id");

        $this->addForeignKey("product_image_ibfk_1", $table, "product_id", "product", "id", "CASCADE", "CASCADE");
    }

}