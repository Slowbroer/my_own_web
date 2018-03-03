<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\Game */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="game-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'developer')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'publisher')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'score', ['options'=>['style'=>'width:500px;']])
        ->widget(Select2::className(),['data'=>$game_scores,'options'=>['placeholder'=>'请选择']])->label("Score : ".intval($model->score)) ?>
<!--    <h4>--><?php //echo $model->score; ?><!--</h4>-->

    <?= $form->field($model, 'picture')->fileInput(['maxlength' => true]) ?>

    <img src="<?php echo $model->picture ?>" style="width: 200px;object-fit: cover">

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>


    <?php //echo $form->field($model, 'platform')->textInput() ?>

    <?php //echo $form->field($model, 'onsale')->textInput() ?>

    <?php //echo $form->field($model, 'sale_price')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'sale_start_time')->textInput() ?>

    <?php //echo $form->field($model, 'sale_end_time')->textInput() ?>

    <?php //echo $form->field($model, 'have_dlc')->textInput() ?>

    <?php //echo $form->field($model, 'have_demo')->textInput() ?>

    <?php //echo $form->field($model, 'release_time')->textInput() ?>

    <?php //echo $form->field($model, 'language')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'region')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
