<?php

class m130509_103630_add_product_profile_relation_language extends CDbMigration {

    public function up() {
        $table = "product_profile";
        $this->truncateTable($table);
        $this->addColumn($table, "discount_type", "enum('fixed','percentage') DEFAULT NULL after language_id");
        $this->addColumn($table, "discount_value", "int(11) DEFAULT NULL after discount_type");
        $this->addForeignKey("fk_prod_profile_lang", $table, "language_id", "language", "language_id");
    }

    public function down() {
        $table = "product_profile";
        $this->dropForeignKey("fk_prod_profile_lang", $table);
        $this->dropColumn($table, "discount_type");
        $this->dropColumn($table, "discount_value");
    }

}