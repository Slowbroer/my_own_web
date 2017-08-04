<?php
/**
 * Created by PhpStorm.
 * User: linpeiyu
 * Date: 2016-12-26
 * Time: 10:22
 */

namespace frontend\models;

use yii;
use yii\base\Model;

class CommentForm extends Model{

    public $content;
    public $id;
    public $level;
    public $type;



    public function rules(){
        return [
            [["content"],'required'],
            [['content'],'string'],
            [['id','level','type'],'integer']
        ];
    }

    public function attributeLabels(){
        return [
            'content'=> "内容",
            'id'=>'id',
            'type'=>'type',
            'level' => 'level'
        ];
    }

    public function add_comment($user_id)
    {
//        var_dump($this->attributes);
//        die();
        if(!$this->validate())
        {
            return false;
        }

        $comment = new Comment();
        $comment->content = $this->content;
        $comment->type = $this->type;
        $comment->id_value = $this->id;
        $comment->add_time = time();
        $comment->user_id = $user_id;
        return $comment->save()? true:false;
    }




}