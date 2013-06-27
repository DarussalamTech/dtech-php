<?php

class m130605_122518_alter_product_profile_column extends CDbMigration {

    public function up() {
        $table = "product_profile";
        $this->alterColumn($table, 'edition', "varchar(255) DEFAULT NULL");
        $this->alterColumn($table, 'size', "varchar(255) DEFAULT NULL");
        
    }

    public function down() {
        $table = "product_profile";
        $this->alterColumn($table, 'edition', "varchar(255) NOT NULL");
        $this->alterColumn($table, 'size', "varchar(255) NOT NULL");
    }

}