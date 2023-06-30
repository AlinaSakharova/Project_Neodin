<?php
class Forgot extends CFormModel
{
    public function tableName()
	{
		return 'db_users';
	}

    public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(	
            array('mail', 'filter', 'filter' => 'trim'),
            array('token', 'length', 'max'=>150),
            
			array('mail, password ', 'required'),
			array('mail', 'length', 'max'=>45),
			array('mail', 'unique'),
			array('mail', 'email'),
			array('password, mail', 'length', 'max'=>32),
		
			
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id,  token, password', 'safe', 'on'=>'search'),
		
		);
	
		
	}
    public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'mail' => 'Электронная почта',
			'password' => 'Пароль',
			'token' => 'Token',
		);
	}
   // public static function model($className=__CLASS__)
	//{
	//	return parent::model($className);
	//}
}