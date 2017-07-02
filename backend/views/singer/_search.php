<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\SingerSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="singer-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'singer_name') ?>

    <?= $form->field($model, 'brief') ?>

    <?= $form->field($model, 'content') ?>

    <?= $form->field($model, 'sex') ?>

    <?php // echo $form->field($model, 'birthday') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
