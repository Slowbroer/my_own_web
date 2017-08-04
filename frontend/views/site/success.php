<?php
/**
 * Created by PhpStorm.
 * User: Slowbro
 * Date: 17/8/1
 * Time: PM3:09
 */



use yii\bootstrap\Html;

$this->title = Yii::t("common",'success');
?>


<div class="site-error">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-success">
        <?= nl2br(Html::encode($message)) ?>
    </div>

</div>





