<?php

namespace app\controllers;

use app\models\Book;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class BooksController extends Controller
{
    // Отображение списка книг
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query'      => Book::find()->with('author'),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }
}