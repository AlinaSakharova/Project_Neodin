<?php

/**
 * This is the model class for table "db_users".
 *
 * The followings are the available columns in table 'db_users':
 * @property integer $id
 * @property string $firstName
 * @property string $middleName
 * @property string $lastName
 * @property string $phone
 * @property string $mail
 * @property integer $id_city
 * @property integer $id_position
 * @property string $password
 *@property string $isActive
* @property string $token
 * The followings are the available model relations:
 * @property Article[] $Articles
 * @property Category[] $Categories
 * @property Comment[] $Comments
 * @property Faq[] $Faqs
 * @property Organization[] $Organizations
 * @property Topic[] $Topics
 * @property UserRequest[] $UserRequests
 * @property City $idCity
 * @property SpecPosition $idPosition
 */
class Users extends CActiveRecord
{
	public $verifyCode;
	public $salt;


	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'db_users';
	}

	public static function RandomToken($length = 32){
		if(!isset($length) || intval($length) <= 8 ){
		  $length = 32;
		}
		if (function_exists('random_bytes')) {
			return bin2hex(random_bytes($length));
		}
		if (function_exists('mcrypt_create_iv')) {
			return bin2hex(mcrypt_create_iv($length, MCRYPT_DEV_URANDOM));
		}
		if (function_exists('openssl_random_pseudo_bytes')) {
			return bin2hex(openssl_random_pseudo_bytes($length));
		}
	}
	
	function Salt(){
		return substr(strtr(base64_encode(hex2bin(RandomToken(32))), '+', '.'), 0, 44);
	}
	

	public function saltingPassField()
	{
		$this->salt = self::RandomToken(9); 
		// var_export($this->password.$this->salt);
		// exit();
		/*$this->password = $this->password.$this->salt;*/
		return $this->password.$this->salt;
        
	}
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('firstName,  mail, id_city, phone, id_position, password,verifyCode', 'required'),
			array('id_city, id_position', 'numerical', 'integerOnly'=>true),
			array('firstName,  mail', 'length', 'max'=>45),
			array('mail', 'unique'),
			array('mail', 'email'),
			array('password', 'length', 'max'=>64),
			array('phone', 'length', 'max'=>11),
			array('isActive', 'boolean'),
			//array('mail', 'trim'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, isActive, firstName,  phone, id_city, id_position, password', 'safe', 'on'=>'search'),
			array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements()) ,
		);
		/*
			return array(
			array('firstName, lastName, middleName, mail, id_city, id_position, phone, password ', 'required'),
			array('id_city, id_position', 'numerical', 'integerOnly'=>true),
			array('firstName, middleName, lastName, mail', 'length', 'max'=>45),
			array('phone', 'length', 'max'=>11),
			array('password', 'length', 'max'=>32),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, firstName, middleName, lastName, phone, mail, id_city, id_position, password', 'safe', 'on'=>'search'),
			array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements()) ,
		); */
		
	}
	
	
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'Articles' => array(self::HAS_MANY, 'Article', 'id_author'),
			'Categories' => array(self::HAS_MANY, 'Category', 'id_author'),
			'Comments' => array(self::HAS_MANY, 'Comment', 'id_author'),
			'Faqs' => array(self::HAS_MANY, 'Faq', 'id_author'),
			'Organizations' => array(self::HAS_MANY, 'Organization', 'id_author'),
			'Topics' => array(self::HAS_MANY, 'Topic', 'id_author'),
			'UserRequests' => array(self::HAS_MANY, 'UserRequest', 'IDuser'),
			'idCity' => array(self::BELONGS_TO, 'City', 'id_city'),
			'idPosition' => array(self::BELONGS_TO, 'SpecPosition', 'id_position'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'firstName' => 'Имя',
			'middleName' => 'Отчество',
			'lastName' => 'Фамилия',
			'phone' => 'Телефон',
			'mail' => 'Электронная почта',
			'id_city' => 'Район или округ',
			'id_position' => 'Ваша специализация',
			'password' => 'Пароль',
			//'isActive' => 'Активность',
			'verifyCode'=> 'Код',
		);
	}
	
	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('firstName',$this->firstName,true);
		$criteria->compare('middleName',$this->middleName,true);
		$criteria->compare('lastName',$this->lastName,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('mail',$this->mail,true);
		$criteria->compare('id_city',$this->id_city);
		$criteria->compare('id_position',$this->id_position);
		$criteria->compare('isActive',$this->isActive);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Users the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
