<?php

class m130717_075727_enter_english_textFields extends DTDbMigration {

    public function up() {

        $table = "categories";
        $allRecords = $this->findAllRecords($table, array("category_id", "category_name"), "category_id", "category_name");
        foreach ($allRecords as $id => $record) {
            $columns = array(
                "category_id" => $id,
                "category_name" => $record,
                "lang_id" => "en",
            );
            $this->insertRow("categories_lang", $columns);
        }
    }

    public function down() {
        $table = "categories";
        $allRecords = $this->findAllRecords($table, array("category_id", "category_name"), "category_id", "category_name");
        foreach ($allRecords as $id => $record) {
            $this->delete("categories_lang", "category_id = " . $id . " AND lang_id='en'");
        }
    }

}