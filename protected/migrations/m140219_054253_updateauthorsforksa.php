<?php

class m140219_054253_updateauthorsforksa extends DTDbMigration {

    public function up() {
        
        $lhr = $this->getLahoreCityId();
        $ryd = $this->getRiyadhCityId();

        $table = 'product';


        $data = $this->getQueryAll("SELECT product_id,city_id,product_name,parent_cateogry_id,is_featured,authors  from " . $table . " Where city_id = " . $lhr[0]);
        

        $prod_lhr = $this->getQueryAll("SELECT product_id FROM `product` where city_id=" . $lhr[0]);
        $prod_ryd = $this->getQueryAll("SELECT product_id FROM `product` where city_id=" . $ryd[0]);


        $mapping = array();
        $counter = 0;
        foreach ($prod_lhr as $product) {
            $mapping[$product['product_id']]['new'] = $prod_ryd[$counter++]['product_id'];
        }
       
        
        foreach ($data as $columns) {
        
            $columns['city_id'] = $ryd[0];
            if (!empty($mapping[$columns['product_id']]['new'])) {
                $conditions = 'product_id=' . $mapping[$columns['product_id']]['new'];
                $this->update($table, array('authors' => $columns['authors']), $conditions);
//                $this->($table, $columns);
            }
        }
        return false;
    }

    public function down() {
        echo "m140219_054253_updateauthorsforksa does not support migration down.\n";
        return true;
    }

    /*
      // Use safeUp/safeDown to do migration with transaction
      public function safeUp()
      {
      }

      public function safeDown()
      {
      }
     */
}