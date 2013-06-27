<?php

class m130624_050845_removeLayoutRelationwithcity extends CDbMigration {

    public function up() {
        $table = "city";
        $this->dropForeignKey("city_ibfk_2", $table);
    }

    public function down() {
        $table = "city";
        $this->addForeignKey("city_ibfk_2", $table, "layout_id", "layout", "layout_id", "CASCADE", "CASCADE");
    }

}