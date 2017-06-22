<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\MusicType */

$this->title = 'Update Music Type: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Music Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="music-type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
