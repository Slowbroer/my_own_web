<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t("title",'Signup');
$this->params['breadcrumbs'][] = $this->title;
?>

<style>
    .field-signupform-capture {
        vertical-align:middle;
    }
    .col-lg-5 {
        width: 365px;
    }
</style>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to signup:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]); ?>

                <?= $form->field($model, 'email')->textInput(); ?>

                <?= $form->field($model, 'emailCode',['options'=>['style'=>'display: inline-block;width: 60%',]])->textInput([
                    'placeholder'=>"邮箱验证码",
                ])->label(false); ?>

                <button type="button" class="btn btn-default" id="sendEmail" style="display: inline-block;">获取邮箱验证码</button>

                <?= $form->field($model, 'password')->passwordInput(); ?>

                <?php if(0){?>

                <?= $form->field($model, 'capture')->widget(\yii\captcha\Captcha::className(),[
                    'options'=>[
                        'placeholder'=>"验证码",
                        'class'=>'form-control',
                        'style'=>'display:inline-block;width:50%;'
                    ],
                    'imageOptions'=>[
                        'style'=>'display:inline-block;width:49%;',

                    ],

                ])->label(false); ?>

                <?php }?>

                <div class="form-group">
                    <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']); ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>


<script>
    $(function () {
        $("#sendEmail").on("click",function () {
            var email = $("#signupform-email").val();
            $.ajax({
                url:"index.php?r=site/send-email-code",
                data:"email="+email,
                type:"post",
                success:function (data) {
                    alert(data);
                }
            })
        })
    });
</script>
