<?php

/* @var $this yii\web\View */

$this->title = 'Slowbro';
?>

<!--标题图片-->
<style>
    @import url('https://fonts.googleapis.com/css?family=Raleway:400,700,900');


    .search__container {
        padding-top: 48px;
        font-family: 'Raleway', sans-serif;
    }

    .search__title {
        font-size: 22px;
        font-weight: 900;
        text-align: center;
        color: #ff8b88;
    }

    .search__input {
        width: 100%;
        padding: 12px 24px;
        background-color: transparent;
        transition: transform 250ms ease-in-out;
        font-size: 14px;
        line-height: 18px;
        color: #575756;
        background-color: transparent;
        background-image: url(http://mihaeltomic.com/codepen/input-search/ic_search_black_24px.svg);
        background-repeat: no-repeat;
        background-size: 18px 18px;
        background-position: 95% center;
        border-radius: 50px;
        border: 1px solid #575756;
        transition: all 250ms ease-in-out;
        backface-visibility: hidden;
        transform-style: preserve-3d;
    }

    .search__input::placeholder {
        color: rgba(87, 87, 86, 0.8);
        text-transform: uppercase;
        letter-spacing: 1.5px;
    }

    .search__input:hover,
    .search__input:focus {
        padding: 12px 0;
        outline: 0;
        border: 1px solid transparent;
        border-bottom: 1px solid #575756;
        border-radius: 0;
        background-position: 100% center;
    }

    @media screen and (max-width: 720px) and (min-width: 500px){
        .index-img {
            width: 20%;
        }
    }
    @media screen and (min-width: 720px){
        .index-img {
            width: 20%;
            margin: 0 20px;
        }
        .img-floor {
            text-align: center;
        }
    }
    @media screen and (max-width: 500px) {
        .index-img {
            width: 28%;
        }
        .img-floor {
            text-align: center;
        }
    }



</style>
<div style="margin: 10px 0;">
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
    <div class="search__container">
<!--        <p class="search__title">-->
<!--            来呀, 点击这里搜索-->
<!--        </p>-->
        <input class="search__input" type="text" placeholder="Search">
    </div>

</div>

<div class="index-content" style="margin: 0 auto">
    <div class="page-header">
        <h3>今日推荐</h3>
    </div>
    <div class="img-floor">
        <a><span ><<</span></a>
        <img class="index-img" src="<?= \yii\helpers\Url::to("@web/images/albums/born-to-die.jpg");?>">
        <img class="index-img" src="<?= \yii\helpers\Url::to("@web/images/albums/born-to-die.jpg");?>">
        <img class="index-img" src="<?= \yii\helpers\Url::to("@web/images/albums/born-to-die.jpg");?>">
        <a><span >>></span></a>
    </div>

    <div class="page-header">
        <h3>POP</h3>
    </div>
    <div class="img-floor">
        <a><span ><<</span></a>
        <img class="index-img" src="<?= \yii\helpers\Url::to("@web/images/albums/born-to-die.jpg");?>">
        <img class="index-img" src="<?= \yii\helpers\Url::to("@web/images/albums/born-to-die.jpg");?>">
        <img class="index-img" src="<?= \yii\helpers\Url::to("@web/images/albums/born-to-die.jpg");?>">
        <a><span >>></span></a>
    </div>

    <div class="page-header">
        <h3>Rock and Roll</h3>
    </div>
    <div class="img-floor">
        <a><span ><<</span></a>
        <img class="index-img" src="<?= \yii\helpers\Url::to("@web/images/albums/born-to-die.jpg");?>">
        <img class="index-img" src="<?= \yii\helpers\Url::to("@web/images/albums/born-to-die.jpg");?>">
        <img class="index-img" src="<?= \yii\helpers\Url::to("@web/images/albums/born-to-die.jpg");?>">
        <a><span >>></span></a>
    </div>

    <div class="page-header">
        <h3>华语专辑</h3>
    </div>
    <div class="img-floor">
        <a><span ><<</span></a>
        <img class="index-img" src="<?= \yii\helpers\Url::to("@web/images/albums/born-to-die.jpg");?>">
        <img class="index-img" src="<?= \yii\helpers\Url::to("@web/images/albums/born-to-die.jpg");?>">
        <img class="index-img" src="<?= \yii\helpers\Url::to("@web/images/albums/born-to-die.jpg");?>">
        <a><span >>></span></a>
    </div>
</div>




