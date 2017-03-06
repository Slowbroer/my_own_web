<?php
/**
 * Created by PhpStorm.
 * User: Slowbro
 * Date: 17/3/5
 * Time: 下午3:43
 */

namespace app\models;


class Mail
{

    public $title;
    public $email_address;
    public $content;


    public function rules(){
        return [
            [['title','content','email_address'],'required'],
            [['email_address'],'email','message'=>'邮箱格式错误'],
        ];
    }



}