<?php

class m130919_101311_alterUsertable_source extends CDbMigration {

    public function up() {
        $table = "user";
        $this->addColumn($table, "source", "enum ('own','outside') DEFAULT 'own' after join_date");
    }

    public function down() {
        $table = "user";
        $this->dropColumn($table, "source");
    }

}