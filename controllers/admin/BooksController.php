<?php

namespace app\controllers\admin;

use Yii;
use app\models\Book;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;

class BooksController extends Controller
{
    // Разрешаем доступ пользователю с id = 100
    // Простое решение, без использования rbac и прочего
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow'         => true,
                        'actions'       => ['index', 'view', 'create', 'update', 'delete'],
                        'roles'         => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return Yii::$app->user->getId() == 100;
                        },
                    ],
                ],
            ],
        ];
    }

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

    // Добавление и обновление книги
    public function actionUpdate($id = null)
    {
        $model = $id === null ? new Book() : Book::findOne($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    // Удаление книги
    public function actionDelete($id)
    {
        Book::findOne($id)->delete();

        return $this->redirect(['index']);
    }
}