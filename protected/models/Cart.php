<?php

/**
 * This is the model class for table "cart".
 *
 * The followings are the available columns in table 'cart':
 * @property integer $cart_id
 * @property integer $product_profile_id
 * @property string $added_date
 *
 * The followings are the available model relations:
 * @property Product $product
 */
class Cart extends DTActiveRecord {

    /**
     * caluclated or drieved attribue
     * @var type 
     */
    public $price, $image, $image_link, $link;
    public $view_array = array(
        "Books" => array(
            "controller" => "product",
            "view" => "_books/_book_info"
        ),
        "Educational Toys" => array(
            "controller" => "educationToys",
        ),
        "Quran" => array(
            "controller" => "quran",
            "view" => "_quran/_quran_info"
        ),
        "Others" => array(
            "controller" => "others",
        ),
    );

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Cart the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'cart';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('product_profile_id, added_date', 'required'),
            array('create_time,create_user_id,update_time,update_user_id', 'required'),
            array('product_profile_id', 'numerical', 'integerOnly' => true),
            array('added_date', 'length', 'max' => 255),
            array('price,image', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('cart_id, product_profile_id, added_date', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'productProfile' => array(self::BELONGS_TO, 'ProductProfile', 'product_profile_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'cart_id' => Yii::t('model_labels', 'Cart', array(), NULL, Yii::app()->controller->currentLang),
            'product_profile_id' => Yii::t('model_labels', 'Product', array(), NULL, Yii::app()->controller->currentLang),
            'added_date' => Yii::t('model_labels', 'Added Date', array(), NULL, Yii::app()->controller->currentLang),
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

        $criteria->compare('cart_id', $this->cart_id);
        $criteria->compare('product_profile_id', $this->product_profile_id);
        $criteria->compare('added_date', $this->added_date, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Add products against user when user login
     */
    function addCartByUser() {
        $ip = getenv("REMOTE_ADDR");
        $cart_model = new Cart();
        $cart = $cart_model->findAll('session_id="' . $ip . '"');
        if ($cart) {
            foreach ($cart as $pro) {
                $cart_model2 = new Cart();
                $exitstProduct = $cart_model2->find("user_id=" . Yii::app()->user->id . " AND product_profile_id=" . $pro->product_profile_id);
                if ($exitstProduct) {
                    $exitstProduct->quantity = $exitstProduct->quantity + $pro->quantity;
                    $cart_model2 = $exitstProduct;
                    Cart::model()->findByPk($pro->cart_id)->delete();
                } else {
                    $cart_model2 = $pro;
                }

                $cart_model2->user_id = Yii::app()->user->id;

                $cart_model2->session_id = '';
                $cart_model2->save();
            }
        }
    }

    /**
     * get Cart for user 
     * 
     */
    function getCartLists() {
        $cart = "";
        $ip = Yii::app()->request->getUserHostAddress();


        $criteria = new CDbCriteria();

        if (isset(Yii::app()->user->id)) {
            $criteria->condition = 'city_id=' . Yii::app()->session['city_id'] . ' AND (user_id=' . Yii::app()->user->user_id . ' OR session_id="' . $ip . '")';
        } else {
            $criteria->condition = 'city_id=' . Yii::app()->session['city_id'] . ' AND session_id="' . $ip . '"';
        }


        $cart = new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 100,
            ),
        ));

        return $cart;
    }

    /**
     * get Cart count for user
     */
    function getCartListCount() {
        //count total added products in cart
        $ip = Yii::app()->request->getUserHostAddress();

        if (isset(Yii::app()->user->id)) {

            $tot = Yii::app()->db->createCommand()
                    ->select('sum(quantity) as cart_total')
                    ->from('cart')
                    ->where('city_id=' . Yii::app()->session['city_id'] . ' AND user_id=' . Yii::app()->user->user_id)
                    ->queryRow();
        } else {

            $tot = Yii::app()->db->createCommand()
                    ->select('sum(quantity) as cart_total')
                    ->from('cart')
                    ->where('city_id=' . Yii::app()->session['city_id'] . ' AND session_id="' . $ip . '"')
                    ->queryRow();
        }

        return $tot;
    }

    /**
     * 
     * @param type $product_profile_id
     * get total particular product 
     * in cart
     */
    public function getTotalCountProduct($product_profile_id) {
        $tot = Yii::app()->db->createCommand()
                ->select('sum(quantity) as quantity')
                ->from('cart')
                ->where('product_profile_id=' . $product_profile_id)
                ->queryRow();
        if (empty($tot['quantity'])) {
            $tot['quantity'] = 0;
        }
        return $tot['quantity'];
    }

    /**
     * price set to 
     * 
     */
    public function afterFind() {
        /**
         * price to be set
         * and image to be set of product profile 
         * 
         */
        $this->price = isset($this->productProfile->price) ? $this->productProfile->price * $this->quantity : 0;
        $images = $this->productProfile->getImage();
        if (!empty($images[0] ['image_cart'])) {
            $this->image = $images[0] ['image_cart'];
        } else {
            $this->image = $this->productProfile->product["no_image"];
        }
        $parent_cat = "Books";
        if (!empty($pro->productProfile->product->parent_category->category_name)) {
            $parent_cat = $pro->productProfile->product->parent_category->category_name;
        }
        $this->image_link = CHtml::link(CHtml::image($this->image, $this->productProfile->product->product_name, array('title' => $this->productProfile->product->product_name)), Yii::app()->controller->createUrl('/web/product/productDetail', array(
                            'country' => Yii::app()->session['country_short_name'],
                            'city' => Yii::app()->session['city_short_name'],
                            'city_id' => Yii::app()->session['city_id'],
                            "pcategory" => $this->productProfile->product->parent_category->category_slug,
                            "slug" => $this->productProfile->product->slag,
        )));

        $this->link = CHtml::link($this->productProfile->product->product_name, Yii::app()->controller->createUrl('/web/product/productDetail', array(
                            'country' => Yii::app()->session['country_short_name'],
                            'city' => Yii::app()->session['city_short_name'],
                            'city_id' => Yii::app()->session['city_id'],
                            "pcategory" => $this->productProfile->product->parent_category->category_slug,
                            "slug" => $this->productProfile->product->slag,
        )));

        parent::afterFind();
    }

}