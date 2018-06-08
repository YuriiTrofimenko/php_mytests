<?php
namespace app\models\forms;
use yii\base\Model;
use app\models\User;

class SignupForm extends Model{
 
	public $username;
	public $password;

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
