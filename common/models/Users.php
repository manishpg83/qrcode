<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property integer $id
 * @property integer $role_id
 * @property string $user_name
 * @property string $email
 * @property string $password
 * @property string $dod
 * @property string $about
 * @property string $photo
 * @property integer $status
 * @property integer $is_admin
 * @property string $created_date
 * @property string $slug_url
 * @property string $contact_person
 *
 * @property ClientGroup[] $clientGroups
 * @property Role $role
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['role_id', 'user_name', 'email', 'password', 'dod', 'about', 'photo', 'status', 'is_admin', 'created_date', 'slug_url', 'contact_person'], 'required'],
            [['role_id', 'status', 'is_admin'], 'integer'],
            [['dod', 'created_date'], 'safe'],
            [['about'], 'string'],
            [['user_name', 'email', 'password', 'photo'], 'string', 'max' => 100],
            [['slug_url', 'contact_person'], 'string', 'max' => 255],
            [['role_id'], 'exist', 'skipOnError' => true, 'targetClass' => Role::className(), 'targetAttribute' => ['role_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'role_id' => 'Role ID',
            'user_name' => 'User Name',
            'email' => 'Email',
            'password' => 'Password',
            'dod' => 'Dod',
            'about' => 'About',
            'photo' => 'Photo',
            'status' => 'Status',
            'is_admin' => 'Is Admin',
            'created_date' => 'Created Date',
            'slug_url' => 'Slug Url',
            'contact_person' => 'Contact Person',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClientGroups()
    {
        return $this->hasMany(ClientGroup::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(Role::className(), ['id' => 'role_id']);
    }
}
