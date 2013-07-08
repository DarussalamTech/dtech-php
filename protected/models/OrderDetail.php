<?php

/**
 * This is the model class for table "order_detail".
 *
 * The followings are the available columns in table 'order_detail':
 * @property integer $user_order_id
 * @property integer $order_id
 * @property integer $product_id
 * @property string $product_price
 *
 * The followings are the available model relations:
 * @property Product $product
 * @property Order $order
 */
class OrderDetail extends DTActiveRecord {

    public $totalOrder,$total_price;

    /**
     * used for deleting
     * the data from refernece of cart_id
     * @var type  
     */
    public $cart_id;

    /**
     * 
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return OrderDetail the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'order_detail';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('product_profile_id, product_price', 'required'),
            array('create_time,create_user_id,update_time,update_user_id', 'required'),
            array('order_id, product_profile_id', 'numerical', 'integerOnly' => true),
            array('product_price', 'length', 'max' => 10),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('cart_id', 'safe'),
            array('user_order_id, order_id, product_profile_id, product_price', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'product_profile' => array(self::BELONGS_TO, 'ProductProfile', 'product_profile_id'),
            'order' => array(self::BELONGS_TO, 'Order', 'order_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'user_order_id' => 'User Order',
            'order_id' => 'Order',
            'product_profile_id' => 'Product',
            'product_price' => 'Product Price',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('user_order_id', $this->user_order_id);
        $criteria->compare('order_id', $this->order_id);
        $criteria->compare('product_profile_id', $this->product_profile_id);
        $criteria->compare('product_price', $this->product_price, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * 
     * @param type $limit
     * @return type
     */
    public function featuredBooks($limit = 30) {
        $is_featured = '1';

        $criteria = new CDbCriteria(array(
            'select' => '*',
            'condition' => "is_featured='" . $is_featured . "' AND t.city_id='" . Yii::app()->session['city_id'] . "'",
            //'limit' => $limit,
            'order' => 't.product_id ASC',
                //'with'=>'commentCount' 
        ));

        if (isset($_POST['ajax'])) {


            if (!empty($_POST['author'])) {
                $author = explode(",", $_POST['author']);
                $criteria->addInCondition("authors", $author);
            }
            if (!empty($_POST['langs'])) {
                $langs = explode(",", $_POST['langs']);
                $criteria->join.= ' INNER JOIN product_profile  ' .
                        ' ON product_profile.product_id = t.product_id';

                $criteria->addInCondition("product_profile.language_id", $langs);
            }
            if (!empty($_POST['cat_id'])) {
                $criteria->join.= ' LEFT JOIN product_categories  ON ' .
                        't.product_id=product_categories.product_id';
                $criteria->addCondition("product_categories.category_id='" . $_POST['cat_id'] . "'");
            }
            $criteria->distinct = "t.product_id";
            //$model = Product::model()->with('productProfile','productCategories');
        }

        $model = Product::model()->with(array('productProfile' => array('select' => '*')));

        $dataProvider = new CActiveDataProvider($model, array(
            'pagination' => array(
                'pageSize' => $limit,
            ),
            'criteria' => $criteria,
        ));

        return $dataProvider;
    }

    /**
     * get Featured Products
     */
    public function getFeaturedProducts($dataProvider) {

        $data = $dataProvider->getData();
        $featured_products = array();
        $product = array();
        $images = array();
        foreach ($data as $products) {

            $product_id = $products->product_id;
            $criteria2 = new CDbCriteria;
            $criteria2->select = '*';  // only select the 'title' column
            $criteria2->condition = "product_profile_id='" . $products->productProfile[0]->id . "'";
            $imagedata = ProductImage::model()->findAll($criteria2);
            $images = array();
            foreach ($imagedata as $img) {
                if ($img->is_default == 1) {
                    $images[] = array('id' => $img->id,
                        'image_large' => $img->image_url['image_large'],
                        'image_small' => $img->image_url['image_small'],
                    );
                    break;
                } else {
                    $images[] = array('id' => $img->id,
                        'image_large' => $img->image_url['image_large'],
                        'image_small' => $img->image_url['image_small'],
                    );
                    break;
                }
            }

            $featured_products[] = array(
                'product_id' => $products->product_id,
                'product_name' => $products->product_name,
                'product_description' => $products->product_description,
                'product_overview' => $products->product_overview,
                'product_author' => !empty($products->author) ? $products->author->author_name : "",
                'product_price' => $products->productProfile[0]->price,
                'no_image' => $products->no_image,
                'image' => $images
            );
        }

        return $featured_products;
    }

    /**
     * 
     * @param type $limit
     * @return CActiveDataProvider
     */
    public function bestSellings($limit = 16) {

        $city_id = Yii::app()->session['city_id'];

        $criteria = new CDbCriteria(array(
            'select' => "COUNT( product.product_id ) as totalOrder,product.*,product_profile.*",
            'group' => 'product.product_id',
            'distinct' => 'product.product_id',
            //'condition'=>"is_featured='".$is_featured."' AND city_id='".Yii::app()->session['city_id']."'",
            'condition' => "product.city_id = '" . $city_id . "'",
            //'limit' => $limit,
            'order' => 'totalOrder DESC',
        ));



        $model = OrderDetail::model()->with(
                array(
                    'product_profile',
                    'product_profile.product' =>
                    array('alias' => 'product',
                        'joinType' => "INNER JOIN "))
        );
        if (isset($_POST['ajax'])) {


            if (!empty($_POST['author'])) {
                $author = explode(",", $_POST['author']);
                $criteria->addInCondition("product.authors", $author);
            }
            if (!empty($_POST['langs'])) {
                $langs = explode(",", $_POST['langs']);

                $criteria->addInCondition("product_profile.language_id", $langs);

                //$model = OrderDetail::model()->with(array('product_profile', 'product_profile.product' => array('alias' => 'product', 'joinType' => "INNER JOIN ")));
            }
            if (!empty($_POST['cat_id'])) {


                $model = OrderDetail::model()->with(
                        array(
                            'product_profile',
                            'product_profile.product' => array('alias' => 'product',
                                'joinType' => "INNER JOIN "),
                            'product_profile.product.productCategories' =>
                            array(
                                'alias' => 'cat',
                                'select' => 'd.*',
                                'joinType' => "LEFT JOIN ",
                                'together' => true
                            )
                        )
                );

                $criteria->addCondition("cat.category_id='" . $_POST['cat_id'] . "'");
            }

            $criteria->distinct = "t.product_id";
        }
        $dataProvider = new CActiveDataProvider($model, array(
            'pagination' => array(
                'pageSize' => $limit,
            ),
            'criteria' => $criteria,
        ));

        return $dataProvider;
    }

    /**
     * GET BEST SELLING
     * @param type $dataProvider
     * @return type
     */
    public function getBestSelling($dataProvider) {
        $best_products = array();
        $best_join = $dataProvider->getData();
        $counter = count($best_join);
        for ($i = 0; $i < $counter; $i++) {
            $product_id = $best_join[$i]->product_profile->product_id;

            $product_name = $best_join[$i]->product_profile->product->product_name;
            $product_description = $best_join[$i]->product_profile->product->product_description;
            $product_price = $best_join[$i]->product_profile->price;
            $product_totalOrder = $best_join[$i]->totalOrder;

            $criteria6 = new CDbCriteria;
            $criteria6->select = '*';  // only select the 'title' column
            $criteria6->condition = 'product_profile_id="' . $best_join[$i]->product_profile->id . '"';
            $imagebest = ProductImage::model()->findAll($criteria6);
            $images = array();
            foreach ($imagebest as $img) {
                if ($img->is_default == 1) {
                    $images[] = array('id' => $img->id,
                        'image_large' => $img->image_url['image_large'],
                        'image_small' => $img->image_url['image_small'],
                    );
                    break;
                } else {
                    $images[] = array('id' => $img->id,
                        'image_large' => $img->image_url['image_large'],
                        'image_small' => $img->image_url['image_small'],
                    );
                    break;
                }
            }
            $best_products[$product_id] = array('product_id' => $product_id,
                'product_name' => $product_name,
                'product_description' => $product_description,
                'product_description' => $product_description,
                'product_price' => $product_price,
                'totalOrder' => $product_totalOrder,
                'no_image' => $best_join[$i]->product_profile->product->no_image,
                'image' => $images);
        }

        return $best_products;
    }

    /**
     *  performing operation on after save
     */
    public function afterSave() {
        if (!empty($this->cart_id)) {
            Cart::model()->findByPk($this->cart_id)->delete();
        }

        parent::afterSave();
    }
    /**
     * used for calculating of total price
     */
    public function afterFind() {
        $this->total_price = $this->product_price * $this->quantity;
        parent::afterFind();
    }

}