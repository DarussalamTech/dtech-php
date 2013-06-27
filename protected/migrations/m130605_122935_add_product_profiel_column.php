<?php

class m130605_122935_add_product_profiel_column extends CDbMigration {

    public function up() {
        $table = "product_profile";
        $this->addColumn($table, 'attribute', "varchar(255) DEFAULT NULL after edition");
        $this->addColumn($table, 'attribute_value', "varchar(255) DEFAULT NULL after attribute");
    }

    public function down() {
        $table = "product_profile";
        $this->dropColumn($table, 'attribute');
        $this->dropColumn($table, 'attribute_value');
    }

}