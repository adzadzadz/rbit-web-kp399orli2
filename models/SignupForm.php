<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class SignupForm extends Model
{
	public $username;
	public $password;
	public $confirmpassword;
	public $email;

	public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => 'app\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 4, 'max' => 255],

            // ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => 'app\models\User', 'message' => 'This email address has already been taken.'],

            [['password', 'confirmpassword'], 'required'],
            [['password', 'confirmpassword'],'string', 'min' => 6, 'max' => 255, 'message' => 'Password too short.'],
            ['password', 'compare', 'compareAttribute' => 'confirmpassword', 'message' => 'Password does not match.'],
        ];
	}
	
    public function signup()
    {
		if ($this->validate()) {
			$user = new \app\models\User;
			$user->username = $this->username;
			$user->email = $this->email;
			$user->password = Yii::$app->security->generatePasswordHash($this->password);
			$user->auth_key = Yii::$app->security->generateRandomString();
			
			if ($user->save()) {
				$token = new \app\models\AuthToken;
                $token->user_id = $user->id;
				$token->token = AuthToken::generateUniqueToken();
				$token->save();
			}

			return [
				'user' => $user,
				'token' => $token
			];
		}
		return false;
	}
	
	public function attributeLabels()
    {
        return [
            'verification' => 'Username',
            'id' => 'ID',
            'username' => 'Username',
            'email' => 'Email',
            'password' => 'Password',
            'confirmpassword' => 'Confirm Password',
            'firstname' => 'First Name',
            'middlename' => 'Middle Name',
            'lastname' => 'Last Name',
            'mobile' => 'Mobile',
            'phone' => 'Phone',
            'role' => 'Role',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'region' => 'Data Location',     
            'verification' => 'Verification Code',
        ];
    }
}
