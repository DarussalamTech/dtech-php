<?php

class m130715_070146_relationProductandProductLangs extends DTDbMigration {

    public function up() {
        $table = "product_lang";
        $this->addForeignKey("fk_".$table, $table, "product_id", "product", "product_id", "CASCADE", "CASCADE");
    }

    public function down() {
        $table = "product_lang";
        $this->dropForeignKey("fk_".$table, $table);
    }

}