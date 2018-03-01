<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\GameSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Games';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="game-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Game', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'developer',
            'publisher',
            'picture',
            //'content:ntext',
            //'price',
            //'score',
            //'platform',
            //'onsale',
            //'sale_price',
            //'sale_start_time:datetime',
            //'sale_end_time:datetime',
            //'have_dlc',
            //'have_demo',
            //'release_time:datetime',
            //'language',
            //'region',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
