<?php

/**
 * This is the model class for table "db_request".
 *
 * The followings are the available columns in table 'db_request':
 * @property integer $id
 * @property string $name
 * @property integer $id_category
 * @property string $info
 * @property string $email
 * @property string $phone
 * @property integer $old
 * @property integer $id_city
 *
 * The followings are the available model relations:
 * @property City $idCity
 * @property Category $idCategory
 * @property UserRequest[] $UserRequests
 */
class Request extends CActiveRecord
{
	public $verifyCode;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'db_request';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, id_category, info, id_city, email, phone, old,verifyCode', 'required'),
			array('id_category, old, id_city', 'numerical', 'integerOnly'=>true),
			array('phone', 'match', 'pattern'=>'/^(8)(\d{3})(\d{3})(\d{2})(\d{2})/', 'message' => 'Номер телефона должен начинаться с "8", состоять из 11 цифр, введен без пробелов'),
			array('name', 'length', 'max'=>50),
			array('info', 'length', 'max'=>2000),
			array('email', 'length', 'max'=>20),
			array('phone', 'length', 'max'=>11),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, id_category, info, email, phone, old, id_city', 'safe', 'on'=>'search'),
			
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
			'idCity' => array(self::BELONGS_TO, 'City', 'id_city'),
			'idCategory' => array(self::BELONGS_TO, 'Category', 'id_category'),
			'UserRequests' => array(self::HAS_MANY, 'UserRequest', 'IDrequest'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'id',
			'name' => 'Как к вам обращаться',			
			'old' => 'Возраст',
			'email' => 'E-mail',
			'phone' => 'Телефон',
			'id_city' => 'Район или округ',
			'id_category' => 'Категория',
			'info' => 'Опишите проблему или задайте вопрос',
			'verifyCode' => 'Код'
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('id_category',$this->id_category);
		$criteria->compare('info',$this->info,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('old',$this->old);
		$criteria->compare('id_city',$this->id_city);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Request the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
