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
class Client extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
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
            [[ 'email', 'user_name','phone'], 'required'],
            [['role_id', 'phone'], 'integer'],
            [['slug_url','password_hash','role_id', 'phone'], 'safe'],

           // [['photo'],'file'],
            //[['photo'],'file', 'extension'=>'jpg,gif,png'],
            [['password_hash','email', 'contact_person', 'slug_url'], 'string', 'max' => 255],
            [['user_name'], 'string', 'max' => 100],
            [['email'], 'unique'],
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
            'password_hash' => 'Password',
            'phone' => 'Phone',
            'email' => 'Email',
            'user_name' => 'client name',
            'contact_person' => 'Contact Person',
            'slug_url' => 'Slug Url',
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
