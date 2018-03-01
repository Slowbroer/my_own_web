<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\GameSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="game-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'developer') ?>

    <?= $form->field($model, 'publisher') ?>

    <?= $form->field($model, 'picture') ?>

    <?php // echo $form->field($model, 'content') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'score') ?>

    <?php // echo $form->field($model, 'platform') ?>

    <?php // echo $form->field($model, 'onsale') ?>

    <?php // echo $form->field($model, 'sale_price') ?>

    <?php // echo $form->field($model, 'sale_start_time') ?>

    <?php // echo $form->field($model, 'sale_end_time') ?>

    <?php // echo $form->field($model, 'have_dlc') ?>

    <?php // echo $form->field($model, 'have_demo') ?>

    <?php // echo $form->field($model, 'release_time') ?>

    <?php // echo $form->field($model, 'language') ?>

    <?php // echo $form->field($model, 'region') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
