<?php

/* @var $this yii\web\View */

$this->title = 'Slowbro';
?>

<!--标题图片-->
<style>
    @import url('https://fonts.googleapis.com/css?family=Raleway:400,700,900');


    .search__container {
        /*padding-top: 48px;*/
        font-family: 'Raleway', sans-serif;
    }

    .search__title {
        font-size: 22px;
        font-weight: 900;
        text-align: center;
        color: #ff8b88;
    }

    .search__input {
        width: 50%;
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

    .album-list {
        margin: 50px;
    }
    .album-list h4 {
        text-align: left;
    }
    .albums {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-around;
    }
    .albums .album-content {
        padding: 10px;
        width: 200px;
    }
    .img-rounded {
        width: 180px;
    }
    .album-brief p {
        height: 20px;
        text-overflow: ellipsis;
        white-space: nowrap;
        overflow: hidden;

    }




</style>
<div style="margin: 10px 0;">
    <div class='headerImg'>
        <div class='frosted-glass'>
            <!--            <img src="@web/images/header.jpg">-->
        </div>
        <div class="search__container weather"><!--this weather is the -->
            <!--        <p class="search__title">-->
            <!--            来呀, 点击这里搜索-->
            <!--        </p>-->

            <?php $form = \yii\bootstrap\ActiveForm::begin(['action'=>\yii\helpers\Url::toRoute('album/index-search'),'method'=>"GET"]);?>

            <?= $form->field($search,'keyword')->textInput([
                'class'=>'search__input',
                'placeholder'=>'Search',
            ])->label(false);?>

            <?php $form = \yii\bootstrap\ActiveForm::end();?>





<!--            <form action="" method="post">-->
<!---->
<!--                <input name="_csrf-frontend" type="hidden" id="_csrf" value="">-->
<!---->
<!--                <input class="search__input" type="text" placeholder="Search">-->
<!---->
<!--            </form>-->
        </div>

        <div class="album-list">
            <h4>今日推荐</h4>
            <div class="albums">
                <?php foreach ($albums as $album){?>
                    <div class="album-content">
                        <a href="index.php?r=album/info&id=<?= $album->id;?>" target="_blank">
                            <img class="img-rounded" title="<?= $album->brief;?>" src="images/albums/<?= $album->img;?>">
                        </a>
                        <div style="" class="album-brief">
                            <p><a href="index.php?r=album/info&id=<?= $album->id;?>"><?= $album->title;?></a></p>
                            <p><a href="index.php?r=singer/info&id=<?= $album->singer_id;?>"><?= $album->albumSinger->singer_name;?></a></p>
                            <p><?= $album->brief;?></p>
                        </div>
                    </div>
                <?php }?>
            </div>
        </div>
        <!--        <img class='weather' src='cloudy.png'>-->
    </div>
</div>

