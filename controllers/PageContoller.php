<?php
/*
 * Файл controllers/PageController
 */
namespace app\controllers;

use yii\web\Controller;
use app\models\FeedbackForm;

class PageController extends Controller {
    public function actionIndex() {
        return $this->render('index');
    }

    public function actionFeedback() {
        $model = new FeedbackForm();
        return $this->render('feedback', ['model' => $model]);
    }
}