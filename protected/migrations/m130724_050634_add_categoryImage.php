<?php

class m130724_050634_add_categoryImage extends DTDbMigration {

    public function up() {
        $table = 'categories';
        $this->addColumn($table, 'category_image', 'text  NULL after category_name');
    }

    public function down() {
        $table = 'categories';
        $this->dropColumn($table, "category_image");
    }

}