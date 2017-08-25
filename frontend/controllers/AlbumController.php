<?php
/**
 * Created by PhpStorm.
 * User: Slowbro
 * Date: 17/6/19
 * Time: PM3:49
 */

namespace frontend\controllers;


use common\models\Album;
use common\models\CommentPraise;
use common\models\MusicType;
use frontend\models\AlbumSearch;
use frontend\models\Comment;
use frontend\models\CommentForm;
use frontend\models\IndexSearch;
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

            $comment = new Comment();
            $hot_comments = $comment->hot_album_comment($id);

            $comment_model = new CommentForm();
            $comment_model->type = 1;
            $comment_model->id = $id;
            echo $this->render('info',['model'=>$album,'form'=>$form,'linkModel'=>$linkModel,'comment_model'=>$comment_model,'hot_comments'=>$hot_comments]);

        }
        else
        {
            echo $this->render("/site/error",['message'=>'没有找到相应的专辑']);
        }
    }

//    高级搜索
    public function actionSearch()
    {
        $albumSearch = new AlbumSearch();
        if($albumSearch->load(Yii::$app->request->post())&&$albumSearch->validate())
        {

        }

    }

    //首页的搜索
    public function actionIndexSearch(){

        $search = new IndexSearch();
        if($search->load(Yii::$app->request->get())&&$search->validate())
        {
            $MusicType = new MusicType();
            $type_array = $MusicType->type_array();

            $album_lists = $search->searchAlbum();
            echo $this->render("list",['lists'=>$album_lists['album_list'],'page'=>$album_lists['page'],'keyword'=>$search->keyword,'type_lists'=>$type_array]);
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


    public function actionComment(){
        if(!Yii::$app->user->isGuest)
        {
            $commentForm = new CommentForm();

            if($commentForm->load(Yii::$app->request->post())&&$commentForm->add_comment(Yii::$app->user->getId()))
            {
                echo $this->render("/site/success",['message'=>'提交成功']);
            }
            else
            {
                echo $this->render("/site/error",['message'=>"提交失败"]);
            }
        }
        else
        {
            echo $this->render("/site/error",['message'=>'您还没有登录，请先登录']);
        }


    }


    public function actionPriseComment(){
        $id = Yii::$app->request->get("id");

        if(!empty($id))
        {
            $comment = Comment::findOne(['id'=>$id]);
            $praise = CommentPraise::findOne(['user_id'=>Yii::$app->user->id,'comment_id'=>$id]);
            if(!isset($praise))
            {
                if(!$comment->add_praise())
                {
                    return json_encode(['code'=>0]);
                }
                else
                {
                    $praise = new CommentPraise();
                    $praise->user_id = Yii::$app->user->id;
                    $praise->comment_id = $id;
                    $praise->add_time = time();
                    if($praise->save())
                    {
                        return json_encode(['code'=>1,'num'=>$comment->praise]);
                    }
                    return json_encode(['code'=>0]);
                }
            }
            else
            {
                return json_encode(['code'=>0]);
            }
        }
        else
        {
            return json_encode(['code'=>0]);
        }
    }

    public function actionCommentList(){
        $id = Yii::$app->request->get("id");

        $comment = new Comment();
        $comment_lists = $comment->comment_list($id,1);

        $linkModel = new LinkForm();
        $linkModel->album_id = $id;

        $album_info = Album::findOne(['id'=>$id]);

        $comment_model = new CommentForm();
        $comment_model->type = 1;
        $comment_model->id = $id;

        return $this->render("comment_list",['comment_lists'=>$comment_lists['lists'],'album_info'=>$album_info,'page'=>$comment_lists['page'],'linkModel'=>$linkModel,'comment_model'=>$comment_model]);

    }

}