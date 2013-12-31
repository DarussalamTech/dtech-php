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
        $cat_id = 57;
        $criteria = new CDbCriteria(array(
            'select' => 't.product_id,t.product_name,t.product_description',
            'order' => 't.product_id ASC',
            'condition' => 't.parent_id=57',
        ));

        if ($cat_id != "") {



            $data = Product::model()->with(array('productProfile' => array('select' => 'price,author')))->findAll($criteria);

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
                    'product_url' => Yii::app()->controller->createUrl("/web/product/productDetail", array("pcategory" => $products->parent_category->slug, "slug" => $products->slag)),
                    'image' => $images,
                );
            }
            return $all_products;
        } else {
            return "category Id is not set";
        }
    }

    /*
     * Get All Categories with relevant books
     * for webservice
     */

    public function getWsAllBooksByCategory($page = "", $category = "", $author = "", $search = "", $language = "") {

        $cate = new Categories;
        // Getting the categories for drop downs
        $categories = $cate->getAllCategoriesForWebService();
        // Getting the language for drop downs

        $lang = Language::model()->findAll();

        // Getting the Authors for drop downs

        $authors = Author::model()->findAll();



        // making dynamic string according to the requirements

        $condtion = !empty($category) ? " AND productCategories.category_id =" . $category : "";
        $condtion .=!empty($author) ? " AND author.author_id =" . $author : "";
        $condtion .=!empty($language) ? " AND productProfile.language_id =" . $language : "";



        $category_info = array();

        //Criteria building

        $criteria = new CDbCriteria(array(
            'select' => 't.product_id,t.product_name,t.product_description,t.slag,t.parent_cateogry_id',
            'with' => array('productProfile' => array('select' => 'price'), 'productCategories', 'author'),
            'condition' => "t.parent_cateogry_id=57" . $condtion,
            'order' => 't.product_id ASC',
            'distinct' => true,
            'together' => true,
        ));





        // Making data Provider for front end with pagination
        $dataProvider = new DTActiveDataProvider($this, array(
            'pagination' => array(
                'pageSize' => 12,
                'currentPage' => $page,
            ),
            'criteria' => $criteria,
        ));

        //Getting data from the data provider according to criteria
        $data = $dataProvider->getData();


//        CVarDumper::dump($data[10]['product_id'],20,true);


        $all_products = array();
        $images = array();


        // Populating the Required fields for the frontend
        foreach ($data as $products) {
            $product_id = $products->product_id;
//            echo $products->product_id ."-";
            $criteria2 = new CDbCriteria;
            $criteria2->select = 'id,product_profile_id,image_large,image_small,is_default';  // only select the 'title' column
            $criteria2->condition = "product_profile_id ='" . $products->productProfile[0]->id . "'";
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

            // Array is filled with all the products
            $all_products[] = array(
                'product_id' => $products->product_id,
                'product_name' => $products->product_name,
                'product_description' => $products->product_description,
                'product_author' => !empty($products->author) ? $products->author->author_name : "",
                'product_author_id' => !empty($products->author) ? $products->author->author_id : "",
                'currencySymbol' => '$',
                'product_price' => $products->productProfile[0]->price,
                'image' => $images,
                'category_id' => !empty($products->productCategories[0]->category_id) ? $products->productCategories[0]->category_id : 57,
                'product_url' => "http://www.darussalampk.com/en/pak/lahore/1/Books/" . $products->slag . "/detail"
            );
        }





        // Products To return to the front end
        $products = array(
            'allCat' => $categories,
            'languages' => $lang,
            'authors' => $authors,
            'products' => $all_products,
            'pageSize' => $dataProvider->pagination->getPageSize(),
            'pageCount' => $dataProvider->pagination->getPageCount(),
            'itemCount' => $dataProvider->pagination->getItemCount(),
        );

//        CVarDumper::dump($products['products'],20,true);
//        die;
        return $products;
    }

    /**
     *
     * Get All Categories with relevant books
     * for webservice
     *
     * @param type $page
     * @param type $limit
     * @return type
     */
    public function getWsAllBooksByCatalogue($page = "", $limit = 5) {



        $criteria = new CDbCriteria(array(
            'select' => 't.product_id,t.product_name,t.product_description,t.product_overview,t.slag,t.parent_cateogry_id',
            'with' => array('productProfile' => array('select' => 'price', 'type' => 'INNER JOIN')),
            'condition' => "t.parent_cateogry_id=57",
            'order' => 't.product_id DESC',
            'distinct' => 't.product_id',
            'together' => true,
        ));
        $page = $page + 1;
        // Making data Provider for front end with pagination
        $dataProvider = new DTActiveDataProvider($this, array(
            'pagination' => array(
                'pageSize' => $limit,
                'currentPage' => $page,
            ),
            'criteria' => $criteria,
        ));

        //$dataProvider->sho
        //Getting data from the data provider according to criteria
        $data = $dataProvider->getData();

      


        $all_products = array();
        $images = array();


        // Populating the Required fields for the frontend
        foreach ($data as $products) {
            $product_id = $products->product_id;

            $criteria2 = new CDbCriteria;
            $criteria2->select = 'id,product_profile_id,image_large,image_small,is_default';  // only select the 'title' column
            $criteria2->condition = "product_profile_id ='" . $products->productProfile[0]->id . "'";
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

            // Array is filled with all the products
            $all_products[] = array(
                'product_id' => $products->product_id,
                'product_name' => $products->product_name,
                'product_description' => $products->product_description,
                'product_overview' => $products->product_overview,
                'product_author' => !empty($products->author) ? $products->author->author_name : "",
                'product_author_id' => !empty($products->author) ? $products->author->author_id : "",
                'currencySymbol' => '$',
                'product_price' => $products->productProfile[0]->price,
                'image' => $images,
                'category_id' => !empty($products->productCategories[0]->category_id) ? $products->productCategories[0]->category_id : 57,
                'product_url' => "http://www.darussalampk.com/en/pak/lahore/1/Books/" . $products->slag . "/detail"
            );
        }

        // Products To return to the front end
        $products = array(
            'products' => $all_products,
            'pageSize' => $dataProvider->pagination->getPageSize(),
            'pageCount' => $dataProvider->pagination->getPageCount(),
            'itemCount' => $dataProvider->pagination->getItemCount(),
        );


        return $products;
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
            $criteria2->select = 'id,product_profile_id,imslagage_large,image_small,is_default';  // only select the 'title' column
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
