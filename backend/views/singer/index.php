<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SingerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Singers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="singer-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Singer', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'singer_name',
            'brief',
            'content',
            'sex',
            // 'birthday',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
