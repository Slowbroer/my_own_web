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
        margin-top: 10px;
        margin-bottom: 10px;
        transition: all 1s;
        width: 190px;
    }

</style>


<div id="album-content">
    <?php
    if(empty($lists))
    {
        echo "<div style='text-align: center'>there is nothing!</div>";
    }
    else{
        foreach ($lists as $key=>$list)
        {?>
            <div class="album">
                test
            </div>

            <div class="album">
                test
            </div>

            <div class="album">
                test
            </div>
            <div class="album">
                test
            </div>

            <div class="album">
                test
            </div>

            <div class="album">
                test
            </div>
            <div class="album">
                test
            </div>

            <div class="album">
                test
            </div>

            <div class="album">
                test
            </div>
            <?php
        }
    }
    ?>

</div>


<script>
    function waterFall() {

        var widthNum=parseInt($("#album-content").width()/$(".album").width()),
            allHeight=[];

        for (var i=0;i<widthNum;i++){
            allHeight.push(0)
        }
        var marginBoth = ($("#album-content").width()%$(".album").width())/(widthNum*2);
        console.log($("#album-content").width());
        console.log($(".album").outerWidth(true));
        console.log(widthNum);
        console.log(marginBoth);
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
                "left":indx*$cur.outerWidth(true),
                "top":minAllHeight,
                "margin-left":marginBoth,
                "margin-right":marginBoth
            });
            allHeight[indx]=minAllHeight+$cur.outerHeight(true);
        })

    }

    waterFall();

    $(window).on("resize",function () {
        waterFall()
    })
</script>



<div style="text-align: center">
    <?php
    echo LinkPager::widget(
        [
            'pagination'=>$page,
        ]
    );
    ?>
</div>
