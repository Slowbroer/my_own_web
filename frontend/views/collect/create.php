<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Collect */

$this->title = 'Create Collect';
$this->params['breadcrumbs'][] = ['label' => 'Collects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="collect-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
