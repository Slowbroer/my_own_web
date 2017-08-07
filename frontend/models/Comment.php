<?php

namespace frontend\models;

use common\models\CommentPraise;
use common\models\User;
use Yii;
use yii\data\Pagination;

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
            'praise' => '点赞数',
            'type' => '种类'

        ];
    }


    public function comment_list($id_value,$type)
    {

        $query = $this->find()->where(['id_value'=>$id_value,'type'=>$type]);
        $count = $query->count();
        $page = new Pagination(['totalCount'=>$count]);

        $lists = $query->offset($page->offset)->limit($page->limit)->orderBy("add_time")->asArray()->all();
        $praise = new CommentPraise();

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
            $lists[$key]['is_praised'] = $praise->is_praise($list['id'],$list['user_id']);
        }
        return ['lists'=>$lists,'page'=>$page];

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


    public function getUser()
    {
        return $this->hasOne(User::className(),['id'=>'user_id']);
    }



}
