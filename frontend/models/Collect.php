<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "collect".
 *
 * @property integer $id
 * @property integer $type
 * @property integer $value
 * @property integer $add_time
 * @property integer $user_id
 * @property string $user_name
 * @property integer $type_value
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
            [['type', 'value', 'add_time', 'user_id','type_value'], 'integer'],
            [['value', 'user_id'], 'required'],
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
            'value' => 'Value',
            'add_time' => 'Add Time',
            'user_id' => 'User ID',
            'user_name' => 'User Name',
        ];
    }

//    public function is_collected($blog_id,$type = 1)
//    {
//        if(Yii::$app->user->isGuest)
//        {
//            return false;
//        }
//        $result = $this->find()->where(['value'=>$blog_id,'type'=>$type,'user_id'=>Yii::$app->user->identity->getId()])->one();
//        return $result->value==1? false:true;
//    }

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


}
