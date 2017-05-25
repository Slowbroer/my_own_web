<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "collect".
 *
 * @property integer $id
 * @property integer $type
 * @property integer $type_value
 * @property integer $add_time
 * @property integer $user_id
 * @property string $user_name
 * @property integer $value
 */
class Collect extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'collect';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'type_value', 'add_time', 'user_id', 'value'], 'integer'],
            [['type_value', 'user_id'], 'required'],
            [['user_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
            'type_value' => 'Type Value',
            'add_time' => 'Add Time',
            'user_id' => 'User ID',
            'user_name' => 'User Name',
            'value' => 'Value',
        ];
    }

    public function act_collect()
    {
        $this->value = 1-$this->value;
        $this->add_time = time();
        if($this->save())
        {
            return $this->value==1? "collect":"cancel";
        }
        else
        {
            return "fail";
        }

    }

    public function getBlog()
    {
        return $this->hasOne(Blog::className(),['id'=>'type_value']);
    }


}


