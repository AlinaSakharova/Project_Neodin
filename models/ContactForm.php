<?
class ContactTestForm extends CFormModel {
	public $name;
	public $subject; 
	public $email;
	public $phone;
	public $id_city;
	public $old;
	public $info;
	public $verifyCode;
	
	
	public function rules(){
		
		return array(
		 array('name,email,phone,old, id_city, info','required'),
		 array('email', 'email'),
		 array('name', 'safe'),
		 array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements()) 
	);
}

    public function attributeLabels(){
		
		return array(
		 'name' => 'Имя',
		 'email' => 'Email',
		 'phone' => 'Телефон',
		 'Id City' => 'Город',
		 'old' => 'Возраст',
		 'subject' => 'Категория',
		 'info' => 'Опишите проблему или задайте вопрос'
		);
	}
}