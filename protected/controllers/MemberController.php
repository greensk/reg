<?php
class MemberController extends Controller {
	public function actionAdd($conference)
	{
		$model = new Member;
		$model->conference_id = $conference;

		if ($form = Yii::app()->request->getParam('Member')) {
			$model->attributes = $form;
			if ($model->save(true)) {
				$this->redirect(CHtml::normalizeUrl(array('member/success', 'id' => $model->id)));
			}
		}

		$this->render('edit',array(
				'model'=>$model,
		));

	}
	
	public function actionSuccess($id)
	{
		$this->render('success');
	}
}
