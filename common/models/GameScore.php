<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "game_score".
 *
 * @property int $id
 * @property string $title
 * @property string $score_type
 * @property string $score
 * @property int $add_time
 * @property int $update_time
 * @property int $game_id
 */
class GameScore extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'game_score';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['score'], 'number'],
            [['add_time', 'update_time', 'game_id'], 'integer'],
            [['title'], 'string', 'max' => 100],
            [['score_type'], 'string', 'max' => 11],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'score_type' => 'Score Type',
            'score' => 'Score',
            'add_time' => 'Add Time',
            'update_time' => 'Update Time',
            'game_id' => 'Game ID',
        ];
    }
}
