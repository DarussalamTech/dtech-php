<?php

class m130514_121837_alter_relation_cart_product_profile extends CDbMigration {

    public function up() {
        $table = "cart";
        $this->dropForeignKey("cart_ibfk_2", $table);
    }

    public function down() {
        $table = "cart";
        $this->addForeignKey("cart_ibfk_2", $table, "product_id", "product", "product_id", "CASCADE", "CASCADE");
    }

}