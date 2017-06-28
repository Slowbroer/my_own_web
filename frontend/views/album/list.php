<?php
/**
 * Created by PhpStorm.
 * User: Slowbro
 * Date: 17/6/20
 * Time: AM10:24
 */
//use Yii;
use yii\widgets\LinkPager;


$this->title = Yii::t("album",'Album List');
$this->params['breadcrumbs'][] = $this->title;
?>

<style>
    #album-content {
        position: relative;
        text-align: center;

    }
    .album {
        position: absolute;
        margin-top: 20px;
        margin-bottom: 20px;
        padding: 7px;
        transition: all 1s;
        width: 180px;/*这里的width包含padding和border的原因是因为设置了box-sizing*/
        border: 1px solid whitesmoke;
        /*box-sizing: content-box;*/
    }
    .album img {
        width: 100%;
        /*height: 180px;*/
        /*width: 180px;*/
    }
    .next {
        width: 180px;
        /*height: 180px;*/
    }

    .album-brief p {
        font-family: serif;
        font-size: smaller;
    }
    .album-brief p a {
        margin-right: 7px;
        text-decoration: underline;
    }

</style>

<div style="text-align: center">
    <?php
    echo LinkPager::widget(
        [
            'pagination'=>$page,
        ]
    );
    ?>
</div>

<div id="album-content">
    <?php
    if(empty($lists))
    {
        echo "<div style='text-align: center'>there is nothing!</div>";
    }
    else{
        foreach ($lists as $key=>$list)
        {
            $types = explode(',',$list['type']);
            ?>
            <div class="album" id="first">
                <img src="images/albums/<?= $list['img'];?>">
                <div style="display: none" class="album-brief">
                    <p><?= $list['title'];?></p>
                    <p>
                        <?php
                        foreach ($types as $key=>$type)
                        {
                            echo "<a href='' >".$type_lists[$type]."</a>";
                        }
                        ?>
                    </p>
                    <p><?= $list['singer'];?></p>
                </div>
            </div>

<!--            <div class="album next" id="next">-->
<!--                <span class="glyphicon glyphicon-chevron-right"></span>-->
<!--            </div>-->

            <?php
        }
    }
    ?>



</div>


<script>
    function waterFall() {

        var widthNum=parseInt($("#album-content").width()/$(".album").outerWidth()),
            allHeight=[];

        for (var i=0;i<widthNum;i++){
            allHeight.push(0)
        }
        var marginBoth = ($("#album-content").width()%$(".album").outerWidth())/(widthNum*2);
        console.log($("#album-content").width());
        console.log($(".album").outerWidth());
        console.log(widthNum);

        $(".album").each(function () {
            var $cur=$(this),
                indx=0,
                minAllHeight=allHeight[0];
            for (var j=0;j<allHeight.length;j++){
                if (allHeight[j]<minAllHeight){
                    minAllHeight=allHeight[j];
                    indx=j;
                }
            }

            $cur.css({
                "margin-left":marginBoth,
                "margin-right":marginBoth
            });

            $cur.css({
                "left":indx*($cur.outerWidth()+2*marginBoth),
                "top":minAllHeight
            });
            allHeight[indx]=minAllHeight+$cur.outerHeight(true);
        })

    }

    $(function () {
        waterFall();
//        $("#next").mouseover(function () {
//            $(this).append("<span id='next2'>下一页</span>");
//        });
//        $("#next").mouseout(function () {
//            $("#next2").remove();
//        });
        $(".album img").mouseover(function () {
            if($(this).parent().find(".album-brief").css('display')=='none')
            {
                $(".album-brief").hide(1000);
                $(this).parent().find(".album-brief").show(1000);
            }
        });

    });

    $(window).on("resize",function () {
        waterFall();
    })
</script>




