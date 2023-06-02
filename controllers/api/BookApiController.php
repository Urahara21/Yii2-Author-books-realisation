<?php

namespace app\controllers\api;

use yii\data\ActiveDataProvider;
use yii\db\BaseActiveRecord;
use yii\rest\ActiveController;
use yii\filters\auth\HttpBearerAuth;

class BookApiController extends ActiveController
{
    public $modelClass = 'app\models\Book';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        // Отключил метод с проверкой на токен
        //        $behaviors['authenticator'] = [
        //            'class' => HttpBearerAuth::class,
        //        ];
        return $behaviors;
    }

    public function checkAccess($action, $model = null, $params = [])
    {

    }

    public function actions()
    {
        $actions = parent::actions();

        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];

        return $actions;
    }

    public function prepareDataProvider()
    {
        /* @var $modelClass BaseActiveRecord */
        $modelClass = $this->modelClass;

        return new ActiveDataProvider([
            'query' => $modelClass::find()->with('author'),
        ]);
    }
}