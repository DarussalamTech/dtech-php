<?php

class m130704_061505_addSignatureField extends DTDbMigration {

    public function up() {
        $table = 'payment_methods';
        $this->addColumn($table, 'signature', 'varchar(255) DEFAULT NULL after secret');
    }

    public function down() {
        $table = 'payment_methods';
        $this->dropColumn($table, 'signature');
    }

}