<?php

class m130509_094620_remove_author_profile_author extends CDbMigration {

    public function up() {
        $table = "product_profile";
        $this->dropForeignKey("product_profile_ibfk_1", $table);
        $this->dropColumn($table, "author_id");
    }

    public function down() {
        $table = "product_profile";
        $this->addColumn($table, "author_id", "int(11) DEFAULT NULL");
        $this->addForeignKey("product_profile_ibfk_1", $table, "author_id", "author", "author_id");
    }

}