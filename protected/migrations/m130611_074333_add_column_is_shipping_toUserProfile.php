<?php

class m130611_074333_add_column_is_shipping_toUserProfile extends CDbMigration {

    public function up() {
        $table = 'user_profile';
        $column = array();
        $this->addColumn($table, 'is_shipping_address', 'TINYINT(1) DEFAULT 0 after avatar');
    }

    public function down() {
        $table = "user_profile";
        $this->dropColumn($table, "is_shipping_address");
    }

}