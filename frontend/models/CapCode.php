<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "cap_code".
 *
 * @property integer $id
 * @property string $code
 * @property integer $type    //1:email   2:mobile
 * @property string $mobile
 * @property string $email
 * @property integer $used
 * @property integer $add_time
 */
class CapCode extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cap_code';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code'], 'required'],
            [['type', 'used','add_time'], 'integer'],
            [['code', 'mobile', 'email'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Code',
            'type' => 'Type',
            'mobile' => 'Mobile',
            'email' => 'Email',
            'used' => 'Used',
            'add_time' => '添加时间',
        ];
    }
}
