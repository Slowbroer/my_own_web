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
if(empty($_GET['id']))
{
    $this->params['breadcrumbs'][] = $this->title;
}
else
{
    $this->params['breadcrumbs'][] = array('label'=>$this->title,'url'=>'index.php?r=album/list');
    $this->params['breadcrumbs'][] = $type_lists[$_GET['id']];
}


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
        /*width: 180px;*/
        /*这里的width包含padding和border的原因是因为设置了box-sizing*/
        border: 1px solid whitesmoke;
        /*box-sizing: content-box;*/
    }
    @media screen and  (max-width: 360px) {
        .album {
            width: 180px;
        }
    }
    @media screen and (min-width: 360px){
        .album {
            width: 180px;
        }
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
                <img title="<?= $list['brief'];?>" src="images/albums/<?= $list['img'];?>">
                <div style="display: none" class="album-brief">
                    <p><a href="index.php?r=album/info&id=<?= $list['id'];?>"><?= $list['title'];?></a></p>
                    <p><a href="index.php?r=singer/info&id=<?= $list['singer_id'];?>"><?= $list['singer_name'];?></a></p>
                    <p>
                        <?php
                        foreach ($types as $key=>$type)
                        {
                            echo "<a href='index.php?r=album/list&id=$type' >".$type_lists[$type]."</a>";
                        }
                        ?>
                    </p>
                    <p ><?= $list['brief'];?></p>
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
//        console.log($("#album-content").width());

        console.log($(".album").outerHeight(true));
//        console.log(widthNum);

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
//            console.log($cur.outerHeight(true));
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


//                waterFall();
            }
        });

    });

    $(window).on("resize",function () {
        waterFall();
    })
</script>




