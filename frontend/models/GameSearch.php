<?php
/**
 * Created by PhpStorm.
 * User: Slowbro
 * Date: 17/12/4
 * Time: AM10:10
 */

namespace frontend\models;


use common\models\Game;
use yii\base\Model;
use yii\data\Pagination;

class GameSearch extends Model
{
    public $priceLevel;
    public $platform;
    public $region = 1;
    public $title;

    public function rules()
    {
        return [
            [['priceLevel','platform','region'],'integer'],
            [['title'],'string','max'=>20],
        ];
    }

    public function search()
    {
        $where1 = array(
            'platform'=>$this->platform,
            'region'=>$this->region,
        );
        $where2 = array();
        $where3 = array();
        $where4 = empty($this->title)? array():['like','name',$this->title];
        if(empty($this->priceLevel))
        {
            if($this->platform == 2)
            {
                $level_price = 1000;//日服
            }
            else
            {
                $level_price = 10;//美服
            }

            $min_price = ($this->priceLevel-1)*$level_price+0.01;
            $max_price = $this->priceLevel*$level_price;
            $where2 = array(
                '>=','price',$min_price
            );
            if($this->priceLevel<=5)
            {
                $where3 = array(
                    '<=','price',$min_price
                );
            }
        }


        $query = Game::find()->where($where1)->andWhere($where2)->andWhere($where3);
        $count = $query->count();
        $pagination = new Pagination([
            'totalCount'=>$count,
            'params'=>array_merge($_GET, [
                'GameSearch[priceLevel]' => $this->priceLevel,
                'GameSearch[platform]' => $this->platform,
                'GameSearch[region]' => $this->region,
                'GameSearch[title]' => $this->title,
            ]),
        ]);

        $games = $query->offset($pagination->offset)->limit($pagination->limit)->asArray()->all();

        return array(
            'lists'=>$games,
            'page'=>$pagination,
        );
    }
}