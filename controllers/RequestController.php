<?

class RequestController extends Controller
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
	
	public function actionRequest()
	{
		$model = new ContactTestForm;
		if(Yii::app()->request->isPost)
		{
		    $model->load(Yii::$app->request->post());
				if($model->save())
			{	return $this->goBack();

			}
		}
		$this->render('request', compact ('model'));
	}
}
