<?

class BookController extends Controller
{
	//Yii::app()->db;
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		//$cat_faq=CategoryFaq::model()->findAll();
		//$articles=Article::model()->findAll();
		$id_tag = intval($_REQUEST['id_tag']);
		//var_export($link);
		//exit();
		if (!empty($id_tag)){
			$material_ids = Yii::app()->db->createCommand()
			->select('f.id_material')
			->from('db_materials_tags f')
			->where('f.id_tag ='.strval($id_tag))
			->queryColumn();
			$tags_name = Yii::app()->db->createCommand()
			->select('d.tag')
			->from('db_tags d')
			->where('d.id ='.strval($id_tag))
			->queryColumn();
		}
		$book = Yii::app()->db->createCommand()
			->select('d.*, s.lastName, s.middleName, s.firstName')
			->from('db_materials d')
			->where('d.type = "book"')
			->leftJoin('db_users s', ' s.id = d.id_author')
			->queryAll();
		$this->render("/book/index", compact('id_tag', 'tags_name', 'tag', 'book', 'link'
		));
		
	}

	protected function findModel($id)
    {
        if (($model = Materials::model()->find('id=:id', array ('id'=>$id ))) !== null) {
            return $model;
        }
       // throw new NotFoundHttpException(Yii::$app->params['notFoundErrMsg']);
    }
	
	

	public function actionView()
	{
	
		//echo "test22222";
	    //exit;
		
		$id = intval($_REQUEST['id']);
		//var_export($id);
		//exit;
		$material = Yii::app()->db->createCommand()
		->select('a.*, s.lastName, s.firstName, s.middleName')
        ->from('db_materials a')
		->where('a.id ='.strval($id))
        ->leftJoin('db_users s', ' s.id = a.id_author')
        ->queryAll();

		$tags=Yii::app()->db->createCommand()
		->select('f.id_material, f.id_tag, g.tag ')
		->from('db_materials_tags f')
		->where('f.id_material ='.strval($id))
		->leftJoin('db_tags g', 'g.id = f.id_tag')
		->queryAll();

		//var_export($article);
		//exit;
		if($material)
		{
		//	$this->render("/article/view", compact('article', 'tags'));
		//'category' => $cat_faq
		
			$this->render('view', array('material'=>$material[0], 'tags'=>$tags));	
			
			
 // если сохр успешно, то все ок, иначе выводим ошибку
		 }
				 
		else{
			throw new CHttpException(404, 'Видео не найдено');
		}
	}
}
