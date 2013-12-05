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
	
	public function actionIndex()
	{
		$conferencies = Conference::model()->findAll();
		$this->render('index', array('list' => $conferencies));
	}
	
	public function actionMembers($id)
	{
		$model = Conference::model()->with('members')->findByPk($id);
		$this->render('members', array('model' => $model));
	}
	
}
