<?php
// protected/controllers/ConferenceController.php
class ConferenceController extends Controller {
	
	public function actionView($id)
	{
		$conference = Conference::model()->findByPk($id);
		if (!$conference)
			throw new CHttpException(404);
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
