<?php
/**
 * Created by PhpStorm.
 * User: Slowbro
 * Date: 17/6/20
 * Time: AM10:24
 */

use yii\bootstrap\ActiveForm;

$this->title = Yii::t("album",'Album Info');
$this->params['breadcrumbs'][] = ['label'=>Yii::t('album','Album List'),'url'=>['list']];//TODO::这里是面包板的很好展示，注意这里的'url'=>['list']要是这样的格式才能在当前的controller
$this->params['breadcrumbs'][] = ['label'=>$this->title];



?>

<style>
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
        padding: 10px 5px;
        /*border-color: #00b3ee;*/
        border: 1px solid #ddd;
        border-radius: 5px;
    }
    .list-group {
        margin-bottom: 0;
    }

    #comment {
        margin-top: 20px;
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
</script>

<div class="album-info" >

    <table class="album-table" >
        <tr>
            <td  id="album-img" style="width: 30%;text-align: center">
                <img class="img-rounded" src="<?= 'images/albums/'.$model->img;?>">
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
    <button id="common-button" type="button" class="btn btn-info" style="display: block" onclick="location.href='#comment'">评价</button>
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
    <h4>精选评论</h4>
    <div style="border-top: 1px solid #ddd;padding-top: 20px;">

        <ul style="">
            <li>Cras justo odio疯狂价啊快就离开 发觉克己复礼卡即可 fkjahs</li>
        </ul>
        <hr/>
        <ul style="">
            <li>Cras justo odio疯狂价啊快就离开 发觉克己复礼卡即可 fkjahs</li>
        </ul>
        <hr/>
        <ul style="">
            <li>Cras justo odio疯狂价啊快就离开 发觉克己复礼卡即可 fkjahs</li>
            <span style="float: right" class="glyphicon glyphicon-thumbs-up"></span>
        </ul>
        <hr/>
    </div>
</div>

<div style="margin-top: 10px;">
    <button class="btn btn-success">查看所有评论</button>
</div>

<div>

</div>



