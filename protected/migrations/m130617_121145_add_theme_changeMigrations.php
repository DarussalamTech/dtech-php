<?php

class m130617_121145_add_theme_changeMigrations extends DTDbMigration {

        
    public function up() {
        $table = "conf_misc";
        $columns = array(
                "title" => "Theme",
                "param" => "theme",
                "value" => "",
                "field_type" => "dropDown",
                "misc_type" => "general",

            );
        $this->insert($table, $columns);
    }

    public function down() {
          $table = "conf_misc";
          $this->delete($table,"param = 'theme'");
    }

}