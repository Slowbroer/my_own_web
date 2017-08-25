<?php
/**
 * Created by PhpStorm.
 * User: Slowbro
 * Date: 17/7/29
 * Time: PM3:03
 */

namespace frontend\models;


use common\models\Album;
use yii\base\Model;
use yii\data\Pagination;

class IndexSearch extends Model
{

    public $keyword;

    public function rules()
    {
        return [
//            ['keyword','required'],
            ['keyword','string']
        ];
    }

    public function attributeLabels()
    {
        return [
            'keyword'=>'搜索词'
        ];
    }

    public function searchAlbum()
    {
        $where = ['like','title',$this->keyword];
        $query = Album::find()->where($where);
        $count = $query->count();
        $page = new Pagination(['totalCount'=>$count]);
        $albums = $query->select("album.*,singer.singer_name")->joinWith(['albumSinger'])->offset($page->offset)->limit($page->limit)->asArray()->all();
        return ['album_list'=>$albums,'page'=>$page];

    }

}