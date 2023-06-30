<?php

class QuestionController extends Controller
{
	
	public function actionFaq()
	{
		$cat_faq=CategoryFaq::model()->findAll();
		$faq=Faq::model()->findAll();
	
		$this->render("/question/faq", array('faq' => $faq,
		'category' => $cat_faq
		));
		
	}
}