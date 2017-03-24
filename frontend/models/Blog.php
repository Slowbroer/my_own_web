<?php

namespace frontend\models;

use Yii;
use yii\data\Pagination;

/**
 * This is the model class for table "blog".
 *
 * @property string $id
 * @property string $title
 * @property integer $user_id
 * @property string $content
 * @property string $user_name
 * @property integer $cat_id
 * @property string $brief
 * @property string $key_word
 * @property integer $check_time
 */
class Blog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'blog';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['title', 'user_id', 'content', 'cat_id', 'brief', 'key_word'], 'required'],
            [['title', 'user_id', 'content'], 'required'],
            [['user_id', 'cat_id','check_time'], 'integer'],
            [['content', 'key_word'], 'string'],
            [['title', 'user_name', 'brief'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => '标题',
            'user_id' => 'User ID',
            'content' => '内容',
            'user_name' => 'User Name',
            'cat_id' => 'Cat ID',
            'brief' => '简介',
            'key_word' => '关键字',
            'check_time' => 'check_time',
        ];
    }

//    public function getBlogCat($user_id)
//    {
//        $this->find()
//    }

    public function info($id)
    {
        $blog = $this->find()->where(['id'=>$id])->one();

        $blog->check_time = time();
        $result = $blog->save();

//        var_dump($result);

        return $blog;
    }

    public function blogRecent($user_id)
    {
//        var_dump($user_id);
        return $this->find()->where(['user_id'=>$user_id])->orderBy("check_time desc")->asArray()->all();
    }

    public function del($user_id,$blog_id)
    {
        $blog = $this->find()->where(['user_id'=>$user_id,'id'=>$blog_id])->one();
        $blog->delete();
    }


    public function recent_time($blog_id)
    {
        $time = time();

    }

    public function blogList($user_id,$catalog_id = null)
    {
//        if(empty($user_id))
//        {
//            return "请先登录";
//        }
        $where = array();
        if($catalog_id !== null)
        {
            $where['cat_id'] = $catalog_id;
        }
        $where['user_id'] = $user_id;
        $query = $this->find()->where($where)->asArray();
        $count = $query->count();
        $page = new Pagination(['totalCount'=>$count,]);
        $list['lists'] = $query->offset($page->offset)
            ->limit($page->limit)
            ->all();
        $list['page'] = $page;
        return $list;
//        return $this->find()->where(['user_id'=>$user_id])->asArray()->all();
    }



}
