<?php

class m130605_074522_update_other_category_underBooks extends DTDbMigration {

    public function up() {
        $table = 'categories';
        $sql = "SELECT * FROM   " . $table;
        $sql.= " WHERE 
                (category_name  <> 'Quran' AND 
                    category_name  <> 'Educational Toys' AND 
                    category_name  <> 'Others' AND 
                    category_name  <> 'Books' AND
                    category_name  <> 'quran' 
                ) ";


        $categories = $this->getQueryAll($sql);


        foreach ($categories as $row) {
       
            
            $sql = "SELECT category_id from " . $table;
            $sql.= " WHERE city_id = " . $row['city_id'];
            $sql.= " AND category_name ='Books'";
            $category = $this->getQueryRow($sql);
          
            $this->update($table, array("parent_id" => $category['category_id']),"category_id=".$row['category_id']);
        }
   
    }

    public function down() {
        return true;
    }

}