<?php

class m130703_093845_add_quantity_to_productProfile extends CDbMigration {

    public function up() {
        $table = "product_profile";
        $this->addColumn($table, "quantity", "int(11) DEFAULT 0 NOT NULL after price");
    }

    public function down() {
        $table = "product_profile";
        $this->dropColumn($table, "quantity");
    }

}