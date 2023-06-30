<?

class ArticleController extends Controller
{
	//Yii::app()->db;
	public function actions()
	{	
		return array(
		   'captcha'=>array(
		   'class'=>'CCaptchaAction',
		   'backColor'=>0xFFFFFF,
		   ),
		   'index'=>array(
				'class'=>'CViewAction',
		   ),
		);
	}
	
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		//$cat_faq=CategoryFaq::model()->findAll();
		//$articles=Article::model()->findAll();
		$id_tag = intval($_REQUEST['id_tag']);
	//	var_export($id_tag);
	//	exit();
		if (!empty($id_tag)){
			$article_ids = Yii::app()->db->createCommand()
			->select('f.id_article')
			->from('db_article_tags f')
			->where('f.id_tag ='.strval($id_tag))
			->queryColumn();
			$tags_name = Yii::app()->db->createCommand()
			->select('d.tag')
			->from('db_tags d')
			->where('d.id ='.strval($id_tag))
			->queryColumn();
		}
		$all_tags = Yii::app()->db->createCommand()
			->selectDistinct('s.id_tag, d.tag')
			->from('db_article_tags s')
			->leftJoin('db_tags d',' s.id_tag = d.id')
			->queryAll();
		//var_export($tags_name);
		//exit();
		$categories_title= Yii::app()->db->createCommand()
			->select('a.id, a.category_name, d.id as d_id, d.dates_temp')
			->from('db_category a')
			->where('id_parent = 0')
			->leftJoin('db_users s', ' s.id = a.id_author')
			->leftJoin('db_article d', ' d.id = a.id')
			->queryAll();  
		//var_dump($categories_title);
		//exit();
       
        if (!empty($article_ids)){
			$categories= Yii::app()->db->createCommand()
			->select('a.id, a.id_parent, a.category_name, d.id as d_id, d.dates_temp, d.title, d.id_category_article')
       		->from('db_category a')
			->andWhere('id_parent != 0')
			->andWhere('d.id in ('.implode(',', $article_ids).')')
			->leftJoin('db_users s', ' s.id = a.id_author')
			->leftJoin('db_article d', ' d.id = a.id')
       		->queryAll();
			/*$categories_title= Yii::app()->db->createCommand()
			->select('a.id, a.category_name, d.id as d_id, d.dates_temp')
        	->from('db_category a')
			//->where('id_parent = 0')
			->andWhere('d.id in ('.implode(',', $article_ids).')')
        	->leftJoin('db_users s', ' s.id = a.id_author')
			->leftJoin('db_article d', ' d.id = a.id')
			->queryAll();
			*/
			//var_export($categories_title);
			//exit();
		}
		else{
			 $categories= Yii::app()->db->createCommand()
			->select('a.id, a.id_parent, a.category_name, d.id as d_id, d.dates_temp, d.title, d.id_category_article')
       		->from('db_category a')
			->andWhere('id_parent != 0')
			->leftJoin('db_users s', ' s.id = a.id_author')
			->leftJoin('db_article d', ' d.id = a.id')
       		->queryAll();
			
		}
		if (!empty($id_tag)){
			$article = Yii::app()->db->createCommand()
			->select('d.*, s.lastName, s.middleName, s.firstName')
			->from('db_article d')
			->andWhere('d.id in ('.implode($article_ids).')')
			->leftJoin('db_users s', ' s.id = d.id_author')
			->queryAll();
		}
		else{
			$article = Yii::app()->db->createCommand()
			->select('d.*, s.lastName, s.middleName, s.firstName')
			->from('db_article d')
			->leftJoin('db_users s', ' s.id = d.id_author')
			->queryAll();
		}
		//var_dump($article);
		//exit();
	   /* $articles = Yii::app()->db->createCommand()
		->select('a.title, s.lastName, s.firstName, s.middleName')
        ->from('db_article a')
        ->leftJoin('db_users s', ' s.id = a.id_author')
        ->queryAll();
	  */
		
		$this->render("/article/index", compact('articles', 'categories_title','categories', 'id_tag', 'tags_name', 'all_tags', 'article'
		//'category' => $cat_faq
		));

	//	$this->render('index');
	}

	protected function findModel($id)
    {
        if (($model = Article::model()->find('id=:id', array ('id'=>$id ))) !== null) {
            return $model;
        }
       // throw new NotFoundHttpException(Yii::$app->params['notFoundErrMsg']);
    }
	
	public function actionEdit()
	{
	
		echo "test22222";
	exit;

		$id = $_POST['id'];
		$model = $this->findModel($id); //проверить что она не null
		
		if($model && Yii::app()->request->isPost && $model->load(Yii::app()->request->post()))
		{
			
		    if ($model->save()) {
                $this->redirect(array('article/index'));
            } 
			//else {
                // Данные об ошибках
             //   foreach ($model->getErrors() as $key => $value) {
              //      echo $key . ': ' . $value[0];
              //  }
		
		}
		else {
			
			$categories = Yii::app()->db->createCommand()
			
            ->select('id, category_name')
			->from('db_category')
			->queryAll();
			
 // если сохр успешно, то все ок, иначе выводим ошибку
		         }
				 
		$this->render('edit', compact ('model','categories'));	
	}

	public function actionView()
	{
	
		//echo "test22222";
	    //exit;
		
		$id = intval($_REQUEST['id']);
		//var_export($id);
		//exit;
		$article = Yii::app()->db->createCommand()
		->select('a.*, s.lastName, s.firstName, s.middleName')
        ->from('db_article a')
		->where('a.id ='.strval($id))
        ->leftJoin('db_users s', ' s.id = a.id_author')
        ->queryAll();

		$tags=Yii::app()->db->createCommand()
		->select('f.id_article, f.id_tag, g.tag ')
		->from('db_article_tags f')
		->where('f.id_article ='.strval($id))
		->leftJoin('db_tags g', 'g.id = f.id_tag')
		->queryAll();

		//var_export($article);
		//exit;
		if($article)
		{
		//	$this->render("/article/view", compact('article', 'tags'));
		//'category' => $cat_faq
		
			$this->render('view', array('article'=>$article[0], 'tags'=>$tags));	
			
			
			
 // если сохр успешно, то все ок, иначе выводим ошибку
		 }
				 
		else{
			throw new CHttpException(404, 'Статья не найдена');
		}
	}
}
