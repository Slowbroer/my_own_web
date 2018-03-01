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
use frontend\assets\BlogAsset;
use frontend\assets\AlbumAsset;

$this->title = Yii::t("album",'Album Info');
//$this->params['breadcrumbs'][] = ['label'=>Yii::t('album','Album List'),'url'=>['list']];//TODO::这里是面包板的很好展示，注意这里的'url'=>['list']要是这样的格式才能在当前的controller
//$this->params['breadcrumbs'][] = ['label'=>$this->title];

AlbumAsset::register($this);

?>

<div style="">

<div class="album-info" >
    <h2><?= $model->title?></h2>
    <div class="albumImg" style="background-image: url('<?= 'images/albums/'.$model->img;?>')">
        <div class="album-glass"></div>
        <div class="album-img">
            <img class="img-rounded" src="<?= 'images/albums/'.$model->img;?>">
        </div>
    </div>
    <div class="albumImg-mobile">
        <img src="<?= 'images/albums/'.$model->img;?>" >
        <div>
            <p >
                <?= $model->score;?>
            </p>
        </div>
    </div>


    <div class="other-info">
        <p class="info-list">
            <span class="glyphicon glyphicon-user"></span>
            <a><?= $model->albumSinger->singer_name;?></a>
        </p>
        <p class="info-list" title="下载链接">
            <span class="glyphicon glyphicon-link"></span>
            <a target="_blank" href="<?= $model->link;?>">下载链接</a>
        </p>
        <p class="info-list">
            <span class="glyphicon glyphicon-eye-open" ></span>
            <span id="getCode">点击获取提取密码</span>
        </p>
    </div>

</div>

<span style="position: fixed;right: 20px;opacity: 0.5;">
<!--    <button type="button" class="btn btn-info" style="display: block" onclick="location.href='#edit-comment'">发表评价</button></br>-->
<!--    <button id="common-button" type="button" class="btn btn-info" style="display: block" onclick="location.href='#comment'">评价</button>-->
</span>


<div class="album-brief">
    <p >
        <?= $model->brief;?>
    </p>
</div>
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

    <?php if(0){?>
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
    <?php }?>

</div>






