<?php

class m130509_110408_add_date_in_profile extends DTDbMigration {

    public function up() {
        $connection = Yii::app()->db;
        $sql = "SELECT * from product ";
        $command = $connection->createCommand($sql);
        $rows = $command->queryAll();
        $fields = array();

        $default_lang = $this->getQueryRow("SELECT language_id FROM language WHERE LOWER(language_name)='english'");

        foreach ($rows as $row) {
            $columns = array(
                "product_id" => $row['product_id'],
                "item_code" => $row['product_name'],
                "language_id" => $default_lang['language_id'],
                "create_time" => date("Y-m-d H:i:s"),
                "create_user_id" => 1,
                "update_time" => date("Y-m-d H:i:s"),
                "update_user_id" => 1,
            );
            $this->insert("product_profile", $columns);
        }
        return $fields;
    }

    public function down() {
        return true;
    }

}