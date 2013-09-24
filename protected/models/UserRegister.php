<?php

/**
 * This is the model class for table "{{user}}".
 *
 * The followings are the available columns in table '{{user}}':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $created
 * @property string $last_activity
 * @property string $avatar
 */
class UserRegister extends DTActiveRecord
{

	public $password2;
	public $verifyCode;
	public $usernameLegal;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model( $className = __CLASS__ )
	{
		return parent::model( $className );
	}

	/**
	 * @return string the associated database table name
	 */
	 public function beforeValidate()
	{
            $this->usernameLegal = preg_replace( '/[^A-Za-z0-9@_#?!&-]/' , '', $this->user_name );
            return true;
	}
	public function tableName()
	{
		return 'user';
	}
	public function getFullName()
	{
		return $this->user_name;
	}
	
	public function getSuggest($q) 
	{
		$c = new CDbCriteria();
		$c->addSearchCondition('user_name', $q, true, 'OR');
		$c->addSearchCondition('email', $q, true, 'OR');
		return $this->findAll($c);
	}


	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_email,user_password', 'required','on'=>'validation'),
			array('user_password', 'length', 'max'=>128,'on'=>'validation'),
			 //array('email', 'compare', 'compareAttribute'=>'usernameLegal', 'message'=>'Username contains illegal characters','on'=>'validation'),
		//array('password', 'compare', 'compareAttribute'=>'password2'),              
			array('email','length','max'=>256,'on'=>'validation'),
         // make sure email is a valid email
         //array('email','email'),
         // make sure username and email are unique
		//array('username, email', 'unique'), 
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_name, user_password, user_email, join_date', 'safe', 'on'=>'search,validation'),
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
		
		);
	}
		
	
	/**
	 * Checks if the given password is correct.
	 * @param string the password to be validated
	 * @return boolean whether the password is valid
	 */
	public function validatePassword( $password , $bf_hash )
		{
	       return crypt( $password , $bf_hash ) === $bf_hash;
	}


	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'password' => 'Password',
			'email' => 'Email',
			'join_date' => 'Joining Date',
		);
	}
	protected function afterSave()
	{

	}
//	protected function beforeSave()
//	{
//		if ( parent::beforeSave() )
//		{
//			//$time = new Datetime();
//			if ( $this->isNewRecord )
//			{	
//				$this->join_date = time();
//				if ( isset ( $_POST['User']['user_password'] ) ){
//					$user_password = $_POST['User']['user_password'];
//				} else{
//					$user_password = rand(9,99);
//				}
//				$this->user_password = $user_password;
//				//$this->user_password = crypt( $user_password,  Randomness::blowfishSalt() );
//			}
//			return true;
//		}
//		else
//			return false;
//	}


	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('user_id',$this->_user_id);
		$criteria->compare('user_password',$this->user_password,true);
		$criteria->compare('user_email',$this->user_email,true);
		$criteria->compare('join_date',$this->join_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}