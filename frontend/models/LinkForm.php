<?php
/**
 * Created by PhpStorm.
 * User: Slowbro
 * Date: 17/7/4
 * Time: AM11:22
 */

namespace frontend\models;


use yii\base\Model;
use Yii;

class LinkForm extends Model
{
    public $verifyCode;
    public $album_id;

    public function actions()
    {
        return [
            'captcha' => [
                'class'=>'yii\captcha\CaptchaAction',
                'maxLength' => 5,
                'minLength' => 5,
            ]
        ];
    }

    /**
     * @
     */
    public function rules()
    {
        return [
            [['verifyCode','album_id'],'required'],
            ['verifyCode','captcha'],

        ];
    }

    public function attributeLabels()
    {
        return [
            'verifyCode'=>'验证码'
        ];
    }

}