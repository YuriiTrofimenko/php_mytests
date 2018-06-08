<?php
namespace app\models\forms;
use Yii;
use yii\base\Model;
use app\models\User;

class LoginForm extends Model{
 
 	private $_user = false;
	public $username;
	public $password;

	public function rules() {
		return [
			[['username', 'password'], 'required', 'message' => 'Заполните поле'],
			// password is validated by validatePassword()
            ['password', 'validatePassword'],
		];
	}

	public function attributeLabels() {
		return [
			'username' => 'Логин',
			'password' => 'Пароль',
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
     * Finds user by [[username]].
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByUsername($this->username);
        }
        return $this->_user;
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser());
        }
        return false;
    }
}
