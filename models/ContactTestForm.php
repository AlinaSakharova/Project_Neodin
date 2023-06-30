<?
class ContactTestForm extends CFormModel {
	public $name;
	public $subject; 
	public $email;
	public $id_city;
	public $phone;
	public $info;
	public $old;
	public $verifyCode;
	
	
	public function rules(){
		
		return array(
		 array('name,subject,email,phone,id_city,old,info','required'),
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
		 'old' => 'Возраст',
		 'Id City' => 'Город',
		 'subject' => 'Категория',
		 'info' => 'Опишите проблему или задайте вопрос'
		);
	}
}