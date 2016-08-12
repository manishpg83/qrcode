<?php
namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    private $_user;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return boolean whether the user is logged in successfully
     */

    /*public function login()
    {    
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        } else {
            return false;
        }
    }*/
 /* public function loginUser()
    {
        if ($this->validate() && $this->_user->isUser)
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        else {
            $this->addError('password', 'Incorrect username or password.');
            return false;
        }
    }*/
 
    /*public function loginAdmin()
    {
        if ($this->validate() && $this->_user->isAdmin)
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        else {
            $this->addError('password', 'Incorrect username or password.');
            return false;
        }
    }*/

    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        } else {
            return false;
        }
    }
     public function loginAdmin()
        {
          if ($this->validate() && User::isUserAdmin($this->username)) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
          } else {
            return false;
          }
        }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
   /* protected function getUser()
    { */   

       /* if ($this->_user === null) {
           /* echo "SELECT * FROM `users` WHERE `email` = 'admin@admin.com'"; exit;*/
          /* $record=Users::model()->findAll(array(
            'condition'=>'email=:username',
                'params'=>array(':username'=>$username),
            ));*/
      /*     $connection = Yii::$app->getDb();
     $command = $connection->createCommand("SELECT * FROM `users` WHERE `email` = 'admin@admin.com'");

$result = $command->queryAll();
return $result;*/
 protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }
}