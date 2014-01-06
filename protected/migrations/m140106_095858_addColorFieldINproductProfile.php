<?php

class m140106_095858_addColorFieldINproductProfile extends DTDbMigration {

    public function up() {
        $table = "product_profile";
        $this->addColumn($table, "color", 'varchar(255) DEFAULT NULL after edition');
        $this->addColumn($table, "arabic_name", 'varchar(255) DEFAULT NULL  COLLATE utf8_general_ci after title');
    }

    public function down() {
       $table = "product_profile";
       $this->dropColumn($table, "color");
       $this->dropColumn($table, "arabic_name");
    }

}