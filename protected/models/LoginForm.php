<?php

/**
 * Модель формы входа в систему.
 * 
 * Так как у нас в базе данных нет таблицы пользователей, 
 * в качестве регистрационные данные будем хранить просто 
 * к конфигурационном файле. 
 * 
 * Данный класс является моделью, однако он не является классом
 * ActiveRecord, а является классом FromModel, т.е. его данные
 * не сохраняются в базе данных или где-то еще, а просто содержатся 
 * в памяти сервера на время выполнения скрипта.
 */
class LoginForm extends CFormModel
{
	public $username;
	public $password;
	public $rememberMe;

	private $_identity;

	/**
	 * Правила проверки формы — имя пользователя и пароль должны быть
	 * введены, они должны быть верные, поле «Запомнить меня» должно
	 * иметь тип boolean.
	 * 
	 * @return array
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('username, password', 'required'),
			// rememberMe needs to be a boolean
			array('rememberMe', 'boolean'),
			// password needs to be authenticated
			array('password', 'authenticate'),
		);
	}

	/**
	 * Текстовые обозначения полей формы
	 * 
	 * @return array
	 */
	public function attributeLabels()
	{
		return array(
			'rememberMe' => 'Запомнить меня',
			'username' => 'Имя пользователя',
			'password' => 'Пароль',
		);
	}

	/**
	 * Этот метод проверяет корректность введенных имени пользователя
	 * и пароля. Для этого используется класс UserIdentity.
	 */
	public function authenticate($attribute,$params)
	{
		if(!$this->hasErrors())
		{
			$this->_identity=new UserIdentity($this->username,$this->password);
			if(!$this->_identity->authenticate())
				$this->addError('password','Неверное имя пользователя или пароль.');
		}
	}

	/**
	 * Метод входа в систему.
	 * 
	 */
	public function login()
	{
		if($this->_identity===null)
		{
			$this->_identity=new UserIdentity($this->username,$this->password);
			$this->_identity->authenticate();
		}
		if($this->_identity->errorCode===UserIdentity::ERROR_NONE)
		{
			$duration=$this->rememberMe ? 3600*24*30 : 0; // 30 days
			Yii::app()->user->login($this->_identity,$duration);
			return true;
		}
		else
			return false;
	}
}
