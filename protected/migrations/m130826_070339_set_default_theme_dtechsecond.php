<?php

class m130826_070339_set_default_theme_dtechsecond extends DTDbMigration {

    public function up() {
        $table = 'layout';
        $connection = Yii::app()->db;
        $sql = "SELECT * from layout where layout_name  = 'dtech_second'";
        $command = $connection->createCommand($sql);
        $rows = $command->queryAll();
        foreach ($rows as $theme) {

            $theme_id = $theme['layout_id'];
            $this->update('city', array('layout_id' => $theme_id));
        }
    }

    public function down() {
        return TRUE;
    }

}