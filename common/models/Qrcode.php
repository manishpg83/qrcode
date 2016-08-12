<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "qrcode".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $qrcode
 * @property integer $status
 * @property integer $used_status
 */
class Qrcode extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'qrcode';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'qrcode', 'status', 'used_status'], 'required'],
            [['user_id', 'status', 'used_status'], 'integer'],
            [['qrcode'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'qrcode' => 'Qrcode',
            'status' => 'Status',
            'used_status' => 'Used Status',
        ];
    }
}
