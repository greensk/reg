<!-- protected/views/member/delete.php -->
<div>Вы точно хотите удалить участника <?php echo CHtml::encode("{$model->first_name} {$model->last_name}"); ?>?</div>
<div>
	<?php echo CHtml::link('Нет', array('conference/members', 'id' => $model->conference->id)); ?>
	<?php echo CHtml::link(CHtml::button('Да'), array('member/delete', 'id' => $model->id, 'confirm' => true)); ?>
</div>
