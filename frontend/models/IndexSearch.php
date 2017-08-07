<?php
/**
 * Created by PhpStorm.
 * User: Slowbro
 * Date: 17/7/29
 * Time: PM3:03
 */

namespace frontend\models;


use yii\base\Model;

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

}