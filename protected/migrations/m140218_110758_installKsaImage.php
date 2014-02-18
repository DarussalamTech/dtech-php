<?php

class m140218_110758_installKsaImage extends DTDbMigration {

    /**
     * 
     * @return boolean
     */
    public function up() {
        $ryd = $this->getRiyadhCityId();
        $lhr = $this->getLahoreCityId();
          return true;
        //get ryad profiles
        $sql = "SELECT product_profile.* From product_profile
                INNER JOIN product ON product_profile.product_id = product.product_id
                WHERE product.city_id = " . $ryd[0];

        $ryadProfiles = $this->getQueryAll($sql);

        //get lahore profiles

        $sql = "SELECT product_profile.* From product_profile
                INNER JOIN product ON product_profile.product_id = product.product_id
                WHERE product.city_id = " . $lhr[0];

        $lahoreProfiles = $this->getQueryAll($sql);


        $mapping = array();
        $counter = 0;
        foreach ($lahoreProfiles as $product) {
            $mapping[$product['product_id']]['new'] = $ryadProfiles[$counter++]['product_id'];
        }

        //install images
        $this->installImages($mapping);
      
    }

    public function down() {
        return true;
    }

    /**
     * 
     * @param type $mapping
     */
    public function installImages($mapping) {
        foreach ($mapping as $old => $data) {
            $sql = "SELECT * FROM product_image WHERE product_profile_id =" . $old;
            $images = $this->getQueryAll($sql);

            if (!empty($images)) {
                $dir_path = $this->createProfileDirectories($data['new']);
                if ($dir_path != "") {
                    $prodImagepth = $dir_path . DIRECTORY_SEPARATOR . "product_images";
                    if (!is_dir($prodImagepth)) {
                        mkdir($prodImagepth);
                    }

                    $oldBasePath = Yii::app()->basePath . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "uploads";
                    $oldBasePath.= DIRECTORY_SEPARATOR . "product" . DIRECTORY_SEPARATOR.$old;

                    $this->insertAndCopyImage($old, $data['new'], $prodImagepth,$oldBasePath, $images);
                }
            }

            // echo "\n";
        }
    }

    /**
     *  generate new profile id images
     * @param type $profle_id
     */
    public function createProfileDirectories($profle_id) {
        $basePath = Yii::app()->basePath . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "uploads";
        $basePath.= DIRECTORY_SEPARATOR . "product" . DIRECTORY_SEPARATOR;

        if (!is_dir($basePath . $profle_id)) {
            $dirpath = $basePath . $profle_id;
            mkdir($dirpath);
            return realpath($dirpath);
        } else if (is_dir($basePath . $profle_id)) {
            return realpath($basePath . $profle_id);
        }
        return "";
    }

    /**
     * insert into images
     * in database and generate their images
     * @param type $old_id
     * @param type $new_id
     * @param type $basePath
     * @param type $images
     */
    public function insertAndCopyImage($old_id, $new_id, $basePath,$oldPath, $images) {
        $basePath = $basePath . DIRECTORY_SEPARATOR;
        //echo $basePath." --".$old_id."--".$new_id;
        $mapping = array();
        foreach ($images as $image) {
            //for new create columns unset and rest the columns like
            //id and profile_id

            $sql = "SELECT max(product_image.id) as max_id FROM product_image";
            $max_row = $this->getQueryRow($sql);
            //echo $max_row['max_id'];

            $newpk = $max_row['max_id'];
            $newpk = $newpk + 1;

            $old_img_id = $image['id'];
            unset($image['id']);
            unset($image['create_time']);
            unset($image['update_time']);
            unset($image['update_user_id']);
            unset($image['create_user_id']);
            $image['product_profile_id'] = $new_id;
            $image['id'] = $newpk;
            // print_r($image);

            $this->insertRow("product_image", $image);

            $dir_path = $basePath . $newpk;
            if (!is_dir($basePath . $newpk)) {
                mkdir($dir_path, 0755);
            }
            //installing images
            $oldPath = $oldPath .DIRECTORY_SEPARATOR."product_images".DIRECTORY_SEPARATOR;
            
            if (is_dir($oldPath . $old_img_id)) {
                
                echo $oldPath . $old_img_id . DIRECTORY_SEPARATOR . $image['image_small'];
                
                if (is_file($oldPath . $old_img_id . DIRECTORY_SEPARATOR . $image['image_small'])) {
                    copy($oldPath . $old_img_id . DIRECTORY_SEPARATOR . $image['image_small'], $dir_path . DIRECTORY_SEPARATOR . $image['image_small']);
                }
                if (is_file($oldPath . $old_img_id . DIRECTORY_SEPARATOR . $image['image_detail'])) {
                    copy($oldPath . $old_img_id . DIRECTORY_SEPARATOR . $image['image_detail'], $dir_path . DIRECTORY_SEPARATOR . $image['image_detail']);
                }
                if (is_file($oldPath . $old_img_id . DIRECTORY_SEPARATOR . $image['image_cart'])) {
                    copy($oldPath . $old_img_id . DIRECTORY_SEPARATOR . $image['image_cart'], $dir_path . DIRECTORY_SEPARATOR . $image['image_cart']);
                }
                if (is_file($oldPath . $old_img_id . DIRECTORY_SEPARATOR . $image['image_large'])) {
                    copy($oldPath . $old_img_id . DIRECTORY_SEPARATOR . $image['image_large'], $dir_path . DIRECTORY_SEPARATOR . $image['image_large']);
                }
            }
        }
        echo "\n";
    }

}