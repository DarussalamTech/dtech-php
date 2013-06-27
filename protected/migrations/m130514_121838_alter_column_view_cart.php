<?php

class m130514_121838_alter_column_view_cart extends CDbMigration {

    public function up() {
        $table = "cart";
        $this->renameColumn($table, "product_id", "product_profile_id");
    }

    public function down() {
        $table = "cart";
        $this->renameColumn($table, "product_profile_id", "product_id");
    }

}