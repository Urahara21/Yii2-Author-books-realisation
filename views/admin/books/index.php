<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>

    <h1>Управление книгами</h1>

    <p>
        <?= Html::a('Создать книгу', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns'      => [
        ['class' => 'yii\grid\SerialColumn'],

        [
            'class' => 'yii\grid\DataColumn',
            'label' => 'Название',
            'value' => function ($data) {
                return $data->title;
            },
        ],
        [
            'class' => 'yii\grid\DataColumn',
            'label' => 'Автор',
            'value' => function ($data) {
                return $data->author ? $data->author->name : null;
            },
        ],

        [
            'class'      => 'yii\grid\ActionColumn',
            'template'   => '{update} {delete}',
            'buttons'    => [
                'update' => function ($url, $model) {
                    return Html::a('Редактировать', $url, [
                        'title' => 'Редактировать',
                        'class' => 'btn btn-primary',
                    ]);
                },
                'delete' => function ($url, $model) {
                    return Html::a('Удалить', $url, [
                        'title' => 'Удалить',
                        'class' => 'btn btn-danger',
                        'data'  => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method'  => 'post',
                        ],
                    ]);
                },
            ],
            'urlCreator' => function ($action, $model, $key, $index) {
                if ($action === 'update') {
                    return '/admin/books/' . $model->id;
                }
                if ($action === 'delete') {
                    return '/admin/books/delete/' . $model->id;
                }
            },
        ],
    ],
]); ?>