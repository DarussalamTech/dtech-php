<?php

class m130507_081730_wordpress_database_structure_add extends DTDbMigration {

    public function up() {

        $sql = $this->readJsonData('wordpress_structure.sql');
        $this->execute($sql);
    }

    public function down() {
        $this->dropTable('wp_commentmeta');
        $this->dropTable('wp_comments');
        $this->dropTable('wp_links');
        $this->dropTable('wp_options');
        $this->dropTable('wp_postmeta');
        $this->dropTable('wp_posts');
        $this->dropTable('wp_terms');
        $this->dropTable('wp_term_relationships');
        $this->dropTable('wp_term_taxonomy');
        $this->dropTable('wp_usermeta');
        $this->dropTable('wp_users');
    }

}