<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}
	public function getToken($token)
	{
		//$model=Yii::app()->db->createCommand()
		//->select('token')
		//->from('db_users')
		//->where('mail=:mail', array(':mail'=>$getEmail))
		//->queryAll();
		$model=ForgotModel::model()->findByAttributes(array('token'=>$token));
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
        public static function RandomToken($length = 32)
		{
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
        public function actionVerToken($token, $getEmai)
        {
            $model=$this->getToken($token);
            if(isset($_POST['Change']))
            {
                if($model->token==$_POST['Change']['tokenhid']){
                    $model->password=md5($_POST['Chenge']['password']);
                    $model->token="null";
                    $model->save();
                    Yii::app()->user->setFlash('change','<b>Пароль успешно измнен, можете войти в личный кабинет с новым паролем</b>');
                    $this->redirect('?r=site/login');
                    $this->refresh();
                }
            }
            $this->render('verifikasi',array(
			'model'=>$model,
		));
        }
        
        public function actionForgot()
	{       
		    error_reporting(E_ALL & E_WARNING & E_NOTICE);
            $getEmail=$_POST['Forgot']['mail'];
			
			//$getModel=Yii::app()->db->createCommand()
			//->select('mail')
			//->from('db_users')
			//->where('mail=:mail', array(':mail'=>$getEmail))
			//->queryAll();
            $getModel = ForgotModel::model()->findByAttributes(array('mail'=>$getEmail));
			//var_export($getModel);
		    //exit();
            if(isset($_POST['Forgot']))
            {
				$getToken=rand(0, 99999);
                $getTime=date("H:i:s");
                //$getModel->token=md5($getToken.$getTime);
                //$getModel->token=RandomToken(32);
                $namaPengirim="Не один";
                $emailadmin="admin@neodin.ru";
                $subjek="Сброс пароля";
                $setpesan="Вы решили восстановить пароль<br/>
                    <a href='http://sitemyy/index.php?r=site/vertoken/view&token=".$getModel->token."'>Пройдите по ссылке для сброса пароля</a>";
                
				//var_export($getModel->token=RandomToken(32));
			    //exit();
				if($getModel){
                if($getModel->validate())
				{
				echo 'ok';
				$command = Yii::app()->db->createCommand();
                      //  echo $row['short_name'];
				$command->update('db_users_token', array(
						'token'=>$getModel->token=md5($getToken.$getTime),
					), "mail='$getEmail'");
				$name='=?UTF-8?B?'.base64_encode($namaPengirim).'?=';
				$subject='=?UTF-8?B?'.base64_encode($subjek).'?=';
				$headers="From: $name <{$emailadmin}>\r\n".
						 "Reply-To: {$emailadmin}\r\n".
						 "MIME-Version: 1.0\r\n".
						 "Content-type: text/html; charset=UTF-8";
				$getModel->save();
                Yii::app()->user->setFlash('forgot','Ссылка для восстановления пароля отправлена на электронный адрес');
				mail($getEmail,$subject,$setpesan,$headers);
				$this->refresh();
				}
				else{
					echo 'error';
				}
			}
			else{
				Yii::app()->user->setFlash('forgot','Пользователь не найден');
			}
                
            }
		$this->render('forgot');
	}
	public function actionChange()
	{
		$model=new ChangePasswordForm();
		if (isset($_POST['ChangePasswordForm'])) {
			$model->setAttributes($_POST['ChangePasswordForm']);
			if ($model->validate()) {
				$model->save();
				// you can redirect here
			}
		}
	
		$this->render('change', array('model'=>$model));
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}
	
		//public function actionQuestion()
	//{

		
	//	$faq=Faq::model()->findAll();
	//	echo '<pre>';
		//var_dump($faq);
		//echo '</pre>';
		//exit;
	//	$this->render('/question/faq',array('faq'=>$faq));
	//}


	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the form page
	 */
	public function actionContact()
	{
		$model=new Request;
		
		if(isset($_POST['Request']))
		{
			$model->attributes=$_POST['Request'];
			if($model->validate() && $model->save())
			{
				//$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				//$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				
				//$headers="From: $name <{$model->email}>\r\n".
				//	"Reply-To: {$model->email}\r\n".
				//	"MIME-Version: 1.0\r\n".
				//	"Content-Type: text/plain; charset=UTF-8";
				
				Yii::app()->user->setFlash('success','Наши сотрудники придерживаются правила конфиденциальности - все, что вы будете обсуждать со специалистом, останется строго между вами.');
				$this->refresh();
			}
		}
		
		$criteria = new CDbCriteria();
		$criteria->group = "name";
     	$cities = City::model()->findAll($criteria);
		
		$criteria_cr = new CDbCriteria();
		$categories = Category::model()->findAll($criteria_cr);
		$this->render('contact',array(
				'model'=>$model,
				'cities' => $cities,
				'categories' => $categories,
			)
		);
	}

	public function actionVolunteer()
	{

		//var_dump($_REQUEST);
		$categories = Yii::app()->db->createCommand()
				->select('d.*')
			->from('db_group_volunteer d')
				->queryAll();
	    $model=new Volunteer;
		
		if(isset($_POST['Volunteer']))
		{ 
			//var_export($_POST);
			//exit();
			//echo "OK";
			$model->attributes=$_POST['Volunteer'];
			
			if($model->validate()) 
			{
				
				//$us = Yii::app()->db->createCommand()
 				//->select('id_position')
 				//->from('db_spec_position')
 				//->where('namePosition="Волонтер"')
 				//->queryScalar();
				
				$modelUser=new Users;
				$modelUser->firstName = CHtml::encode($model->name);
				$modelUser->middleName = "-";
				$modelUser->lastName = "-";
				$modelUser->phone = $model->phone;
				$modelUser->mail = CHtml::encode($model->mail);
				$modelUser->id_position = 6;
				$modelUser->id_city = $model->id_city;
				$modelUser->password = $model->password;
				$modelUser->isActive = $model->isActive;
				
				$saltingPass = $modelUser->saltingPassField();
                //$saltingPassMD5 = md5($saltingPass);
				$modelUser->password = sha1($saltingPass);
				if ($modelUser->save(false) == false)
				{   $errors = $modelUser->getErrors();
					echo var_export($errors, true);
					Yii::app()->user->setFlash('error',  CHtml::errorSummary($modelUser));
					echo 'refresh1';
				//	$this->refresh();
				}
				$model->id = $modelUser->id;
				
				//$insert_id = Yii::app()->db->getLastInsertID();
				//echo var_export($insert_id, true);

				//echo "modelUser".var_export($modelUser->id, true);
			//	exit;

				if($model->save())
				{
					//$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
					//$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
					
					//$headers="From: $name <{$model->email}>\r\n".
					//	"Reply-To: {$model->email}\r\n".
					//	"MIME-Version: 1.0\r\n".
					//	"Content-Type: text/plain; charset=UTF-8";
					
					foreach ($categories as $row){
					
					if ( array_key_exists($row['short_name'],$_POST)) {
						$command = Yii::app()->db->createCommand();
                      //  echo $row['short_name'];
						$command->insert('db_users_group_volunteer', array(
								'volunteer_id'=>$modelUser->id,
								'group_id'=>$row['id'],
								'param_value'=>1,
								));
						
					}
					}
					Yii::app()->user->setFlash('success','Спасибо, что решили стать волонтером. Ваша помощь очень важна для нас');
					//echo 'refresh2';
					$this->refresh();
				}
				else
				{
					Yii::app()->user->setFlash('error',  CHtml::errorSummary($model));
					$this->refresh();
				}
			}
			else
			{
				//echo var_export($model, true);
				//exit();
				if ($model->hasErrors()){
						$errors = $model->getErrors();
						Yii::app()->user->setFlash('error',  CHtml::errorSummary(var_export($errors, true)));
				}
				
				
				//exit();
				
				//echo 'refresh3';
				//$this->refresh();
			}
		}
		
		$criteria = new CDbCriteria();
		$criteria->group = "name";
     	$cities = City::model()->findAll($criteria);
		
		//$criteria_cr = new CDbCriteria();
		//$categories = GroupVolunteer::model()->findAll($criteria_cr);
		$this->render('/site/volunteer',array(
				'model'=>$model,
				'cities' => $cities,
				'categories' => $categories,
			)
		);
    }
public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login()){
					$this->redirect('http://lk.alinasop.beget.tech/login?session=' . session_id());
			}
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}


	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}