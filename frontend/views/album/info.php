<?php
/**
 * Created by PhpStorm.
 * User: Slowbro
 * Date: 17/6/20
 * Time: AM10:24
 */


$this->title = Yii::t("album",'Album Info');
$this->params['breadcrumbs'][] = ['label'=>Yii::t('album','Album List'),'url'=>['list']];//TODO::这里是面包板的很好展示，注意这里的'url'=>['list']要是这样的格式才能在当前的controller
$this->params['breadcrumbs'][] = ['label'=>$this->title];



