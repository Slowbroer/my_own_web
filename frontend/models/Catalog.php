<?php

namespace frontend\models;

use Yii;
use frontend\models\Blog;

/**
 * This is the model class for table "catalog".
 *
 * @property integer $id
 * @property string $cat_name
 * @property string $cat_brief
 * @property integer $user_id
 * @property integer $ad_time
 * @property integer $parent_id
 */
class Catalog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'catalog';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cat_name', 'user_id', 'ad_time'], 'required'],
            [['user_id', 'ad_time', 'parent_id'], 'integer'],
            [['cat_name', 'cat_brief'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cat_name' => '目录名',
            'cat_brief' => '目录简介',
            'user_id' => 'User ID',
            'ad_time' => 'Ad Time',
            'parent_id' => 'Parent ID',
        ];
    }

    public function getCat($user_id)
    {
        $cats = $this->find()->where(['user_id' => $user_id])->select('id,cat_name')->asArray()->all();//以数组的形式获取数据
//        foreach($cats as $key => $cat )
//        {
//            $cats[$key]['sec_cat'] = $this->find()->where(['user_id'=>$user_id,'parent_id'=>$cat['id']])->select('id,cat_name')->all();
//        }
        return $cats;
    }

    public function getSec($cat_id)
    {
        $cats = $this->find()->where(['parent_id' => $cat_id])->select('id,cat_name')->asArray()->all();
        return $cats;
    }

    public function catInfo($cat_id)
    {
        if(is_numeric($cat_id))
        {
            $cat_info = $this->find()->where(['id' => $cat_id])->one();
        }
        else
        {
            $cat_info = null;
        }
//        $cat_info = $this->find()->where(['id' => $cat_id])->one();
        return $cat_info;
    }

    public function blog_list($cat_id)
    {
        if(is_numeric($cat_id))
        {
            return Blog::find()->where(['cat_id' => $cat_id])->select('id,title')->asArray()->all();
//            return $this->hasMany(Blog::className(), ['cat_id' => 'id']);
        }
        else
        {
            return null;
        }
    }

    public function catalog_lists($user_id,$catalog_id = 0){
        if (empty($user_id))
        {
            return "请登录后在获取你的所有文件";
        }
        $where = array();

        $where['parent_id'] = $catalog_id;
        $where['user_id'] = $user_id;


        return $this->find()->where($where)->orderBy("cat_name desc")->asArray()->all();
    }


    public function parent_id($id,$user_id = 0)
    {
        if(empty($user_id))
        {
            $user_id = Yii::$app->user->id;
        }
        $parent_id = $this->find()->select("parent_id")->where(['id'=>$id,'user_id'=>$user_id])->asArray()->one();
        if(!isset($parent_id))
        {
            return 0;
        }
        return $parent_id['parent_id'];
    }

}
