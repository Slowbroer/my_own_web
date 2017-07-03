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



    <?= $form->field($model, 'sex')->dropDownList(['1'=>'male','2'=>'female']) ?>

    <div class="form-group">
        <label class="control-label">Birthday</label>
        <?= \kartik\date\DatePicker::widget(['model'=>$model,'attribute'=>'birthday']) ?>
    </div>


    <div class="form-group">
        <label class="control-label">Content</label>
        <?= \ijackua\lepture\Markdowneditor::widget(['model'=>$model,'attribute'=>'content']); ?>
    </div>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
