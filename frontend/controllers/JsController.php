<?php
/**
 * Created by PhpStorm.
 * User: Slowbro
 * Date: 17/2/25
 * Time: 下午4:15
 */

namespace frontend\controllers;


use yii\web\Controller;

class JsController extends Controller
{
//    js作用域
    public function actionScope()
    {

        return $this->render("scope");
    }



}