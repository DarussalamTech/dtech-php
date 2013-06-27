<?php

/**
 * This is the model class for table "wish_list".
 *
 * The followings are the available columns in table 'wish_list':
 * @property string $id
 * @property integer $product_profile_id
 * @property integer $user_id
 * @property integer $city_id
 * @property string $added_date
 * @property string $session_id
 * @property string $create_time
 * @property string $create_user_id
 * @property string $update_time
 * @property string $update_user_id
 *
 * The followings are the available model relations:
 * @property User $user
 * @property Product $product
 * @property City $city
 */
class WishList extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return WishList the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'wish_list';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('product_profile_id', 'required'),
            array('product_profile_id, user_id, city_id', 'numerical', 'integerOnly' => true),
            array('session_id', 'length', 'max' => 255),
            array('create_user_id, update_user_id', 'length', 'max' => 11),
            array('create_time, create_user_id, update_time, update_user_id', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, product_profile_id, user_id, city_id, added_date, session_id, create_time, create_user_id, update_time, update_user_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'user' => array(self::BELONGS_TO, 'User', 'user_id'),
            'productProfile' => array(self::BELONGS_TO, 'ProductProfile', 'product_profile_id'),
            'city' => array(self::BELONGS_TO, 'City', 'city_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'product_profile_id' => 'Product',
            'user_id' => 'User',
            'city_id' => 'City',
            'added_date' => 'Added Date',
            'session_id' => 'Session',
            'create_time' => 'Create Time',
            'create_user_id' => 'Create User',
            'update_time' => 'Update Time',
            'update_user_id' => 'Update User',
           
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

        $criteria->compare('id', $this->id, true);
        $criteria->compare('product_profile_id', $this->product_profile_id);
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('city_id', $this->city_id);
        $criteria->compare('added_date', $this->added_date, true);
        $criteria->compare('session_id', $this->session_id, true);
        $criteria->compare('create_time', $this->create_time, true);
        $criteria->compare('create_user_id', $this->create_user_id, true);
        $criteria->compare('update_time', $this->update_time, true);
        $criteria->compare('update_user_id', $this->update_user_id, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Add products against user when user login
     */
    function addWishlistByUser() {
        $ip = getenv("REMOTE_ADDR");
        $wishlist_model = new WishList();
        $wishlist = $wishlist_model->findAll('session_id="' . $ip . '"');
        if ($wishlist) {
            foreach ($wishlist as $pro) {
                $wishlist_model2 = new WishList();
                $exitstProduct = $wishlist_model2->find("user_id=" . Yii::app()->user->id . " AND product_profile_id=" . $pro->product_profile_id);
                if ($exitstProduct) {
                    WishList::model()->findByPk($pro->id)->delete();
                } else {
                    $wishlist_model2 = $pro;
                    $wishlist_model2->user_id = Yii::app()->user->id;

                    $wishlist_model2->session_id = '';
                    $wishlist_model2->save();
                }
            }
        }
    }

    /**
     * get wishList for user 
     * 
     */
    function getWishLists() {
        $wishList = "";
        $ip = Yii::app()->request->getUserHostAddress();
        if (isset(Yii::app()->user->id)) {

            $wishList = $this->findAll('city_id=' . Yii::app()->session['city_id'] . ' AND (user_id=' . Yii::app()->user->user_id . ' OR session_id="' . $ip . '")');
        } else {
            $wishList = $this->findAll('city_id=' . Yii::app()->session['city_id'] . ' AND session_id="' . $ip . '"');
        }

        return $wishList;
    }

    /**
     * get Wish list count for user
     */
    function getWishListCount() {
        //count total added products in cart
        $ip = Yii::app()->request->getUserHostAddress();

        if (isset(Yii::app()->user->id)) {
            $tot = Yii::app()->db->createCommand()
                    ->select('count(*) as total_pro')
                    ->from('wish_list')
                    ->where('city_id=' . Yii::app()->session['city_id'] . ' AND user_id=' . Yii::app()->user->user_id)
                    ->queryRow();
        } else {
            $tot = Yii::app()->db->createCommand()
                    ->select('count(*) as total_pro')
                    ->from('wish_list')
                    ->where('city_id=' . Yii::app()->session['city_id'] . ' AND session_id="' . $ip . '"')
                    ->queryRow();
        }

        return $tot;
    }

}