<?php
/**
 * Created by PhpStorm.
 * User: Slowbro
 * Date: 17/12/4
 * Time: AM10:07
 */

namespace frontend\controllers;


use common\models\Game;
use frontend\models\Comment;
use frontend\models\GameSearch;
use yii\web\Controller;
use Yii;

class GameController extends Controller
{
//
//    public function actionIndex(){
//        $search =
//        return $this->render("index",[
//            'search'=>
//        ])
//    }

    public function actionGameList(){

        $search_form = new GameSearch();
        if($search_form->load(Yii::$app->request->get())&&$search_form->validate())
        {
            $result = $search_form->search();
            foreach ($result['list'] as $key=>$list)
            {
                if($list['onsale']==1)
                {
                    $result['list'][$key]['sale_start_time'] = date("Y-m-d",$list['sale_start_time']);
                    $result['list'][$key]['sale_end_time'] = date("Y-m-d",$list['sale_end_time']);
                }
                $result['list'][$key]['release_time'] = empty($list['release_time'])? 'coming soon...':date("Y-m-d",$list['release_time']);
            }
            return $result;
        }
        else
        {
            return $this->render("index",['model'=>$search_form]);
        }
    }

    public function actionInfo()
    {
        $id = Yii::$app->request->get('id');
        $game = Game::findOne(['id'=>$id])->toArray();
        if($game)
        {
            $this->render("info",['model'=>$game]);
        }
        else
        {
            return array(
                'code'=>0,
                'message'=>'不存在'
            );
        }
    }

    public function actionComment(){
        $id = Yii::$app->request->get('id');
        $comment = new Comment();
        $result = $comment->comment_list($id,3);//3:games

        return json_encode($result['list']);
    }

    public function actionLittleIndex()
    {
        $game = new Game();
        $new_release = $game->new_release();
        $rank_game = $game->rank_order();

        return json_encode(array(
            'new'=>$new_release,
            'rank'=>$rank_game,
        ));
    }


}