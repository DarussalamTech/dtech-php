<?php

class m130627_150753_addNewrights extends DTDbMigration {

    public function up() {
        $this->truncateTable("authassignment");
        $this->truncateTable("authitem");
        $this->truncateTable("authitemchild");
        $this->truncateTable("rights");

        $sql = $this->readJsonData("darussalam_rights27june.sql");
        $this->execute($sql);
    }

    public function down() {
        return true;
    }

}