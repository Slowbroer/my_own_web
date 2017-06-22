<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "music_type".
 *
 * @property integer $id
 * @property string $type_name
 * @property integer $parent_id
 */
class MusicType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'music_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id'], 'integer'],
            [['type_name'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type_name' => 'Type Name',
            'parent_id' => 'Parent ID',
        ];
    }
}
