<?php

class m130919_070857_addJoomlaUser extends DTDbMigration {

    public function up() {
        $sql = $this->readJsonData("jos_users.sql");
        $this->execute($sql);
    }

    public function down() {
        $table = "joomla_users";
        $this->dropTable($table);
    }

}