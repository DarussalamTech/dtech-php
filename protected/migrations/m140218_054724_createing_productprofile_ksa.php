<?php

class m140218_054724_createing_productprofile_ksa extends DTDbMigration {

    public function up() {
        $lhr = $this->getLahoreCityId();
        $ryd = $this->getRiyadhCityId();
        $table = 'product';
        $table2 = 'product_profile';
        $prod_prof = $this->getQueryAll("SELECT t.product_id,title,item_code,language_id,quantity,no_of_pages,binding,printing,paper,dimension,weight,weight_unit,is_shippable,edition,color,attribute,attribute,compiler_id,translator_id,isbn 	 FROM `product_profile` as t left join product on t.product_id=product.product_id where product.city_id=" . $lhr[0]);
        $prod_lhr = $this->getQueryAll("SELECT product_id FROM `product` where city_id=" . $lhr[0]);
        $prod_ryd = $this->getQueryAll("SELECT product_id FROM `product` where city_id=" . $ryd[0]);


        $mapping = array();
        $counter = 0;
        foreach ($prod_lhr as $product) {
            $mapping[$product['product_id']]['new'] = $prod_ryd[$counter++]['product_id'];
        }


        foreach ($prod_prof as $column) {

            if (!empty($column['product_id']) && !empty($mapping[$column['product_id']]['new'])) {
                $index = $column['product_id'];
                $column['product_id'] = $mapping[$index]['new'];
                $column['item_code'] = 'RYD-' . $mapping[$index]['new'];

                $this->insertRow($table2, $column);
            }
        }


        return true;
    }

    public function down() {
        echo "m140218_054724_createing_productprofile_ksa does not support migration down.\n";
        return true;
    }

}