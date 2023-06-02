<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>

    <h1>Авторы</h1>

    <?php if (Yii::$app->user->getId() == 100): ?>
    <p>
        <?= Html::a('Управление авторами', ['/admin/authors'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php endif; ?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns'      => [
        ['class' => 'yii\grid\SerialColumn'],

        [
            'class' => 'yii\grid\DataColumn',
            'label' => 'Имя',
            'value' => function ($data) {
                return $data->name;
            },
        ],
        [
            'class' => 'yii\grid\DataColumn',
            'label' => 'Количество книг',
            'value' => function ($data) {
                return $data->getBooks()->count();
            },
        ],
    ],
]); ?>