<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use ijackua\lepture\Markdowneditor;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\Album */
/* @var $form yii\widgets\ActiveForm */
?>


<script>
    function setImagePreview(avalue) {
        var docObj=document.getElementById("albumImg");

        var imgObjPreview=document.getElementById("preview");
//        console.log(docObj.files);
        if(docObj.files && docObj.files[0])
        {
            //火狐下，直接设img属性
            imgObjPreview.style.display = 'block';
            imgObjPreview.style.width = '180px';
            imgObjPreview.style.height = '180px';
            //imgObjPreview.src = docObj.files[0].getAsDataURL();

            //火狐7以上版本不能用上面的getAsDataURL()方式获取，需要一下方式
            imgObjPreview.src = window.URL.createObjectURL(docObj.files[0]);
        }
        else
        {
            //IE下，使用滤镜
            docObj.select();
            var imgSrc = document.selection.createRange().text;
            var localImagId = document.getElementById("localImag");
            //必须设置初始大小
            localImagId.style.width = "150px";
            localImagId.style.height = "180px";
            //图片异常的捕捉，防止用户修改后缀来伪造图片
            try{
                localImagId.style.filter="progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale)";
                localImagId.filters.item("DXImageTransform.Microsoft.AlphaImageLoader").src = imgSrc;
            }
            catch(e)
            {
                alert("您上传的图片格式不正确，请重新选择!");
                return false;
            }
            imgObjPreview.style.display = 'none';
            document.selection.empty();
        }
        return true;
    }
</script>

<style>
    .date-picker {
        width: 250px;
        display: inline-block;
    }


</style>

<div class="album-form">

    <?php $form = ActiveForm::begin(['options'=>['enctype'=>"multipart/form-data"]]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true,'style'=>'width:250px;']) ?>

    <?php //echo $form->field($model, 'img')->fileInput(['onchange'=>'setImagePreview()']); ?>

    <input type="file" id="albumImg" name="albumImg" onchange="setImagePreview();">

    <div id="localImag"><img id="preview" src="../../frontend/web/images/albums/<?= $model->img?>"  style="display: block; width: 180px; height: 180px;"></div>

    <div class="date-picker">
    <?= $form->field($model, 'publish_time')->widget(DatePicker::className(),['options'=>[
        'class'=>'date-picker'
    ]]); ?>
    </div>


    <div>

    </div>

    <?= $form->field($model,'type')->checkboxList(ArrayHelper::map($types,'id','type_name'));?>

    <?php //echo $form->field($model, 'type',['options'=>['style'=>'display:inline-block;']])->dropDownList(ArrayHelper::map($types,'id','type_name'),['style'=>'width:250px;']) ?>

    <?php //echo $form->field($model, 'singer_id',['options'=>['style'=>'display:inline-block;']])->dropDownList($singers,['maxlength' => true,'style'=>'width:250px;','prompt'=>'请选择']); ?>

    <?php echo $form->field($model,'singer_id',['options'=>['style'=>'width:300px;']])->widget(Select2::className(),['data'=>$singers,'options'=>['placeholder'=>'请选择']])?>

    <?= $form->field($model, 'score',['options'=>['style'=>'']])->textInput(['style'=>'width:250px;d']) ?>

    <?= $form->field($model, 'link')->textInput(['maxlength' => true]); ?>

    <?= $form->field($model, 'brief')->textarea(); ?>



    <?= Markdowneditor::widget(['model'=>$model,'attribute'=>'content']);?>





    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

