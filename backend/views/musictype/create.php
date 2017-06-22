<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\MusicType */

$this->title = 'Create Music Type';
$this->params['breadcrumbs'][] = ['label' => 'Music Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="music-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
