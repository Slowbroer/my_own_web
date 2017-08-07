<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "article".
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property integer $add_time
 * @property integer $update_time
 * @property string $brief
 * @property string $title_img
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content'], 'string'],
            [['add_time', 'update_time'], 'integer'],
            [['title'], 'string', 'max' => 50],
            [['brief', 'title_img'], 'string', 'max' => 255],
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
            'add_time' => 'Add Time',
            'update_time' => 'Update Time',
            'brief' => 'Brief',
            'title_img' => 'Title Img',
        ];
    }
}
