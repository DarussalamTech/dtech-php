<?php

class m130514_124417_alter_relation_cart_product_profile extends CDbMigration {

    public function up() {
        $table = "cart";

        $this->addForeignKey("fk_cart_product_profile", $table, "product_profile_id", "product_profile", "id");
    }

    public function down() {
        $table = "cart";
        $this->addForeignKey("cart_ibfk_2", $table, "product_id", "product", "product_id", "CASCADE", "CASCADE");
    }

}