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

            <?php $form = \yii\bootstrap\ActiveForm::begin();?>

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
        <!--        <img class='weather' src='cloudy.png'>-->
    </div>


</div>


<link href="css/demo.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="css/slideshows.css" />
<script src="js/jquery.cycle.all.js"></script>
<script src="js/jquery.easing.1.3.js"></script>

<script>
    $(function () {
        $('#slideshow_1').cycle({

            fx: 'scrollHorz',

            easing: 'easeInOutCirc',

            speed:  700,

            timeout: 5000,

            pager: '.ss1_wrapper .slideshow_paging',

            prev: '.ss1_wrapper .slideshow_prev',

            next: '.ss1_wrapper .slideshow_next',

            before: function(currSlideElement, nextSlideElement) {

                var data = $('.data', $(nextSlideElement)).html();

                $('.ss1_wrapper .slideshow_box .data').fadeOut(300, function(){

                    $('.ss1_wrapper .slideshow_box .data').remove();

                    $('<div class="data">'+data+'</div>').hide().appendTo('.ss1_wrapper .slideshow_box').fadeIn(600);

                });

            }

        });



        // not using the 'pause' option. instead make the slideshow pause when the mouse is over the whole wrapper

        $('.ss1_wrapper').mouseenter(function(){

            $('#slideshow_1').cycle('pause');

        }).mouseleave(function(){

            $('#slideshow_1').cycle('resume');

        });
    });
</script>


<div id="wrapper">



    <section id="main">



        <div id="content">



<!--            <h1>Create beautiful slideshows with jQuery Cycle</h1>-->
<!---->
<!--            <h2>Slideshow #1</h2>-->



            <div class="ss1_wrapper">



                <a href="#" class="slideshow_prev"><span>Previous</span></a>

                <a href="#" class="slideshow_next"><span>Next</span></a>



                <div class="slideshow_paging"></div>



                <div class="slideshow_box">

                    <div class="data"></div>



                </div>



                <div id="slideshow_1" class="slideshow">



                    <div class="slideshow_item">

                        <div class="image"><a href="#"><img src="images/photos/2.jpg" alt="photo 2" width="900" height="400" /></a></div>

                        <div class="data">

                            <h4><a href="#">Donec sollicitudin enim sit</a></h4>

                            <p>Sed mollis tristique lectus vitae aliquet. Quisque vitae metus ut velit varius feugiat. Maecenas luctus pulvinar elit et viverra. Aenean vel est nulla. </p>

                        </div>



                    </div>



                    <div class="slideshow_item">

                        <div class="image"><a href="#"><img src="images/photos/3.jpg" alt="photo 3" width="900" height="400" /></a></div>

                        <div class="data">

                            <h4><a href="#">Pellentesque lacinia metus</a></h4>

                            <p>Integer pretium volutpat ligula sit amet pretium. Morbi nisi dui, rutrum ut bibendum sit amet, gravida eget dui. </p>

                        </div>

                    </div>





                    <div class="slideshow_item">

                        <div class="image"><a href="#"><img src="images/photos/1.jpg" alt="photo 1" width="900" height="400" /></a></div>

                        <div class="data">

                            <h4><a href="#">Lorem ipsum dolor sit amet</a></h4>

                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sollicitudin enim sit amet dolor posuere dictum. Pellentesque lacinia metus non erat auctor vehicula.</p>

                        </div>

                    </div>



                    <div class="slideshow_item">



                        <div class="image"><a href="#"><img src="images/photos/4.jpg" alt="photo 4" width="900" height="400" /></a></div>

                        <div class="data">

                            <h4><a href="#">Morbi nisi dui bibendum sit amet</a></h4>

                            <p>Aliquam feugiat lorem at massa pulvinar interdum. Ut nulla est, vulputate eget facilisis vel, cursus nec sapien. Quisque tincidunt adipiscing lorem, tincidunt sodales lorem imperdiet quis.</p>

                        </div>

                    </div>



                </div>

                </div>
            </div>
        </section>
    </div>





