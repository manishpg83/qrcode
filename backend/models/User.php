<?php

namespace app\models;


use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property integer $role_id
 * @property string $username
 * @property string $dod
 * @property string $about
 * @property string $photo
 * @property integer $is_admin
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $user_name
 * @property string $contact_person
 * @property string $slug_url
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Role $role
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
     public $file;
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'dod', 'about','email', 'user_name'], 'required'],
            [['role_id', 'is_admin', 'status', 'created_at', 'updated_at'], 'integer'],
            [['dod','is_admin','auth_key','password_hash','contact_person','created_at','updated_at','username','slug_url','status','role_id', 'photo'], 'safe'],
            [['about'], 'string'],
           // [['photo'],'file'],
            //[['photo'],'file', 'extension'=>'jpg,gif,png'],
            [['username', 'photo', 'password_hash', 'password_reset_token', 'email', 'contact_person', 'slug_url'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['user_name'], 'string', 'max' => 100],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
            /*[['role_id'], 'exist', 'skipOnError' => true, 'targetClass' => Role::className(), 'targetAttribute' => ['role_id' => 'id']],*/
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
            'username' => 'Username',
            'dod' => 'Date-Of-Birth',
            'about' => 'About',
            'file' => 'Photo',
            'is_admin' => 'Is Admin',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'user_name' => 'User Name',
            'contact_person' => 'Contact Person',
            'slug_url' => 'Slug Url',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {   
        return $this->hasOne(Role::className(), ['id' => 'role_id']);
    }
}
