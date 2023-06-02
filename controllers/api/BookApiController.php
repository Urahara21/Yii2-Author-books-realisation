<?php

namespace app\controllers\api;

use app\models\Book;
use Yii;
use yii\db\StaleObjectException;
use yii\rest\ActiveController;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class BookApiController extends ActiveController
{
    public $modelClass = 'app\models\Book';

    /**
     * {@inheritdoc}
     */
    protected function verbs()
    {
        return [
            'index' => ['GET', 'HEAD'],
            'view' => ['GET', 'HEAD'],
            'create' => ['POST'],
            'update' => ['PUT', 'PATCH', 'POST'],
            'delete' => ['DELETE'],
        ];
    }

    public function actions(): array
    {
        $actions = parent::actions();
        unset($actions['delete'], $actions['create'], $actions['update'], $actions['view'], $actions['index']);
        return $actions;
    }

    public function actionList(): array
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        return Book::find()->joinWith('author')->all();
    }

    /**
     * @throws NotFoundHttpException
     */
    public function actionById($id): Book
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $book = Book::findOne($id);

        if ($book) {
            return $book;
        } else {
            throw new NotFoundHttpException("Book not found");
        }
    }

    /**
     * @throws NotFoundHttpException
     */
    public function actionUpdate(): array
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $id = Yii::$app->request->post('id');

        $book = Book::findOne($id);

        if ($book) {
            $book->attributes = Yii::$app->request->post();

            if ($book->save()) {
                return ['status' => true, 'data' => $book->attributes];
            } else {
                return ['status' => false, 'data' => $book->getErrors()];
            }
        } else {
            throw new NotFoundHttpException("Book not found");
        }
    }

    /**
     * @throws StaleObjectException
     * @throws \Throwable
     * @throws NotFoundHttpException
     */
    public function actionDelete($id): array
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $book = Book::findOne($id);

        if ($book) {
            $book->delete();

            return ['status' => true, 'message' => "Book deleted successfully"];
        } else {
            throw new NotFoundHttpException("Book not found");
        }
    }
}