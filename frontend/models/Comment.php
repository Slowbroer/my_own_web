<?php

namespace frontend\models;

use common\models\CommentPraise;
use common\models\User;
use Yii;

/**
 * This is the model class for table "comment".
 *
 * @property integer $id
 * @property string $content
 * @property integer $user_id
 * @property integer $add_time
 * @property integer $is_show
 * @property integer $id_value
 * @property integer $level
 * @property integer $type
 * type：1专辑，2博客
 * @property integer $praise
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content', 'user_id', 'id_value','type'], 'required'],
            [['content'], 'string'],
            [['user_id', 'add_time', 'is_show', 'id_value', 'level','type','praise'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'content' => '内容',
            'user_id' => 'User ID',
            'add_time' => 'Add Time',
            'is_show' => 'Is Show',
            'id_value' => 'Ann ID',
            'level' => 'Level',
            'praise' => '点赞数'

        ];
    }


    public function comment_list($blog_id)
    {
        $lists = $this->find()->where(['ann_id'=>$blog_id])->orderBy("add_time")->asArray()->all();

        foreach($lists as $key => $list)
        {
            $lists[$key]['add_time'] = date("Y-m-d H:m",$list['add_time']);
            $user = User::findOne(['id'=>$list['id']]);
            if(isset($user))
            {
                $lists[$key]['user_name'] = $user->username;
            }
            else
            {
                $lists[$key]['user_name'] = "匿名";
            }
        }
        return $lists;

    }


    public function hot_album_comment($album_id=0){
        $where = ['id_value'=>$album_id,'type'=>1];
        $comment_lists = $this->find()->where($where)->orderBy('praise desc')->limit(3)->asArray()->all();
        $praise = new CommentPraise();
        foreach ($comment_lists as $key => $comment)
        {
            $comment_lists[$key]['is_praised'] = $praise->is_praise($comment['id'],$comment['user_id']);
        }
        return $comment_lists;
    }

    public function add_praise()
    {
        $this->praise ++;
        return $this->save();
    }




}
