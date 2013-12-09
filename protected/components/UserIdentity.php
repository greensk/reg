<?php

/**
 * Класс реализует действия, необходимые для авторизации пользователя.
 * Здесь можно реализовать загрузку пользователей из базы данных,
 * шифрование (хэшированрие) паролей пользователей и т.д.
 * В нашем же случае просто возьмем пароль из файла конфигурации.
 * 
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Введенные имя пользователя и пароль уже записаны 
	 * в свойства класса $this->username и 
	 * $this->password соответствнно.
	 * 
	 * Нам же нужно проверить их корректность и вернуть:
	 * self::ERROR_USERNAME_INVALID если неверное имя пользователя,
	 * self::ERROR_USERNAME_INVALID если неверный пароль,
	 * self::ERROR_USERNAME_INVALID если имя пользователя и пароль
	 * правильные.
	 * 
	 * @return int
	 */
	public function authenticate()
	{
		$users=array(
			'admin' => Yii::app()->params['adminPassword']
		);
		if(!isset($users[$this->username]))
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		elseif($users[$this->username]!==$this->password)
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else
			$this->errorCode=self::ERROR_NONE;
		return !$this->errorCode;
	}
}
