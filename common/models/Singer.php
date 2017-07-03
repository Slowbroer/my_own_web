<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "singer".
 *
 * @property integer $id
 * @property string $singer_name
 * @property string $brief
 * @property integer $content
 * @property integer $sex
 * @property integer $birthday
 */
class Singer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'singer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content', 'sex'], 'integer'],
            [['singer_name', 'brief', 'birthday'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'singer_name' => 'Singer Name',
            'brief' => 'Brief',
            'content' => 'Content',
            'sex' => 'Sex',
            'birthday' => 'Birthday',
        ];
    }
}
