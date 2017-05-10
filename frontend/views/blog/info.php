<?php
/**
 * Created by PhpStorm.
 * User: linpeiyu
 * Date: 2016-09-08
 * Time: 17:14
 */
use \yii\widgets\ActiveForm;
use \ijackua\lepture\Markdowneditor;
use \yii\helpers\Html;

?>

<style>
    .blog_link {
        width: 49%;
        display: inline-block;
        height: 20px;
        overflow: hidden;
    }

    img {
        max-width: 100%;
    }
    #common-button {
        filter:alpha(opacity=60);
        -moz-opacity:0.6;
        -khtml-opacity: 0.6;
        opacity: 0.6;
    }

</style>


<span style="position: fixed;right: 20px;">
<!--    <button type="button" class="btn btn-info" style="display: block" onclick="location.href='#edit-comment'">发表评价</button></br>-->
    <button id="common-button" type="button" class="btn btn-info" style="display: block" onclick="location.href='#comment'">评价区</button>
</span>

<div>
    <p style="text-align: left" class="blog_link left">
        <a href="<?= \yii\helpers\Url::toRoute(['blog/info','id'=>$last['id']]);?>">上一篇：<?php echo Html::encode($last['title'])?></a>
    </p>
    <p style="text-align: right" class="blog_link right">
        <a  href="<?= \yii\helpers\Url::toRoute(['blog/info','id'=>$next['id']]);?>">下一篇：<?php echo Html::encode($next['title'])?></a>
    </p>
</div>

<div class="archives-form">
    <input type="hidden" value="<?php echo $model->id;?>" id="blog">
<?php //echo $form->field($model,'title');?>
    <h2 style="text-align: center;padding-bottom: 20px;">
        <?php echo Html::encode($model['title'])?>
    </h2>
    <div style="text-align: center">
        <a href="javascript:return false;" onclick="collectBlog(<?php echo Html::encode($model['id'])?>);">
            <span class="glyphicon glyphicon-heart"></span>
            <span class="collect_span">
                <?php
                if($is_collect)
                {
                    echo " 已收藏";
                }
                else
                {
                    echo " 点击收藏";
                }
                ?>
            </span>
        </a>
    </div>

<?= \yii\helpers\Markdown::process($model['content']) ?>
<!--        这里的$model必须是一个model类的实例，attribute指的是这个model类的一个字段，这个字段用来保存数据-->
<?php //echo Markdowneditor::widget(['model' => $model, 'attribute' => 'content']) ?>
<?php //$form->field($model,'title');?>

<!--<div class="form-group">-->
    <?php //echo Html::submitButton('提交', ['class' => 'btn btn-success']) ?>

<!--</div>-->

</div>



<div style="padding-top: 30px;" id="comment" >
    <h2>评论区</h2>
    <div style='text-align: center;color: #808080;font-size: 2em;' class="comment_content">加载中- - - </div>
</div>

<script>
    $(function(){
        var id = $("#blog").val();
        load_comment(id);
        $("#comment-form").submit(function (id) {
            commit_comment($(this),id);
            return false;
        })
    });
    function load_comment(id)
    {
        $.ajax({
            url:"index.php?r=blog/load_comment&id="+id,
            type:"get",
            success:function(data){
                data = eval("("+data+")");
                if(data.code == 1)
                {
                    $(".comment_content").html(data.content);
                }
                else
                {
                    $(".comment_content").html(data.content);
                }
            }

        });
    }
    function commit_comment(form,id) {

//        console.log(form.serialize());

        $.ajax({
            url:form.attr("action"),
            type:form.attr("method"),
            data:form.serialize(),
            success:function (data) {
//                console.log(data);
                data = eval("("+data+")");
                alert(data.message);
                if(data.code == 1)
                {
                    load_comment(id);
                }
            }
        })
    }
    function collectBlog(id) {
        $("#loadingModal").modal("show");
        $.ajax({
            url:"index.php?r=blog/do-collect&id="+id,
            success:function (data) {
                $("#loadingModal").modal("hide");
                if(data == 2)
                {
                    location.href = 'index.php?r=site/login';
                }
                else if(data=="collect")
                {
                    $(".collect_span").text("已收藏");
                }
                else if(data=="cancel")
                {
                    $(".collect_span").text("点击收藏");
                }
                else if(data=="fail")
                {
                    alert("操作失败，请重新刷新页面！")
                }
                else
                {
                    alert("error");
                }

            },
            error:function () {

            }
        });
    }

</script>



<div style="padding-top: 50px;" id="edit-comment">
    <h2>发布评论：</h2>
    <?php $form = ActiveForm::begin([
        'action'=>\yii\helpers\Url::toRoute('blog/comment'),
        'id'=>'comment-form',
    ]); ?>

    <?php echo $form->field($comment_form,'content')->textarea(['style'=>'height:200px;'])->label(false); ?>

    <?php echo $form->field($comment_form,'blog_id')->hiddenInput()->label(false); ?>

    <?php echo $form->field($comment_form,'level')->hiddenInput()->label(false); ?>

    <input type="hidden" name="id" value="<?= $model['id'];?>">

    <?php echo Html::submitButton('提交评论', ['class' => 'btn btn-success']) ?>

    <?php ActiveForm::end(); ?>
</div>