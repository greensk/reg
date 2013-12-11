<?php
// protected/controllers/MemberController.php
class MemberController extends Controller {
	
	/*
	 * Добавление участника конференции
	 * 
	 * @param int $conference
	 */
	public function actionAdd($conference)
	{
		// Загрузим модель конференции (она понадобится для представления)
		$conferenceModel = Conference::model()->findByPk($conference);
		
		if ($conferenceModel === null || $conferenceModel->enabled == 0)
			throw new CHttpException(404);
	
		// Создаем новую модель участника.
		$model = new Member;
		// Задаем ему id конференции в соответствии с переданным параметром
		$model->conference_id = $conference;

		/*
		 * Получаем данные формы, переданные через POST-параметры.
		 * Если такие данные есть — пытаемся сохранить их.
		 * 
		 */
		if ($form = Yii::app()->request->getParam('Member')) {
			// Записываем данные в модель
			$model->attributes = $form;
			
			/*
			 * Пытаемся сохранить. Значение true параметра говорит о том,
			 * что нужно осуществить валидацию данных в соответствии 
			 * с правилами, определенными в модели.
			 * 
			 * Если сохранения произведено успешно, переадресуем 
			 * пользователся на страницу с сообщением об успешной
			 * регистрации.
			 */
			if ($model->save(true)) {
				$this->redirect(CHtml::normalizeUrl(
					array('member/success', 'id' => $model->id)));
			}
		}

		/*
		 * Если данные не переданы или сохранить их не удалось из-за
		 * того, что данные не прошли валидацию, выводим форму
		 * добавления участника.
		 * 
		 */
		$this->render('edit',array(
				'model'=>$model,
				'conference'=>$conferenceModel,
		));

	}
	
	/**
	 * Вывод сообщение об успешной регистрации на конференции
	 * 
	 * @param int $id
	 * 
	 */
	public function actionSuccess($id)
	{
		$model = Member::model()->with('conference')->findByPk($id);
		$this->render('success', array('model' => $model));
	}
	
	/**
	 * Удаление участника конференции администратором.
	 * При первом запросе запрашивается подтверждение.
	 * После этого действие вызывается уже с параметров $confirm = true.
	 *
	 */
	public function actionDelete($id, $confirm = false)
	{
		$model = Member::model()->with('conference')->findByPk($id);
		if (!$model) {
			throw new CHttpException(404);
		}
		if ($confirm) {
			$model->delete();
			/*
			 * После успешного удаление пользователь переадресуется
			 * на полный список участников конференции.
			 * 
			 */
			$this->redirect(array('conference/members', 'id' => $model->conference->id));
		} else {
			$this->render('delete', array('model' => $model));
		}
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
	 * Правила доступа для пользователей — здесь нужно ограничить
	 * только доступ к действию delete.
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
				'actions'=>array('delete'),
				'users'=>array('*'),
			),
		);
	}

	
}
