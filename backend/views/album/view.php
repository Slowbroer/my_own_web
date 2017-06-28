<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Markdown;

/* @var $this yii\web\View */
/* @var $model common\models\Album */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Albums', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="album-view">

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
            'title',
//            'content:ntext',
//            [
//                'label' => 'content',
//                'style' => 'width:100px;',
//                'value' => Markdown::process($model->content),//TODO::注意这里的格式，见http://www.yiichina.com/tutorial/616
//            ],
            'img',
            'type',
            'link',
            'singer',
            'score',
            'publish_time:datetime',
            'add_time:datetime',
            'update_time:datetime',
        ],
    ]) ?>


    <?= Markdown::process($model->content);?>

</div>
