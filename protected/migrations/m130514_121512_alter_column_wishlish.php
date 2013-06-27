<?php

class m130514_121512_alter_column_wishlish extends CDbMigration {

    public function up() {
        $table = "wish_list";
        $this->renameColumn($table, "product_id", "product_profile_id");
    }

    public function down() {
        $table = "wish_list";
        $this->renameColumn($table, "product_profile_id", "product_id");
    }

}