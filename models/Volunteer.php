<?php

/**
 * This is the model class for table "db_volunteer".
 *
 * The followings are the available columns in table 'db_volunteer':
 * @property integer $id
 * @property integer $id_group
 * @property integer $name
 * @property integer $old
 * @property string $utility
 * @property integer $isActive
 * @property string $site
 * @property integer $id_city
 *
 * The followings are the available model relations:
 * @property GroupVolunteer $idGroup
 * @property City $idCity
 * @property Users $id0
 */
class Volunteer extends CActiveRecord
{
	public $verifyCode;
	public $name;
	public $phone;
	public $mail;
	public $password;
	public $salt;
	public $isActive;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'db_volunteer';
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
			array(' name, phone, mail, password,isActive,  old, id_city,verifyCode', 'required'),
			array('id,  old, isActive, id_city', 'numerical', 'integerOnly'=>true),
			array('utility', 'length', 'max'=>200),
			array('site, other', 'length', 'max'=>50),
		
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, phone, mail, , password, old, utility, isActive, site, id_city', 'safe', 'on'=>'search'),
			array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements())
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
			'idGroup' => array(self::BELONGS_TO, 'GroupVolunteer', 'id_group'),
			'idCity' => array(self::BELONGS_TO, 'City', 'id_city'),
			'id0' => array(self::BELONGS_TO, 'Users', 'id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name'=>'Как к вам обращаться',
			'old'=>'Возраст',
			'id_group' => 'Категории',
			'utility' => 'Чем вы можете помочь',
			'isActive' => 'Готовы ли вы приступить к работе прямо сейчас?',
			'id_city' => 'Выберите район или округ, в котором вы сможете оказывать помощь',
			'verifyCode' => 'Код',
			'phone' => 'Телефон',
			'site'=>'Ссылки на социальные сети (по желанию)',
			'mail'=>'Электронная почта',
			'password' => 'Пароль',
			'other' => 'Другое',
		

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
		$criteria->compare('name',$this->name);
		$criteria->compare('id_group',$this->id_group);
		$criteria->compare('old',$this->old);
		$criteria->compare('utility',$this->utility,true);
		$criteria->compare('isActive',$this->isActive);
		$criteria->compare('site',$this->site,true);
		$criteria->compare('id_city',$this->id_city);
		$criteria->compare('other',$this->other);
		
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Volunteer the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
