<?

class FormContoller extends ActiveRecord
{
	Yii::app()->db;
	public function actions()
	{	
		return array(
		   'captcha'=>array(
		   'class'=>'CCaptchaAction',
		   'backColor'=>0xFFFFFF,
		   ),
		);
	}
	
	
	
	public function actionContact()
	{
		$model = new ContactTestForm;
		if (isset($_POST['ContactForm']))
		//if(Yii::app()->request->isPostRequest)
		{
			$model->attributes = $_POST['ContactForm'];
	     //	if ($model->validate())
				if($model->save())
			{		
		        Yii::app()->request->setFlash('success', 'You have successfully added.');
                $this->redirect(array('index'));
		       // $send_email = "send@mail.ru" //куда отправляем
			   // print "Send succesfull"; 
			}
		}
		$this->render("contact", array('model' => $model));
	}
}
