<?php

class UsersController extends Controller
{
    //Yii::app()->db;

	public function actions()
	{	
		return array(
		   'captcha'=>array(
		   'class'=>'CCaptchaAction',
		   'backColor'=>0xFFFFFF,
		   ),
		   'page'=>array(
			'class'=>'CViewAction',
		),
		);
	}


	public function actionRegistration()
	{

	    $model=new Users;
		
		if(isset($_POST['Users']))
		{
			$model->attributes=$_POST['Users'];
			//генерация соли
			
			
			if($model->validate() && $model->save())
			{
			
				//echo "все ок";
				//exit;
			    $saltingPass = $model->saltingPassField();
                //$saltingPassMD5 = md5($saltingPass);
				
				$model->password = sha1($saltingPass);
				//echo'ok';
				//var_export();
				//exit();
				$model->save();
				Yii::app()->user->setFlash('success','');
				$this->refresh();
			}
		}
		
		$criteria = new CDbCriteria();
		$criteria->group = "name";
     	$cities = City::model()->findAll($criteria);
		
		$criteria_cr = new CDbCriteria();
		$criteria_cr->group = "namePosition";
		$positions = SpecPosition::model()->findAll('accessLevel=1');
        
        
        $this->render('/registration/registration',array(
				'model'=>$model,
				'cities' => $cities,
				'positions' => $positions,
			
			)
		);
    }
}