<?php

class m130507_100501_wordpress_only_database_data_add extends DTDbMigration {

    public function up() {

        $sql = $this->readJsonData('wordpress_data.sql');
        $this->execute($sql);
    }

    public function down() {
        $this->truncateTable('wp_commentmeta');
        $this->truncateTable('wp_comments');
        $this->truncateTable('wp_links');
        $this->truncateTable('wp_options');
        $this->truncateTable('wp_postmeta');
        $this->truncateTable('wp_posts');
        $this->truncateTable('wp_terms');
        $this->truncateTable('wp_term_relationships');
        $this->truncateTable('wp_term_taxonomy');
        $this->truncateTable('wp_usermeta');
        $this->truncateTable('wp_users');
    }

}