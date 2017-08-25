<?php
/**
 * Created by PhpStorm.
 * User: Slowbro
 * Date: 17/6/20
 * Time: AM10:24
 */

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\helpers\Url;

$this->title = Yii::t("album",'Album Info');
$this->params['breadcrumbs'][] = ['label'=>Yii::t('album','Album List'),'url'=>['list']];//TODO::这里是面包板的很好展示，注意这里的'url'=>['list']要是这样的格式才能在当前的controller
$this->params['breadcrumbs'][] = ['label'=>$this->title];



?>

<style xmlns="http://www.w3.org/1999/html">
    .album-info {
        margin: 50px 0 40px 0;
        /*border: 1px solid #ddd;*/
        /*border-radius: 5px;*/
    }

    .album-content h2
    {
        text-align: center;
        font-family: fantasy;
    }

    .album-content p {
        font-family: cursive;
    }
    .album-table {
        /*margin: 10px 20px;*/
        width: 100%;
        margin: 10px auto;
    }


    @media screen and (min-width: 356px) and (max-width: 715px) {
        #album-img img {
            width: 200px;
        }
        .album-brief {
            margin: 0 20px 0 10px;
        }
    }
    @media screen and (min-width: 715px) {
        #album-img img {
            width: 200px;
        }
        .album-brief {
            margin: 0 40px 0 10px;
        }
    }
    @media screen and (max-width: 356px) {
        #album-img img {
            width: 130px;
        }
        .album-brief {
            margin: 0 10px;
        }
    }

    .album-content {
        margin: 10px 0;
        padding: 10px 20px;
        /*border-color: #00b3ee;*/
        /*border: 1px solid #ddd;*/
        border-radius: 5px;
    }
    .list-group {
        margin-bottom: 0;
    }

    #comment {
        margin-top: 50px;
    }


</style>

<script>
    $(function () {
//        $("#download-link").click(function () {
//
//        });
        $("#linkForm").on("beforeSubmit",function () {
//            alert(111);
            $.ajax({
                url:"index.php?r=album/download-link",
                type:"post",
                data:$(this).serialize(),
                success:function (data) {
                    data = eval("("+data+")");
                    if(data.code==0)
                    {
                        alert("获取失败");
                    }
                    else if(data.code == 1)
                    {
                        $("#download-link").html(data.link);
                    }
                    else if(data.code == 2)
                    {
                        $("#download-link").html("专辑还没有下载链接哦");
                    }
                    $("#linkModel").modal("hide");
                },
                error:function (data) {
                    
                }
            });
            return false;
        });
    });
    function showLink() {
        $("#linkModel").modal("show");
    }
    function praiseComment(id,ele) {
        $.ajax({
            url:"<?= Url::toRoute("album/prise-comment")?>",
            data:"id="+id,
            type:"get",
            success:function (data) {
//                console.log(data);
//                alert(data);
                data=eval("("+data+")");
                if(data.code==1)
                {
                    alert("111");
                    $(ele).attr("onclick",'');
                    $(ele).attr("class",'glyphicon glyphicon-heart')
                }
            },
            error:function () {

            }
        });
    }
</script>


<div style="">

<div class="album-info" >

    <table class="album-table" >
        <tr>
            <td  id="album-img" style="width: 30%;text-align: center">
                <a href="<?= \yii\helpers\Url::toRoute(['album/info','id'=>$model->id]);?>">
                    <img class="img-rounded" src="<?= 'images/albums/'.$model->img;?>">
                </a>
            </td>
            <td >
                <div class="album-brief">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <span class="glyphicon glyphicon-user">
                                <a href="index.php?r=album/singer-info&id=<?= $model->singer_id?>"><?= $model->singer?></a>
                            </span>

                        </li>
                        <li class="list-group-item">
                            <span class="glyphicon glyphicon-eye-open" id="download-link">
                                <a href="#" onclick="showLink()" >下载链接</a>
                            </span>
                        </li>
                        <li class="list-group-item">
                            <span class="glyphicon glyphicon-pencil">
                                <a><?= $model->score;?></a>
                            </span>
                        </li>
                    </ul>
                </div>

            </td>
        </tr>
    </table>
</div>

<span style="position: fixed;right: 20px;opacity: 0.5;">
<!--    <button type="button" class="btn btn-info" style="display: block" onclick="location.href='#edit-comment'">发表评价</button></br>-->
<!--    <button id="common-button" type="button" class="btn btn-info" style="display: block" onclick="location.href='#comment'">评价</button>-->
</span>

<div class="album-content">
    <?= \yii\helpers\Markdown::process($model->content);?>
</div>


<div class="modal fade" id="linkModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
            </div>
            <?php $form = ActiveForm::begin(['id' => 'linkForm']); ?>
                <div class="modal-body">
                    <?= $form->field($linkModel,'verifyCode')->widget(\yii\captcha\Captcha::className(),[
                        'options'=>[
                            'placeholder'=>"请输入验证码",
                            'class'=>'form-control',
                            'style'=>'display:inline-block;width:49%;'
                        ],
                        'imageOptions'=>[
                            'style'=>'display:inline-block;width:49%;',
                            'alt'=>'验证码'

                        ],
                    ])->label(false);?>

                    <?= $form->field($linkModel,'album_id')->hiddenInput()->label(false);?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <button type="submit" class="btn btn-primary">获取链接</button>
                </div>
            <?php $form = ActiveForm::end(); ?>
        </div>
    </div>
</div>



    <div id="comment" >


        <a style="float: right" href="<?= Url::toRoute(['album/comment-list','id'=>$model->id])?>">查看所有评论……</a>
        <h4>精选评论</h4>

        <div style="border-top: 1px solid #ddd;padding-top: 20px;">
            <?php foreach ($hot_comments as $key=>$hot_comment){?>
            <ul style="">
                <li><?php echo Html::encode($hot_comment['content']);?></li>
                    <span style="float: right;" class="<?php if($hot_comment['is_praised']){ echo "glyphicon glyphicon-heart";}else{echo "glyphicon glyphicon-heart-empty";}?>" onclick="praiseComment(<?= $hot_comment['id']?>,this);">(<?php echo Html::encode($hot_comment['praise']);?>)</span>
            </ul>
            <hr/>
            <?php }?>
        </div>
    </div>

    <div style="margin-top: 20px;">
        <?php $comment_form = ActiveForm::begin(['action'=>Url::toRoute("album/comment")]); ?>

        <?= $comment_form->field($comment_model,'content')->textarea(['style'=>'height:150px;'])->label(false);?>

        <?= $comment_form->field($comment_model, 'type')->hiddenInput()->label(false);?>

        <?= $comment_form->field($comment_model, 'id')->hiddenInput()->label(false);?>

        <div style="text-align: right;">
            <?= Html::submitButton("评论",['class'=>'btn btn-default']);?>
        </div>


        <?php ActiveForm::end(); ?>


    </div>

</div>






