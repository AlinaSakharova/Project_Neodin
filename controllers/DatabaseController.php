<?

class DatabaseController extends Controller{
	
	public function actionDao(){
		
      $connection = Yii::app()->db;
	  
	  $connection->createCommand("
	  insert into tbl_user set 
	  username = 'alina', 
	  password = '123',
	  email = 'saharitto@gmail.com'
	  "
	  )->execute();
	}
}