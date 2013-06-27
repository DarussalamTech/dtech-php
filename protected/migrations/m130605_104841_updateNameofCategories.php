<?php

class m130605_104841_updateNameofCategories extends DTDbMigration {

    public function up() {
        $table = 'categories';
        $sql = "SELECT * FROM   " . $table;
        $sql.= " WHERE 
                (LOWER(category_name)     = LOWER('Quran') OR 
                  
                    LOWER(category_name)  = LOWER('Others') 
                ) ";


        $categories = $this->getQueryAll($sql);
        foreach($categories as $row){
            $this->update($table, array("category_name"=>  ucfirst($row['category_name'])),"category_id = ".$row['category_id']);
        }
    }

    public function down() {
        return true;
    }

}