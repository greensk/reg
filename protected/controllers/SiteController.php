<?php

/*
 * Класс содержит стандартный набор действий, генерируемый при
 * создании нового Yii-приложения. Из них оставим только вывод
 * сообщения об ошибке, а также вход и выход пользователя из системы.
 * 
 */
class SiteController extends Controller
{

	/**
	 * Реализация страницы сообщения об ошибке.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Форма вода в систему.
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// Предварительная обработка AJAX-запроса
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// Авторизация пользователя
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// Отображение формы входа в систему
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Действие по выходу пользователя из системы.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
	
}
