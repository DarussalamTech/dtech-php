<?php

class m140218_110835_product_category_ksa extends DTDbMigration {

    public function up() {
        $lhr = $this->getLahoreCityId();
        $ryd = $this->getRiyadhCityId();
        
        $table = 'product_categories';
        $prod_category = $this->getQueryAll("SELECT t.product_id,t.category_id FROM `product_categories` as t left join product on t.product_id=product.product_id where city_id=" . $lhr[0]);
        $prod_lhr = $this->getQueryAll("SELECT product_id FROM `product` where city_id=" . $lhr[0]);
        $prod_ryd = $this->getQueryAll("SELECT product_id FROM `product` where city_id=" . $ryd[0]);


        $mapping = array();
        $counter = 0;
        foreach ($prod_lhr as $product) {
            $mapping[$product['product_id']]['new'] = $prod_ryd[$counter++]['product_id'];
        }
        
        $parent_categories = $this->getQueryAll("SELECT category_image,category_name,category_id FROM `categories` where city_id=" . $lhr[0] );
        $parent_for_new = $this->getQueryAll("select category_name,category_id from categories where city_id=" . $ryd[0] );

        $mapping_category = array(
        );

       
        //create mapping 
        foreach ($parent_categories as $category) {

            foreach ($parent_for_new as $newwcat) {

                if ($category['category_name'] == $newwcat['category_name']) {
                  
                    $mapping_category[$category['category_id']]['new'] = $newwcat['category_id'];
                   
                    break;
                }
            }
        }
      

        foreach ($prod_category as $column) {
            $index = $column['product_id'];
            $column['product_id'] = $mapping[$index]['new'];
            $column['category_id'] = $mapping_category[$column['category_id']]['new'];

            $this->insertRow($table, $column);
        }
        
        return true;
    }

    public function down() {
        echo "m140218_110835_product_category_ksa does not support migration down.\n";
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