<?php

class m130731_073253_mainFeatured extends CDbMigration {

    public function up() {
        $table = "categories";
        $this->addColumn($table, "is_main_featured", "tinyint(1) default 0 after category_image");
    }

    public function down() {
        $table = "categories";
        $this->dropColumn($table, "is_main_featured");
    }

}