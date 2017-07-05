<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\CollectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Collects';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="collect-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Collect', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'type',
            'type_value',
            'add_time:datetime',
            'user_id',
            // 'user_name',
            // 'value',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
