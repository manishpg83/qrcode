<?php

namespace app\models;
use app\models\Client;

use Yii;

/**
 * This is the model class for table "client_group".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $group_name
 * @property string $group_image
 * @property string $description
 * @property string $group_email_template
 * @property integer $status
 * @property integer $created_date
 *
 * @property Users $user
 */
class ClientGroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    //public $file;
    public $slug_url;
    public static function tableName()
    {
        return 'client_group';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'group_name', 'description', 'group_email_template', 'status'], 'required'],
            [['user_id', 'status'], 'integer'],
            [['description', 'group_email_template', 'group_image'], 'string'],
            [['group_name'], 'string', 'max' => 50],
            [['group_image'], 'string', 'max' => 100],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Client::className(), 'targetAttribute' => ['user_id' => 'id']],
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
            'group_name' => 'Group Name',
            'group_image' => 'Group Image',
            'description' => 'Description',
            'group_email_template' => 'Group Email Template',
            'status' => 'Status',
            'created_date' => 'Created Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Client::className(), ['id' => 'user_id']);
    }
}
