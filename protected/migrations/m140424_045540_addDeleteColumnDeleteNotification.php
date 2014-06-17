<?php

class m140424_045540_addDeleteColumnDeleteNotification extends DTDbMigration {

    public function up() {
        $table = "notifcation";
        $this->addColumn($table, "deleted", "tinyint(1) DEFAULT 0 after is_read");
    }

    public function down() {
        $table = "notifcation";
        $this->dropColumn($table, "deleted");
    }

}