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

    public function getWsAllBooksByCategory($page = "", $category = "", $popular = "", $price_max = "", $price_min = "", $pages = "", $lowrangeprice = "", $highrangeprice = "", $asc = "", $desc = "") {//,$price="",$price_max="") {
        $cate = new Categories;
        // Getting the categories for drop downs
        $categories = $cate->getAllCategoriesForWebService();
        // Getting the language for drop downs

        $lang = Language::model()->findAll();

        // Getting the Authors for drop downs

        $authors = Author::model()->findAll();


//SELECT p.id ,count(t.quantity) as sold  FROM `order_detail` as t  inner join product_profile as p on t.product_profile_id=p.id group by p.id
        // making dynamic string according to the requirements
        $orderby = "";

        $condition = "";
        $condition = !empty($category) ? " AND productCategories.category_id =" . $category : " ";
        if ($popular != 0)
            $condition .= " AND `productProfile`.`product_id` in (SELECT p.id  as sold  FROM `order_detail` as t  inner join product_profile as p on t.product_profile_id=p.id group by p.id)";
        if ($pages != 0) {
            $rang_page = array(
                '100' => array("start" => 0, "end" => 100),
                '200' => array("start" => 101, "end" => 200),
                '500' => array("start" => 201, "end" => 500),
                '1000' => array("start" => 501, "end" => 1000),
                '2000' => array("start" => 1001, "end" => 2000),
            );
            
            $condition .=!empty($pages) ? " AND ("."productProfile.no_of_pages  >= " . $rang_page[$pages]['start']. " AND productProfile.no_of_pages  <= " . $rang_page[$pages]['end'].") ":" ";
            $orderby = " productProfile.no_of_pages DESC ";
        }
        if ($price_max != 0) {
            $orderby = "price DESC";
//            $condition .= "AND `productProfile`.price = (select max(price) from `product_profile` where city_id=1 AND parent_cateogry_id = 57) ";
        }
        if ($price_min != 0) {
            $orderby = "price ASC";
//            $condition .= "AND `productProfile`.price = (select min(price) from `product_profile` where city_id=1 AND parent_cateogry_id = 57) ";
        }
        if ($asc != 0) {
            $orderby = "t.product_name ASC";
//            $condition .= "AND `productProfile`.price = (select min(price) from `product_profile` where city_id=1 AND parent_cateogry_id = 57) ";
        }
        if ($desc != 0) {
            $orderby = "t.product_name DESC";
//            $condition .= "AND `productProfile`.price = (select min(price) from `product_profile` where city_id=1 AND parent_cateogry_id = 57) ";
        }
        //no more this condition
        if (!empty($lowrangeprice) && !empty($highrangeprice)) {
            //$condition .=" AND price >" . $lowrangeprice . " AND price < " . $highrangeprice;
        }


        $category_info = array();

        //Criteria building

        $criteria = new CDbCriteria(array(
            'select' => 't.is_featured,t.product_id,t.create_time,t.update_time,t.product_name,t.product_description,t.slag,t.parent_cateogry_id ',
            'with' => array(
                'productProfile' => array('select' => 'price', 'type' => 'INNER JOIN'),
                'author' => array('type' => 'INNER JOIN')
            ),
//            'with' => array('productProfile' => array('select' => 'price'), 'productCategories', 'author'),
            'condition' => " t.parent_cateogry_id=57  " . $condition,
            'order' => $orderby,
            'distinct' => true,
            'together' => true,
        ));

        if (!empty($category)) {
            $criteria->with['productCategories'] = array('type' => 'LEFT OUTER JOIN');
        }





        // Making data Provider for front end with pagination
        $dataProvider = new DTActiveDataProvider($this, array(
            'pagination' => array(
                'pageSize' => 6,
                'currentPage' => $page,
            ),
            'criteria' => $criteria,
        ));

//CVarDumper::dump($criteria,10,true);

        //Getting data from the data provider according to criteria
        $data = $dataProvider->getData();


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

//            CVarDumper::dump($products->create_time,10,true);
            $date = date('Y-d-m h:i:s a', time());


            $new = $date - $products->create_time;

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
            //echo $products->is_featured;
            // Array is filled with all the products
            $all_products[] = array(
                'product_id' => $products->product_id,
                'product_name' => $products->product_name,
                'is_featured' => $products->is_featured,
                'product_description' => $products->product_description,
                'product_author' => !empty($products->author) ? $products->author->author_name : "",
                'product_author_id' => !empty($products->author) ? $products->author->author_id : "",
                'currencySymbol' => '$',
                'product_price' => $products->productProfile[0]->price,
                'new' => $new,
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

//        CVarDumper::dump($products['products'],10,true);
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
    public function getWsAllBooksByCatalogue($page = "", $limit = 5, $category = "", $author = "", $search = "", $language = "") {

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



        $criteria = new CDbCriteria(array(
            'select' => 't.product_id,t.product_name,t.product_description,t.product_overview,t.slag,t.parent_cateogry_id',
            'with' => array('productProfile' => array('select' => 'price', 'type' => 'INNER JOIN'), 'productCategories' => array('type' => 'INNER JOIN'), 'author' => array('type' => 'INNER JOIN')),
            'condition' => "t.parent_cateogry_id=57" . $condtion,
            'order' => 't.product_id ASC',
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

        $product_url = array();



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

            $product_url[] = array(
                'url' => "http://www.darussalampk.com/en/pak/lahore/1/Books/" . $products->slag . "/detail"
            );


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
            'allCat' => $categories,
            'languages' => $lang,
            'authors' => $authors,
            'products' => $all_products,
            'pageSize' => $dataProvider->pagination->getPageSize(),
            'pageCount' => $dataProvider->pagination->getPageCount(),
            'itemCount' => $dataProvider->pagination->getItemCount(),
            'productUrlArray' => $product_url,
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
