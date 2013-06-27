<?php

class m130522_071341_add_shipping_fields_in_userprofile extends CDbMigration {

    public function up() {
        $table = "user_profile";
        $this->addColumn($table, "shipping_prefix", "varchar(10) NULL after avatar");
        $this->addColumn($table, "shipping_first_name", "varchar(255) NULL after shipping_prefix");
        $this->addColumn($table, "shipping_last_name", "varchar(255) NULL after shipping_first_name");
        $this->addColumn($table, "shipping_address1", "varchar(255) NULL after shipping_last_name");
        $this->addColumn($table, "shipping_address2", "varchar(255) NULL after shipping_address1");
        $this->addColumn($table, "shipping_country", "int(11) NULL after shipping_address2");
        $this->addColumn($table, "shipping_state", "varchar(10) NULL after shipping_country");
        $this->addColumn($table, "shipping_city", "varchar(50) NULL after shipping_state");
        $this->addColumn($table, "shipping_zip", "int(11) NULL after shipping_city");
        $this->addColumn($table, "shipping_phone", "varchar(50) NULL after shipping_zip");
    }

    public function down() {
        $table = "user_profile";
        $this->dropColumn($table, "shipping_prefix");
        $this->dropColumn($table, "shipping_first_name");
        $this->dropColumn($table, "shipping_last_name");
        $this->dropColumn($table, "shipping_address1");
        $this->dropColumn($table, "shipping_address2");
        $this->dropColumn($table, "shipping_country");
        $this->dropColumn($table, "shipping_state");
        $this->dropColumn($table, "shipping_city");
        $this->dropColumn($table, "shipping_zip");
        $this->dropColumn($table, "shipping_phone");
    }

}