<?php

use app\models\Author;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Author */
?>

<h1><?= $model->isNewRecord ? 'Создание книги' : 'Редактирование книги' ?></h1>

<?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput()->label('Название') ?>
    <?= $form->field($model, 'author_id')->dropDownList(
        ArrayHelper::map(Author::find()->all(), 'id', 'name'),
        ['prompt' => 'Выбрать автора']
    )->label('Автор') ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

<?php ActiveForm::end(); ?>