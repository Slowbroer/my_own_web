<?php

/* @var $this yii\web\View */

$this->title = 'Slowbro';
?>

<!--标题图片-->
<div style="height:100px;margin: 10px 0;">
    <div class='headerImg'>
        <div class='frosted-glass'>
            <!--            <img src="@web/images/header.jpg">-->
        </div>
        <h2 class="weather">
            <?php
            if(Yii::$app->user->isGuest){
                echo "<a href='index.php?r=site/login'>Slowbro</a>";
            }
            else{
                echo Yii::$app->user->identity->username;
            }
            ?>

        </h2>
        <!--        <img class='weather' src='cloudy.png'>-->
    </div>
</div>