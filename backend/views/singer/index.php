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

//            'id',
//            'singer_name',
            [
                'label'=>'Singer Name',
                'attribute'=>'singer_name',
                'options'=>[
                    'style'=>''
                ]
            ],
            'brief',
//            'content',
            [
                'label'=>'sex',
                'value'=>function($model){
//                    var_dump($model);
                    return $model->sex == 1? 'male':'female';
                },
//                'attribute'=>'sex',//这里添加attribute的时候就会出现排序和搜索的选项
            ],
            // 'birthday',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
