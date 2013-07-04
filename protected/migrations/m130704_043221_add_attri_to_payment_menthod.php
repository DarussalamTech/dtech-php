<?php

class m130704_043221_add_attri_to_payment_menthod extends CDbMigration {

    public function up() {
        $table = 'payment_methods';
        $this->addColumn($table, 'key', 'varchar(255)  after status');
        $this->addColumn($table, 'secret', 'varchar(255) after id');
        $this->addColumn($table, 'city_id', 'int(11) NULL after name');
    }

    public function down() {
        $table = 'payment_methods';
        $this->dropColumn($table, 'key');
        $this->dropColumn($table, 'secret');
        $this->dropColumn($table, 'city_id');
    }

}