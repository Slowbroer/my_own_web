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
        if(!empty($cat_id))
        {
            $catalog = new Catalog();
            $catalog->find()->where(['id'=>$cat_id])->asArray()->one();
            if(empty($catalog))
            {
                return json_encode($catalog);
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

    public function actionList()
    {
        $cat_id = isset($_GET['id'])?intval($_GET['id']):0;

        $catalog = new Catalog();
        $catalog_lists = $catalog->catalog_lists(Yii::$app->user->id,$cat_id);

        $blog = new Blog();
        $blog_lists = $blog->blogList(Yii::$app->user->id,$cat_id);

        return $this->render("list",['catalogs'=>$catalog_lists,'blogs'=>$blog_lists['lists'],'catalog_id'=>$cat_id,'model'=>$catalog]);
    }

    public function actionSave()
    {
        $catalog = new Catalog();
        if($catalog->load(Yii::$app->request->post()))
        {

        }
    }





}