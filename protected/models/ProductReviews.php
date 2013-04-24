<?php

/**
 * This is the model class for table "product_reviews".
 *
 * The followings are the available columns in table 'product_reviews':
 * @property integer $reviews_id
 * @property integer $product_id
 * @property integer $user_id
 * @property string $reviews
 * @property string $added_date
 * @property string $is_approved
 * @property integer $is_email
 *
 * The followings are the available model relations:
 * @property Product $product
 * @property User $user
 */
class ProductReviews extends CActiveRecord
{
public  $avgRate;
/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ProductReviews the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'product_reviews';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('product_id, reviews', 'required'),
			array('product_id, user_id, is_email', 'numerical', 'integerOnly'=>true),
			//array('added_date', 'length', 'max'=>255),
			//array('is_approved', 'length', 'max'=>3),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('reviews_id, product_id, user_id, reviews, added_date, is_approved, is_email,rating', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'product' => array(self::BELONGS_TO, 'Product', 'product_id'),
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'reviews_id' => 'Reviews',
			'product_id' => 'Product',
			'user_id' => 'User',
			'reviews' => 'Reviews',
			'added_date' => 'Added Date',
			'is_approved' => 'Is Approved',
			'is_email' => 'Is Email',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('reviews_id',$this->reviews_id);
		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('reviews',$this->reviews,true);
		$criteria->compare('added_date',$this->added_date,true);
		$criteria->compare('is_approved',$this->is_approved,true);
		$criteria->compare('is_email',$this->is_email);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}