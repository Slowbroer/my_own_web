<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "comment_praise".
 *
 * @property integer $id
 * @property integer $comment_id
 * @property integer $user_id
 * @property integer $add_time
 */
class CommentPraise extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comment_praise';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['comment_id', 'user_id', 'add_time'], 'required'],
            [['comment_id', 'user_id', 'add_time'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'comment_id' => 'Comment ID',
            'user_id' => 'User ID',
            'add_time' => 'Add Time',
        ];
    }


    public function commentCount($comment_id)//返回该评论的点赞数
    {
        $where = array();
        if(!empty($comment_id))
        {
            $where['comment_id'] = $comment_id;
        }

        return $this->find()->where($where)->count();
    }

    //判断该用户是否已经点赞了
    public function is_praise($comment_id,$user_id)
    {
        $where=array(
            'comment_id'=>$comment_id,
            'user_id'=>$user_id
        );
        return ($this->find()->where($where)->count()>0)? 1:0;
    }



}
