<?php
/**
 * Created by PhpStorm.
 * User: Slowbro
 * Date: 17/3/19
 * Time: 下午5:34
 */
use yii\bootstrap\ActiveForm;


?>


<script>

    $(function () {
        $("#catalogForm").on('beforeSubmit',function () {
            $.ajax({
                url:$(this).attr('action'),
                data:$(this).serialize(),
                type:$(this).attr("method"),
                success:function (data) {
                    data = eval("("+data+")");
                    alert(data.message);
                    $("#catalogModal").modal("hide");
                    if(data.code == 0)
                    {
                        location.reload();
                    }
                }
            });

            return false;
        });
    });
    function catalog_add(catalog_id) {
        $.ajax({
            url:"index.php?r=catalog/main-info&id="+catalog_id,
            success:function (data) {
                if(data)
                {
                    if(data == 'error')
                    {
                        alert("没有找到这个目录，请刷新！");
                        return false;
                    }
                    data = eval("("+data+")");
                    $("#catalog-cat_name").val(data.cat_name);
                    $("#catalog-cat_brief").val(data.cat_brief);
//                    $("#catalog-parent_id").val(data.parent_id);
                    $("#catalog-id").val(data.id);
                }
                else
                {
                    $("#catalog-cat_name").val('');
                    $("#catalog-cat_brief").val('');
                    $("#catalog-id").val(0);
                }
                $("#catalogModal").modal("show");
            },
            error:function () {

            }
        });

    }


</script>

<div style="font-size: small;">
    <a href="<?= \yii\helpers\Url::toRoute(['catalog/list','id'=>$parent_id])?>">返回上一夜</a>
</div>

<div class="panel panel-default" style="margin: 20px auto;width: 95%">


    <?php foreach($catalogs as $catalog){ ?>
        <div class="panel-heading">
            <a href="<?php echo \yii\helpers\Url::toRoute('catalog/list').'&id='.$catalog['id'] ?>"><?= $catalog['cat_name'] ?></a>
            <a style="float: right;padding-left: 10px" href="#" onclick="del_catalog(<?php echo $catalog['id'] ?>)">删除</a>
            <a style="float: right;" href="#" onclick="catalog_add(<?= $catalog['id']?>);" >编辑</a>
        </div>
    <?php } ?>

    <?php foreach($blogs as $blog){ ?>
        <div class="panel-body">
            <a href="<?php echo \yii\helpers\Url::toRoute('blog/info').'&id='.$blog['id'] ?>"><?= $blog['title'] ?></a>
            <a style="float: right;padding-left: 10px" href="#" onclick="del_blog(<?php echo $blog['id'] ?>)">删除</a>
            <a style="float: right;" href="<?php echo \yii\helpers\Url::toRoute('blog/edit').'&id='.$blog['id'] ?>">编辑</a>
        </div>
    <?php } ?>
</div>

<div style="margin: 10px auto">
        <button type="button" class="btn btn-default" onclick="catalog_add(0);">新建目录</button>


    <a href="index.php?r=blog/add">
        <button type="button" class="btn btn-default">新建博客</button>
    </a>

</div>



<!-- Modal catalog -->
<div class="modal fade" id="catalogModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><?= Yii::t('common','catalog_edit_modal');?></h4>
            </div>
            <div class="modal-body">
                <?php $form = ActiveForm::begin([
                    'action'=>\yii\helpers\Url::toRoute('catalog/save'),
                    'id'=>'catalogForm',
                ]); ?>

                <?php echo $form->field($model,'cat_name')->textInput(['placeholder'=>'请填写目录名']);?>

                <?php echo $form->field($model,'cat_brief')->textInput(['placeholder'=>'请填写目录简介']);?>

                <?php echo $form->field($model,'parent_id')->hiddenInput(['value'=>$catalog_id])->label(false);?>

                <?php echo $form->field($model,'id')->hiddenInput()->label(false);?>

                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                <button type="submit" class="btn btn-primary">保存</button>

                <?php ActiveForm::end(); ?>
            </div>

            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>

<!-- Modal blog -->
<!--<div class="modal fade" id="blogModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">-->
<!--    <div class="modal-dialog" role="document">-->
<!--    <div class="modal-content">-->
<!--        <div class="modal-header">-->
<!--            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
<!--            <h4 class="modal-title" id="myModalLabel">--><?//= Yii::t('common','blog_edit_modal');?><!--</h4>-->
<!--        </div>-->
<!--        <div class="modal-body">-->
<!--            ...-->
<!--        </div>-->
<!--        <div class="modal-footer">-->
<!--            <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>-->
<!--            <button type="button" class="btn btn-primary">保存</button>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
<!--</div>-->

