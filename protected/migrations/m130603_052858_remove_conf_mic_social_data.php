<?php

class m130603_052858_remove_conf_mic_social_data extends CDbMigration {

    public function up() {

        $table = "conf_misc";

        $this->delete($table, "param='fb_key' AND city_id!=1");
        $this->delete($table, "param='fb_secret' AND city_id!=1");

        $this->delete($table, "param='google_key' AND city_id!=1");
        $this->delete($table, "param='google_secret' AND city_id!=1");

        $this->delete($table, "param='twitter_key' AND city_id!=1");
        $this->delete($table, "param='twitter_secret' AND city_id!=1");

        $this->delete($table, "param='linkedin_key' AND city_id!=1");
        $this->delete($table, "param='linkedin_secret' AND city_id!=1");
        
        
        $this->delete($table, "param='smtp' AND city_id!=1");
    }

    public
            function down() {
        return TRUE;
    }

}