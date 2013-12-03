<?php

/*
 * specific model relevant to web service
 * consist of all methods for webservices
 */

class ProductWS extends Product {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Product the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'product';
    }

    /**
     * 
     * Get All books for web services
     */
    public function getWsAllBooks($cat_id = "") {
        $cat_id=57;
        $criteria = new CDbCriteria(array(
            'select' => 't.product_id,t.product_name,t.product_description',
            'order' => 't.product_id ASC',
            'condition' => 't.parent_id=57',
        ));
        
        if($cat_id != ""){
            
      

        $data = Product::model()->with(array('productProfile' => array('select' => 'price')))->findAll($criteria);
        
        $all_products = array();
        $images = array();
        foreach ($data as $products) {
            $product_id = $products->product_id;
            $criteria2 = new CDbCriteria;
            $criteria2->select = 'id,product_profile_id,image_large,image_small,is_default';  // only select the 'title' column
            $criteria2->condition = "product_profile_id='" . $product_id . "'";
            $imagedata = ProductImage::model()->findAll($criteria2);
            $images = array();
            foreach ($imagedata as $img) {
                if ($img->is_default == 1) {
                    $images[] = array(
                        'image_large' => Yii::app()->request->hostInfo . $img->image_url['image_large'],
                        'image_small' => Yii::app()->request->hostInfo . $img->image_url['image_small'],
                    );
                    break;
                } else {
                    $images[] = array(
                        'image_large' => Yii::app()->request->hostInfo . $img->image_url['image_large'],
                        'image_small' => Yii::app()->request->hostInfo . $img->image_url['image_small'],
                    );
                    break;
                }
            }

            $all_products[] = array(
                'product_id' => $products->product_id,
                'product_name' => $products->product_name,
                //'product_description' => $products->product_description,
                'product_author' => !empty($products->author) ? $products->author->author_name : "",
                'currencySymbol' => '$',
                'product_price' => $products->productProfile[0]->price,
                'image' => $images,
                
            );
        }
        return $all_products;
        }
        else {
            return "category Id is not set";
        }
    }

    /*
     * Get All Categories with relevant books
     * for webservice
     */

    public function getWsAllBooksByCategory() {
        $cate = new Categories;
        $categories = $cate->getAllCategoriesForWebService();

        $category_info = array();
        foreach ($categories as $c) {
            $criteria = new CDbCriteria(array(
                'select' => 't.product_id,t.product_name,t.product_description',
                'order' => 't.product_id ASC',
                'condition' => "t.product_id=productCategories.product_id AND productCategories.category_id=$c->category_id"
            ));

            $data = Product::model()->with(array('productProfile' => array('select' => 'price'), 'productCategories'))->findAll($criteria);
            $all_products = array();
            $images = array();
            foreach ($data as $products) {
                $product_id = $products->product_id;
                $criteria2 = new CDbCriteria;
                $criteria2->select = 'id,product_profile_id,image_large,image_small,is_default';  // only select the 'title' column
                $criteria2->condition = "product_profile_id='" . $product_id . "'";
                $imagedata = ProductImage::model()->findAll($criteria2);
                $images = array();
                foreach ($imagedata as $img) {
                    if ($img->is_default == 1) {
                        $images[] = array(
                            'image_large' => Yii::app()->request->hostInfo . $img->image_url['image_large'],
                            'image_small' => Yii::app()->request->hostInfo . $img->image_url['image_small'],
                        );
                        break;
                    } else {
                        $images[] = array(
                            'image_large' => Yii::app()->request->hostInfo . $img->image_url['image_large'],
                            'image_small' => Yii::app()->request->hostInfo . $img->image_url['image_small'],
                        );
                        break;
                    }
                }

                $all_products[] = array(
                    'product_id' => $products->product_id,
                    'product_name' => $products->product_name,
                    'product_description' => $products->product_description,
                    'product_author' => !empty($products->author) ? $products->author->author_name : "",
                    'currencySymbol' => '$',
                    'product_price' => $products->productProfile[0]->price,
                    'image' => $images
                );
            }

            $category_info['category_products'][] = array(
                'category_id' => $c->category_id,
                'category_name' => $c->category_name,
                'products' => $all_products
            );
        }
        return $category_info;
    }

    /*
     * Web service which returns 
     * all information including books information
     * of requested relevant category
     * 
     * 
     */

    public function getWsRequestByCategory($cat_id) {



        $criteria = new CDbCriteria(array(
            'select' => 't.product_id,t.product_name,t.product_description',
            'order' => 't.product_id ASC',
            'condition' => "t.product_id=productCategories.product_id AND productCategories.category_id=$cat_id"
        ));

        $data = Product::model()->with(array('productProfile' => array('select' => 'price'), 'productCategories'))->findAll($criteria);
       
        $all_products = array();
        $images = array();
        foreach ($data as $products) {
            $product_id = $products->product_id;
            $criteria2 = new CDbCriteria;
            $criteria2->select = 'id,product_profile_id,image_large,image_small,is_default';  // only select the 'title' column
            $criteria2->condition = "product_profile_id='" . $product_id . "'";
            $imagedata = ProductImage::model()->findAll($criteria2);
            $images = array();
            foreach ($imagedata as $img) {
                if ($img->is_default == 1) {
                    $images[] = array(
                        'image_large' => Yii::app()->request->hostInfo . $img->image_url['image_large'],
                        'image_small' => Yii::app()->request->hostInfo . $img->image_url['image_small'],
                    );
                    break;
                } else {
                    $images[] = array(
                        'image_large' => Yii::app()->request->hostInfo . $img->image_url['image_large'],
                        'image_small' => Yii::app()->request->hostInfo . $img->image_url['image_small'],
                    );
                    break;
                }
            }

            $all_products[] = array(
                'product_id' => $products->product_id,
                'product_name' => $products->product_name,
                //'product_description' => $products->product_description,
                'product_author' => !empty($products->author) ? $products->author->author_name : "",
                'currencySymbol' => '$',
                'product_price' => $products->productProfile[0]->price,
                'image' => $images
            );
        }

        return $all_products;
    }

}

?>
