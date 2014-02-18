<?php

class m140217_121527_category_creation_completion extends DTDbMigration {

    public function up() {
        $basePath = Yii::app()->basePath . DIRECTORY_SEPARATOR . "..";
        $lhr = $this->getLahoreCityId();
        $ryd = $this->getRiyadhCityId();
        $table = 'categories';

        $data = $this->getQueryAll("SELECT category_name,user_order,parent_id,city_id,create_user_id from categories Where city_id = " . $lhr[0]);

        $parent_categories = $this->getQueryAll("SELECT category_image,category_name,category_id FROM `categories` where city_id=" . $lhr[0] . " and parent_id=0 ");
        $parent_for_new = $this->getQueryAll("select category_name,category_id from categories where city_id=" . $ryd[0] . " and parent_id=0 ");

        $mapping = array(
        );

        $counter = 0;
        //create mapping 
        foreach ($parent_categories as $category) {

            foreach ($parent_for_new as $newwcat) {

                if ($category['category_name'] == $newwcat['category_name']) {
                    $mapping[$counter]['category_name'] = $category['category_name'];
                    $mapping[$counter]['old'] = $category['category_id'];
                    $mapping[$counter]['new'] = $newwcat['category_id'];
                    $mapping[$counter++]['image'] = $category['category_image'];
                    break;
                }
            }
        }

        //generating image and children categories insertion
        foreach ($data as $columns) {

            $columns['city_id'] = $ryd[0];
            foreach ($mapping as $map) {
                if ($columns['parent_id'] == $map['old']) {
                    $columns['parent_id'] = $map['new'];

                    if (!empty($map['image'])) {
                        $newpath = $basePath . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'parent_category' . DIRECTORY_SEPARATOR . $map['new'];
                        $oldpath = $basePath . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'parent_category' . DIRECTORY_SEPARATOR . $map['old'];

                        if (!is_dir($newpath)) {


                            mkdir($newpath, 0777, true);
                        }

                        echo "\n";
                        echo $oldpath . DIRECTORY_SEPARATOR . $map['image'];

                        if (is_file($oldpath . DIRECTORY_SEPARATOR . $map['image'])) {
                            copy($oldpath . DIRECTORY_SEPARATOR . $map['image'], $newpath . DIRECTORY_SEPARATOR . $map['image']);
                        }
                    }
                }
            }

            $this->insertRow($table, $columns);
        }
        return true;
    }

    public function down() {
        echo "m140217_121527_category_creation_completion does not support migration down.\n";
        return true;
    }

}