<?php
/**
 * Created by PhpStorm.
 * User: Slowbro
 * Date: 17/6/19
 * Time: PM4:04
 */

namespace frontend\models;


use yii\base\Model;
use Yii;

class AlbumSearch extends Model
{

    public $title;
    public $start_time;
    public $end_tiem;
    public $singer;


    public function rules()
    {
        return [
            [['title','singer'],'string','max'=>50],
            [['start_time','end_time'],'data','format'=>'yyyy-MM-dd'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'title'=>Yii::t('title','Title'),
            'singer'=>Yii::t('title','Singer'),
        ];
    }
}