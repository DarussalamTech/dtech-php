<?php

class m130717_165515_productProfileLangdata extends DTDbMigration {

    public function up() {

        $table = "product_profile";
        $allRecords = $this->getQueryAll("SELECT id,title From product_profile");
        foreach ($allRecords as $record) {


            $columns = array(
                "product_profile_id" => $record['id'],
                "title" => $record['title'],
         
                "lang_id" => "en",
            );
            $this->insertRow("product_profile_lang", $columns);
        }
    }

    public function down() {
        $table = "product_profile";
        $allRecords = $this->getQueryAll("SELECT id,title From product_profile");
        foreach ($allRecords as $record) {
            $this->delete("product_profile_lang", "product_profile_id = " . $record['id'] . " AND lang_id='en'");
        }
    }

}