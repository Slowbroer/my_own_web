<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Singer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="singer-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'singer_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'brief')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->textInput() ?>

    <?= $form->field($model, 'sex')->dropDownList(['1'=>'male','2'=>'female']) ?>

    <?= $form->field($model, 'birthday')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
