<?php

class m130705_103706_alter_status_order extends CDbMigration {

    public function up() {
        $table = "order";
        $this->alterColumn($table, 'status', "enum('pending','process', 'completed', 'declined')");
    }

    public function down() {
        
        $table = "order";
        $this->alterColumn($table, 'status', "enum('process', 'approved', 'completed', 'declined')");
    }

}