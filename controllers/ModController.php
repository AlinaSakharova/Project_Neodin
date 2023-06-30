<?php
//namespace app\controllers;

//use yii\web\Controller;
//use app\models\FeedbackForm;

class ModController extends Controller
{
	public function actionIndex()
	{
		$articles = Yii::app()->db->createCommand()
		->select('a.id, a.title, s.lastName, s.firstName, s.middleName, a.status, a.dates_temp')
        ->from('db_article a')
        ->leftJoin('db_specialist s', ' s.id = a.id_author')
        ->queryAll();

		$this->render("/moderation/index", compact('articles'));	
	}

	public function actionMod()
	{
		$id = $_GET['id'];
		//$model = ModerModel::model()->find('id=:id', array ('id'=>$id ));
		//var_dump($model);
		//exit;
		if (($model = ModerModel::model()->find('id=:id', array ('id'=>$id ))) !== null) {
			$this->render("/moderation/mod", compact('model','id'));
        }

		else
		{
			//echo "id не найден"; //сделать view moderation/error и отправлять туда
			throw new CHttpException(404,'Id не найден.');
		}
		//$model = $this->findModel($id); //проверить что она не null
			
	}
}
?>