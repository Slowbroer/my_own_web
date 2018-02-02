<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "game".
 *
 * @property int $id
 * @property string $name
 * @property string $developer
 * @property string $publisher
 * @property string $picture
 * @property string $content
 * @property string $price 价格
 * @property string $score 评分
 * @property int $platform 1:ps4,2:switch,3:xbox,4:3ds,5:psv
 * @property int $onsale 1:true,0:nope
 * @property int $sale_start_time 促销开始时间
 * @property int $sale_end_time 促销结束时间
 * @property int $have_dlc 是否有dlc，1:是，0:不是
 * @property int $have_demo 是否有demo，1:是，0:不是
 * @property int $release_time 发售时间
 * @property string $language  支持语言
 * @property string $region 区域，1:美服；2:日服
 */
class Game extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'game';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content'], 'string'],
            [['price', 'score', 'region'], 'number'],
            [['platform', 'onsale', 'sale_start_time', 'sale_end_time', 'have_dlc', 'have_demo', 'release_time'], 'integer'],
            [['name', 'picture', 'language'], 'string', 'max' => 255],
            [['developer', 'publisher'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'developer' => 'Developer',
            'publisher' => 'Publisher',
            'picture' => 'Picture',
            'content' => 'Content',
            'price' => 'Price',
            'score' => 'Score',
            'platform' => 'Platform',
            'onsale' => 'Onsale',
            'sale_start_time' => 'Sale Start Time',
            'sale_end_time' => 'Sale End Time',
            'have_dlc' => 'Have Dlc',
            'have_demo' => 'Have Demo',
            'release_time' => 'Release Time',
            'language' => 'Language',
            'region' => 'Region',
        ];
    }
}
