<?php
namespace frontend\models;

use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
//    public $capture;
    public $emailCode;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            ['emailCode','required'],
            ['password', 'string',],

        ];
    }

    public function attributeLabels()
    {
        return [
            'username'=>'用户名',
            'email'=>'电子邮件地址',
            'password'=>'密码',
            'emailCode'=>'邮箱验证码',
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|string the saved model or the reason if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return "注册填写信息出错";
        }
        $capture_code = CapCode::find()->where(['email'=>$this->email])->orderBy('id desc')->one();

        if($capture_code && ($capture_code->code==$this->emailCode) && ($capture_code->add_time+60*30 >= time()))
        {
            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->generateAuthKey();

            return $user->save() ? $user : "注册失败";
        }
        else
        {
            return "验证码错误或者已经失效";
        }
    }
}
