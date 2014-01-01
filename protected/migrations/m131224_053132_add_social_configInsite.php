<?php

class m131224_053132_add_social_configInsite extends DTDbMigration {

    public function up() {
        $table = "site";
        $this->addColumn($table, "fb_key", "varchar(150) DEFAULT NULL after site_headoffice");
        $this->addColumn($table, "fb_secret", "varchar(150) DEFAULT NULL after fb_key");
        $this->addColumn($table, "google_key", "varchar(150) DEFAULT NULL after fb_secret");
        $this->addColumn($table, "google_secret", "varchar(150) DEFAULT NULL after google_key");


        $this->addColumn($table, "twitter_key", "varchar(150) DEFAULT NULL after google_secret");
        $this->addColumn($table, "twitter_secret", "varchar(150) DEFAULT NULL after twitter_key");
        $this->addColumn($table, "linkedin_key", "varchar(150) DEFAULT NULL after twitter_secret");
        $this->addColumn($table, "linkedin_secret", "varchar(150) DEFAULT NULL after linkedin_key");
    }

    public function down() {
        $table = "site";

        $this->dropColumn($table, "fb_key");
        $this->dropColumn($table, "fb_secret");
        $this->dropColumn($table, "google_key");
        $this->dropColumn($table, "google_secret");


        $this->dropColumn($table, "twitter_key");
        $this->dropColumn($table, "twitter_secret");
        $this->dropColumn($table, "linkedin_key");
        $this->dropColumn($table, "linkedin_secret");
    }

}