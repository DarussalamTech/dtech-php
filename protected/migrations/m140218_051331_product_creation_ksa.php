<?php

class m140218_051331_product_creation_ksa extends DTDbMigration {

    public function up() {
        $lhr = $this->getLahoreCityId();
        $ryd = $this->getRiyadhCityId();
      
        $table = 'product';
        

        $data = $this->getQueryAll("SELECT city_id,product_name,parent_cateogry_id,is_featured  from " . $table . " Where city_id = " . $lhr[0]);
        

        $parent_categories = $this->getQueryAll("SELECT category_image,category_name,category_id FROM `categories` where city_id=" . $lhr[0] . " and parent_id=0 ");
        $parent_for_new = $this->getQueryAll("select category_name,category_id from categories where city_id=" . $ryd[0] . " and parent_id=0 ");

        $mapping = array(
        );

       
        foreach ($parent_categories as $category) {

            foreach ($parent_for_new as $newwcat) {

                if ($category['category_name'] == $newwcat['category_name']) {

                    $mapping[$category['category_id']]['new'] = $newwcat['category_id'];

                    break;
                }
            }
        }

        foreach ($data as $columns) {
            $columns['city_id'] = $ryd[0];

            $columns['parent_cateogry_id'] = $mapping[$columns['parent_cateogry_id']]['new'];
            
            $this->insertRow($table, $columns);

        }

        return true;
    }

    public function down() {
        echo "m140218_051331_product_creation_ksa does not support migration down.\n";
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