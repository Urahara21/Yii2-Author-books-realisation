<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Author */
?>

<h1><?= $model->isNewRecord ? 'Создание автора' : 'Редактирование автора' ?></h1>

<?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput()->label('Имя') ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

<?php ActiveForm::end(); ?>