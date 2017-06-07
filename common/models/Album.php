<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "album".
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property string $img
 * @property integer $type
 * @property string $link
 * @property string $singer
 * @property double $score
 * @property integer $publish_time
 * @property integer $add_time
 * @property integer $update_time
 */
class Album extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'album';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content', 'type', 'score'], 'required'],
            [['content'], 'string'],
            [['type', 'publish_time', 'add_time', 'update_time'], 'safe'],
            [['score'], 'number'],
            [['title', 'img', 'link', 'singer'], 'string', 'max' => 255],
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
            'content' => 'Content',
            'img' => 'Img',
            'type' => 'Type',
            'link' => 'Link',
            'singer' => 'Singer',
            'score' => 'Score',
            'publish_time' => 'Publish Time',
            'add_time' => 'Add Time',
            'update_time' => 'Update Time',
        ];
    }
}
