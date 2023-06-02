<?php

namespace app\controllers;

use app\models\Author;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class AuthorsController extends Controller
{
    // Отображение списка авторов
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query'      => Author::find(),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }
}
