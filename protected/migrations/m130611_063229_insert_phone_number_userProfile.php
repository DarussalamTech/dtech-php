<?php

class m130611_063229_insert_phone_number_userProfile extends CDbMigration {

    public function up() {
        $table = 'user_profile';
        $column = array();
        $this->addColumn($table, 'mobile_number', 'varchar(50) NULL after contact_number');
    }

    public function down() {
        $table = "user_profile";
        $this->dropColumn($table, "mobile_number");
    }

}