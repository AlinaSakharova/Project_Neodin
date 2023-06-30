<?php

/**
 * This is the model class for table "db_volunteer".
 *
 * The followings are the available columns in table 'db_volunteer':
 * @property integer $id
 * 
 * @property integer $id_group
 * @property string $utility
 * @property integer $isActive
 * @property integer $id_city
 *
 * The followings are the available model relations:
 * @property GroupVolunteer $idGroup
 * @property City $idCity
 */
class Volunteer extends CActiveRecord
{
	public $verifyCode;
	public $name;
	public $phone;
	public $mail;
	public $password;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'db_volunteer';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_group, id_city, old, name, phone,mail, password, verifyCode', 'required'),
			array('id_group,  id_city', 'numerical', 'integerOnly'=>true),
			array('isActive', 'boolean'),
			array('utility', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_group, utility, isActive, old, id_city, name, phone, mail, password', 'safe', 'on'=>'search'),
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
			'id_city' => 'Выберете город, в котором вы сможете оказывать помощь',
			'verifyCode' => 'Код',
			'phone' => 'Телефон',
			'mail'=>'Электронная почта',
			'password' => 'Пароль',
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
		$criteria->compare('old',$this->old);
		$criteria->compare('id_group',$this->id_group);
		$criteria->compare('utility',$this->utility,true);
		$criteria->compare('isActive',$this->isActive);
		$criteria->compare('id_city',$this->id_city);

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
