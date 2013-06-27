<?php

class m130625_101859_add_copmiler_trans_id_to_prodPrf extends CDbMigration {

    public function up() {
        $table = 'product_profile';
        $this->addColumn($table, "translator_id", "int(11) DEFAULT NULL after product_id");
        $this->addColumn($table, "compiler_id", "int(11) DEFAULT NULL after translator_id");
    }

    public function down() {
        $table = 'product_profile';
        $this->dropColumn($table, "translator_id");
        $this->dropColumn($table, "compiler_id");
    }

}