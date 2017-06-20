<?php
/**
 * Created by PhpStorm.
 * User: Slowbro
 * Date: 17/6/19
 * Time: PM3:49
 */

namespace frontend\controllers;


use common\models\Album;
use frontend\models\AlbumSearch;
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
            echo $this->render('info',['model'=>$album,'form'=>$form]);

        }
        else
        {
            echo $this->render("/site/error",['message'=>'没有找到专辑页面']);
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
//        var_dump("test");
        if(!empty($type_id))
        {
            $where['type_id'] = $type_id;
        }
//        $album = new Album();
        $query = Album::find()->where($where);
        $count = $query->count();
        $page = new Pagination(['totalCount'=>$count]);


        $lists = $query->offset($page->offset)->limit($page->limit)->asArray()->all();
//        var_dump($lists);
        echo $this->render("list",['lists'=>$lists,'page'=>$page]);

    }

}