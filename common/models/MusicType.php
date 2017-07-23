<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

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
            [['parent_id'],'default','value'=>0],
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


    public function type_array()
    {
        $array = $this->find()->select("type_name,id")->asArray()->all();

//        return $array;

        return ArrayHelper::map($array,'id','type_name');

    }

}
