<?php
/**
 * Created by PhpStorm.
 * User: linpeiyu
 * Date: 2016-08-30
 * Time: 10:11
 */

namespace frontend\controllers;
header("Access-Control-Allow-Origin:* ");
use frontend\models\Blog;
use frontend\models\Catalog;
use common\models\User;
use frontend\models\Collect;
use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;

class UserController extends Controller {

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ["*"],
                'rules' => [
                    [
                        'actions' => [],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

//    public $enableCsrfValidation = false;

    public function actionCenter(){
//        var_dump(Yii::$app->user->identity->id);
        $id = Yii::$app->user->identity->id;



        //var_dump($_SESSION);//这里会打印出$_SESSION['id']

//        var_dump( Yii::$app->user);

        $user = User::findIdentity($id);

        $catalog = new Catalog();


        $cat_list = $catalog->getCat($id);
        foreach($cat_list as $key => $cat)
        {
            $cat_list[$key]['sec_cat']=$catalog->getSec($cat['id']);

        }

//        $model = new Blog();
        $model = Blog::find()->where(['id'=>1])->one();





//        var_dump($cat_list);

        return $this->render('center',['cat_list'=>$cat_list,'model'=>$model,'user'=>$user]);
    }

    public function actionRecent_blog(){
//        print_r(Yii::$app->user->identity);
//        if(isset(Yii::$app->user->identity))
//        {
//
//            $user_id = Yii::$app->user->identity->id;
//        }
//        else
//        {
//            $user_id = 2;
//        }

//        $user = Yii::$app->user->identity;
//        print_r($user['id']);


//        var_dump(Yii::$app->user->identity);
//        $user_id = isset($_POST['user_id'])? $_POST['user_id']:0;
        if(!Yii::$app->user->isGuest)
        {
            $user_id = Yii::$app->user->id;
        }
        else
        {
            return "id error";
        }
        $blog = new Blog();
//        $user_id = 2;
        $list = $blog->blogRecent($user_id);

//        $list = "test";
        $content = $this->renderPartial('/blog/list',['lists'=>$list]);
        return $content;


//        if(empty($list))
//        {
//            return "failed";
//        }
//        else
//        {
//            $content = $this->renderPartial('/blog/list',['lists'=>$list]);
////            $content = "test";
//            return $content;
//        }


    }

    public function actionRecentCollect()
    {
        if(Yii::$app->user->isGuest)
        {

        }
        else
        {
            $query = Collect::find();
            $query->joinWith(["blog"]);//这里的参数是一个数组，这里的joinWith会进行判断是否有对应的get函数，如果有的话就会进行调用
            $query->select("blog.id,blog.title,collect.type_value");//这里就是一定要关联的那两个blog.id,collect.type_value
            $query->where('collect.user_id='.Yii::$app->user->id);
            $collect = $query->asArray()->all();
            return $this->renderPartial("/collect/recent_collect",['lists'=>$collect]);
        }
    }

    public function actionTest(){
        $id=$_POST['id'];
    }

}