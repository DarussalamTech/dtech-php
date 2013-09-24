<?php

class m130717_131725_addLanguageforProduct extends DTDbMigration {

    public function up() {

        $table = "product";
        $allRecords = $this->getQueryAll("SELECT product_id,product_name,product_description,product_overview From product");
        foreach ($allRecords as $record) {


            $columns = array(
                "product_id" => $record['product_id'],
                "product_name" => $record['product_name'],
                "product_description" => $record['product_description'],
                "product_overview" => $record['product_overview'],
                "lang_id" => "en",
            );
            $this->insertRow("product_lang", $columns);
        }
    }

    public function down() {
        $table = "product";
        $allRecords = $this->getQueryAll("SELECT product_id,product_name,product_description,product_overview From product");
        foreach ($allRecords as $record) {
            $this->delete("product_lang", "product_id = " . $record['product_id'] . " AND lang_id='en'");
        }
    }

}