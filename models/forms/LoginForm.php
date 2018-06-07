<?php
namespace app\models\forms;
use yii\base\Model;
use app\models\User;

class LoginForm extends Model{
 
	public $username;
	public $password;

	/*public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }*/

    //'password', 'validatePassword'

	public function rules() {
		return [
			[['username', 'password'], 'required', 'message' => 'Заполните поле'],
			['username', 'unique', 'targetClass' => User::className(),  'message' => 'Этот логин уже занят'],
		];
	}

	public function attributeLabels() {
		return [
			'username' => 'Логин',
			'password' => 'Пароль',
		];
	}
 
}
