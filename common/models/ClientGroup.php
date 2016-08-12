<?php

namespace app\models;

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
            [['user_id', 'group_name', 'group_image', 'description', 'group_email_template', 'status', 'created_date'], 'required'],
            [['user_id', 'status', 'created_date'], 'integer'],
            [['description', 'group_email_template'], 'string'],
            [['group_name'], 'string', 'max' => 50],
            [['group_image'], 'string', 'max' => 100],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_id' => 'id']],
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
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }
}
