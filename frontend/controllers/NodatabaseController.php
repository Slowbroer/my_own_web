<?php
/**
 * Created by PhpStorm.
 * User: Slowbro
 * Date: 17/3/2
 * Time: 下午7:14
 */

namespace frontend\controllers;


use common\models\User;
use yii\helpers\Url;
use yii\web\Controller;

class NodatabaseController extends Controller
{
    public function actionRedis(){
        $redis = new \Redis();
        $connect = $redis->connect("127.0.0.1",6379);
//        var_dump($connect);
        echo "Server is running: " . $redis->ping(). PHP_EOL."<br>";

        $redis->set('name','lin');
        echo $redis->get('name');

    }

}