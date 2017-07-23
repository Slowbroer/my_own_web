<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AlbumSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Albums';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="album-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);?>

    <p>
        <?= Html::a('Create Album', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
//            'content:ntext',
//            'img',
            'type'=>[
                'label'=>'音乐类型',
                'attribute' => 'type',
                'value' => function($data) use($type_lists) {
                    $type_array = explode(",",$data->type);
                    $type = array();
                    foreach ($type_array as $a)
                    {
                        $type[]= $type_lists[$a];
                    }
                    $type = implode(",",$type);
                    return $type;
                }
            ],
            // 'link',
             'singer',
            // 'score',
             'publish_time:datetime',
//             'add_time:datetime',
//             'update_time:datetime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
