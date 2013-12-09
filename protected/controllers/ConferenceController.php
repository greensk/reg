<?php
// protected/controllers/ConferenceController.php

class ConferenceController extends Controller {
	
	/**
	 * Страница конференции.
	 * 
	 * @param int $id
	 * 
	 */
	public function actionView($id)
	{
		/*
		 * Получение модели конкретной конференции 
		 * Conference::model — создание пустой модели конференции (не
		 * соответствующей какой-либо конкретной сущности).
		 * findByPk — нахождение записи с заданным ключем (Primary key).
		 */
		$conference = Conference::model()->findByPk($id);
		
		/*
		 * Если соответствующей записи не существует, $conference
		 * принимает значение null. В этом случае нужно выдать 
		 * пользователю ошибку HTTP 404.
		 */
		if ($conference === null)
			throw new CHttpException(404);
			
		/*
		 * Отображаем представление "view" для данного контроллера.
		 * Передаем ему в качестве параметра модель конференции.
		 */
		$this->render('view', array('model' => $conference));
	}
	
	/**
	 * Страница списка конференций.
	 * 
	 */
	public function actionIndex()
	{
		/*
		 * Используем метод findAll для получения записей из
		 * соответствующей таблицы. В качестве параметра передаем массив
		 * условий — фрагментов SQL-запроса. condition — условия 
		 * выборки записей (WHERE в SQL-запросе), order — условие
		 * сортировки записей (ORDER в SQL-запросе). В данном случае
		 * записи будем сортировать по убыванию id, чтобы в начале 
		 * оказались самые новые мероприятия.
		 * 
		 */
		$conferencies = Conference::model()->findAll(array(
				'condition' => 'enabled = 1', 'order' => 'id DESC'));
				
		/*
		 * Вызываем соответствующее представление, передав ему
		 * полученный массив записей
		 * 
		 */
		$this->render('index', array('list' => $conferencies));
	}
	
	public function actionMembers($id)
	{
		$model = Conference::model()->with('members')->findByPk($id);
		$this->render('members', array('model' => $model));
	}
	
	/*
	 * Правила доступа для действий данного контроллера.
	 * 
	 */
	public function filters()
	{
			return array(
					'accessControl',
			);
	}
        
	/**
	 * Правила доступа для пользователей.
	 * К действиям admin и edit должны иметь доступ только 
	 * авторизированные пользователи — администраторы системы.
	 * 
	 * @return array 
	 */
	public function accessRules()
	{
		return array(
			array('allow', 
				
				'users'=>array('@'),
			),
			array('deny', 
				'actions'=>array('admin', 'edit', 'add', 'members'),
				'users'=>array('*'),
			),
		);
	}

	// Управление списком мероприятий.
	public function actionAdmin()
	{
		/*
		 * Данное действие аналогично действию index, однако выводятся
		 * все мероприятия, в том числе и не активные на текущий момент.
		 * 
		 */
		$conferencies = Conference::model()->findAll(array('order' => 'id DESC'));
		$this->render('admin', array('list' => $conferencies));

	}
	
	// Редактирование мероприятия (для администратора)
	public function actionEdit($id)
	{
		$model = Conference::model()->findByPk($id);
		if ($form = Yii::app()->request->getParam('Conference')) {
			$model->attributes= $form;
			if ($model->save(true)) {
				$this->redirect(CHtml::normalizeUrl(array('conference/admin')));
			}
		}
		$this->render('edit', array('model' => $model));
	}
	
	// Добавление мероприятия (для администратора)
	public function actionAdd()
	{
		$model = new Conference;
		if ($form = Yii::app()->request->getParam('Conference')) {
			$model->attributes= $form;
			if ($model->save(true)) {
				$this->redirect(CHtml::normalizeUrl(array('conference/admin')));
			}
		}
		$this->render('edit', array('model' => $model));
	}
	
}
