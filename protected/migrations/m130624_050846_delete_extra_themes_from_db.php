<?php

class m130624_050846_delete_extra_themes_from_db extends CDbMigration {

    public function up() {
        $table = 'layout';
        $this->delete($table, "layout_name='classic'");
        $this->delete($table, "layout_name='new_theme'");
        $this->delete($table, "layout_name='dtech'");
        //$this->delete($table, "layout_name='dtech_second'");
    }

    public function down() {
        $table = 'layout';
        $columns = array(
            'layout_name' => 'classic',
            'layout_description' => 'classic',
            'layout_color' => 'black',
            'site_id' => 1);
        $this->insert($table, $columns);

        $columns = array(
            'layout_name' => 'new_theme',
            'layout_description' => 'new_theme',
            'layout_color' => 'red',
            'site_id' => 1);
        $this->insert($table, $columns);

        $columns = array(
            'layout_name' => 'dtech',
            'layout_description' => 'dtech',
            'layout_color' => 'white',
            'site_id' => 1);
        $this->insert($table, $columns);


//        $columns = array(
//            'layout_name' => 'dtech_second',
//            'layout_description' => 'dtech_second',
//            'layout_color' => 'black',
//            'site_id' => 1);
//        $this->insert($table, $columns);
    }

}