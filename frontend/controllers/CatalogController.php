<?php
/**
 * Created by PhpStorm.
 * User: linpeiyu
 * Date: 2016-09-07
 * Time: 9:16
 */

namespace frontend\controllers;


use frontend\models\Blog;
use frontend\models\CapCode;
use frontend\models\Catalog;
use yii\web\Controller;
use Yii;

class CatalogController extends Controller {

    public function actionInfo()
    {
        $cat_id = $_GET['id'];
        $catalog = new Catalog();
        $cat_info = $catalog->catInfo($cat_id);
        $blog_list = $catalog->blog_list($cat_id);

        return $this->render('info',['catalog'=>$cat_info,'blog_list'=>$blog_list]);
    }

    public function actionMainInfo()
    {
        $cat_id = isset($_GET['id'])? intval($_GET['id']):0;
        $p_id = isset($_GET['p_id'])? intval($_GET['p_id']):0;

        if(!empty($cat_id))
        {
            $catalog = new Catalog();
            $info = $catalog->find()->where(['id'=>$cat_id,'user_id'=>Yii::$app->user->id])->asArray()->one();
            if(!empty($info))
            {
                return json_encode($info);
            }
            else{
                return 'error';
            }
        }
        else
        {
            return null;
        }
    }

    public function actionList()//博客列表（目录＋博客）
    {
        $cat_id = isset($_GET['id'])?intval($_GET['id']):0;

        $catalog = new Catalog();
        $catalog_lists = $catalog->catalog_lists(Yii::$app->user->id,$cat_id);
        $parent_id = $catalog->parent_id($cat_id);
        $blog = new Blog();
        $blog_lists = $blog->blogList(Yii::$app->user->id,$cat_id);

        return $this->render("list",[
            'catalogs'=>$catalog_lists,
            'blogs'=>$blog_lists['lists'],
            'catalog_id'=>$cat_id,
            'model'=>$catalog,
            'parent_id'=>$parent_id
        ]);
    }

    public function actionSave()
    {
        $post_data = Yii::$app->request->post("Catalog");
        if(empty($post_data['id']))
        {
            $catalog = new Catalog();
            $catalog->ad_time = time();
        }
        else
        {
            $catalog = Catalog::findOne(['id'=>$post_data['id'],'user_id'=>Yii::$app->user->id]);
        }
        if($catalog !== null)
        {
            if($catalog->load(Yii::$app->request->post()))
            {
                $catalog->user_id = Yii::$app->user->id;
                $result = $catalog->save()? ['code'=>0,'message'=>'保存成功']:['code'=>1,'message'=>'保存失败'];
            }
            else
            {
                $result['code'] = 1;
                $result['message'] = '提交数据有误，请重新提交！';
            }
        }
        else
        {
            $result['code'] = 1;
            $result['message'] = '没有找到目录，请重新刷新！';
        }
        return json_encode($result);
    }





}