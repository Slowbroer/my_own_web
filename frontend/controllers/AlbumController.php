<?php
/**
 * Created by PhpStorm.
 * User: Slowbro
 * Date: 17/6/19
 * Time: PM3:49
 */

namespace frontend\controllers;


use common\models\Album;
use common\models\MusicType;
use frontend\models\AlbumSearch;
use frontend\models\LinkForm;
use yii\data\Pagination;
use yii\web\Controller;
use Yii;


class AlbumController extends Controller
{

    public function actionInfo()
    {
        $id = Yii::$app->request->get("id");
//        var_dump($id);
        if(!empty($id))
        {
            $album = Album::findOne(['id'=>$id]);
            $form = new AlbumSearch();
            $linkModel = new LinkForm();
            $linkModel->album_id = $id;
            echo $this->render('info',['model'=>$album,'form'=>$form,'linkModel'=>$linkModel]);

        }
        else
        {
            echo $this->render("/site/error",['message'=>'没有找到相应的专辑']);
        }
    }


    public function actionSearch()
    {
        $albumSearch = new AlbumSearch();
        if($albumSearch->load(Yii::$app->request->post())&&$albumSearch->validate())
        {

        }

    }

    public function actionList()
    {
        $type_id = Yii::$app->request->get("id");
        $where = array();

        if(!empty($type_id))
        {
            $where = ['like','album.type',$type_id];//添加表名
        }

        $query = Album::find()->where($where);
        $count = $query->count();
        $page = new Pagination(['totalCount'=>$count]);

        $MusicType = new MusicType();
        $type_array = $MusicType->type_array();


//        $lists = $query->select("album.*,singer.singer_name")->joinWith(['singer'])->offset($page->offset)->limit($page->limit)->asArray()->all();
        //这里的joinwith如果写成singer，并且改变ablum类的对应方法的话，就会出现获取歌手的album表的singer字段问题
//        var_dump($lists[0]);
//        die();
//        array(14) { ["id"]=> string(1) "2" ["title"]=> string(11) "Born to Die" ["brief"]=> string(78) "Lana Del Rey的第一张录音室专辑，整体风格较为黑暗冷寂……" ["content"]=> string(408) "##Born to Die 《Born to Die》是由美国女歌手拉娜·德雷演唱的一首流行歌曲，歌词、曲谱由Elizabeth Grant和贾斯汀·帕克共同编写，音乐制作由Emile Haynie负责。该歌曲被收录在拉娜·德雷的第二张录音室专辑《Born to Die》中，并作为推广专辑的第二支单曲，于2011年12月30日通过新视野唱片公司和宝丽多唱片公司发行。" ["img"]=> string(15) "born-to-die.jpg" ["type"]=> string(3) "1,2" ["link"]=> string(0) "" ["singer"]=> array(6) { ["id"]=> string(1) "1" ["singer_name"]=> string(12) "Lana Del Rey" ["brief"]=> NULL ["content"]=> NULL ["sex"]=> string(1) "1" ["birthday"]=> NULL } ["singer_id"]=> string(1) "1" ["score"]=> string(2) "88" ["publish_time"]=> string(10) "1307404800" ["add_time"]=> string(10) "1496816831" ["update_time"]=> string(10) "1498639751" ["singer_name"]=> string(12) "Lana Del Rey" }

        $lists = $query->select("album.*,singer.singer_name")->joinWith(['albumSinger'])->offset($page->offset)->limit($page->limit)->asArray()->all();

        echo $this->render("list",['lists'=>$lists,'page'=>$page,'type_lists'=>$type_array]);

    }

    public function actionDownloadLink()
    {
        $form = new LinkForm();
        if($form->load(Yii::$app->request->post()) && $form->validate())
        {
            $info = Album::findOne(['id'=>$form->album_id]);
            $link = $info->link;
            if(empty($link))
            {
                return json_encode(['code'=>2]);
            }
            else
            {
                return json_encode(['code'=>1,'link'=>$link]);
            }
        }
        return json_encode(['code'=>0]);
    }

}