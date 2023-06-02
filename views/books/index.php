<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>

    <h1>Книги</h1>

    <?php if (Yii::$app->user->getId() == 100): ?>
    <p>
        <?= Html::a('Управление книгами', ['/admin/books'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php endif; ?>

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
    ],
]); ?>