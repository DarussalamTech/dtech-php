<?php

class m130803_101722_translationRelation extends DTDbMigration {

    public function up() {
        $table = "dt_messages_translations";
        $this->addForeignKey("fk_".$table, $table, "id", "dt_messages", "id", "CASCADE", "CASCADE");
    }

    public function down() {
        $table = "dt_messages_translations";
        $this->dropForeignKey("fk_".$table, $table);
    }

}