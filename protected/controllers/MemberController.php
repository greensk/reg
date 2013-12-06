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
		$this->render('success');
	}
}
