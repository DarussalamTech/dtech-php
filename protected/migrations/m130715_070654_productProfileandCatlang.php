<?php

class m130715_070654_productProfileandCatlang extends DTDbMigration {

    public function up() {
        $table = "product_profile_lang";
        $columns = array(
            'id' => 'int(11) NOT NULL AUTO_INCREMENT',
            'product_profile_id' => 'int(11) NOT NULL',
            'title' => 'varchar(255) DEFAULT NULL COLLATE utf8_general_ci',
            'create_time' => 'datetime NOT NULL',
            'create_user_id' => 'int(11) unsigned NOT NULL',
            'update_time' => 'datetime NOT NULL',
            'update_user_id' => 'int(11) unsigned NOT NULL',
            'PRIMARY KEY (`id`)',
        );

        $this->createTable($table, $columns);

        $this->addForeignKey("fk_" . $table, $table, "product_profile_id", "product_profile", "id", "CASCADE", "CASCADE");
        
        /**
         * Category
         */
        $table = "categories_lang";
        $columns = array(
            'id' => 'int(11) NOT NULL AUTO_INCREMENT',
            'category_id' => 'int(11) NOT NULL',
            'category_name' => 'varchar(255) DEFAULT NULL COLLATE utf8_general_ci',
            'create_time' => 'datetime NOT NULL',
            'create_user_id' => 'int(11) unsigned NOT NULL',
            'update_time' => 'datetime NOT NULL',
            'update_user_id' => 'int(11) unsigned NOT NULL',
            'PRIMARY KEY (`id`)',
        );

        $this->createTable($table, $columns);

        $this->addForeignKey("fk_" . $table, $table, "category_id", "categories", "category_id", "CASCADE", "CASCADE");
    }

    public function down() {
        $table = "product_profile_lang";
        $this->dropTable($table);
        
        $this->dropForeignKey("fk_".$table, $table);
        
        $table = "categories_lang";
        $this->dropTable($table);
        
        $this->dropForeignKey("fk_".$table, $table);
    }

}