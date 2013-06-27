<?php

class m130603_053633_update_type_ extends CDbMigration {

    public function up() {
        $table = "conf_misc";
        $conditions = "param = 'smtp' OR param = 'fb_key' OR ";
        $conditions.= " param = 'fb_secret' OR param = 'google_key' OR ";
        $conditions.= " param = 'google_secret' OR param = 'twitter_key' OR ";
        $conditions.= " param = 'twitter_secret' OR param = 'linkedin_key' OR ";
        $conditions.= " param = 'linkedin_secret'  ";
        $this->update($table, array("misc_type" => "general"), $conditions);

        /**
         * upading others
         */
        $table = "conf_misc";
        $conditions = "param <> 'smtp' AND param <> 'fb_key' AND ";
        $conditions.= " param <> 'fb_secret' AND param <> 'google_key' AND ";
        $conditions.= " param <> 'google_secret' AND param <> 'twitter_key' AND ";
        $conditions.= " param <> 'twitter_secret' AND param <> 'linkedin_key' AND ";
        $conditions.= " param <> 'linkedin_secret'  ";
        $this->update($table, array("misc_type" => "other"), $conditions);
    }

    public function down() {
        $table = "conf_misc";
        $this->update($table, array("misc_type" => ""));
        
    }

}