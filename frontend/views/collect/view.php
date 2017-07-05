<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Collect */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Collects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="collect-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'type',
            'type_value',
            'add_time:datetime',
            'user_id',
            'user_name',
            'value',
        ],
    ]) ?>

</div>
