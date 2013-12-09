<!-- protected/views/conference/members.php -->
<?php echo CHtml::link('На страницу администрирования', array('conference/admin')); ?>
<h1>Участники мероприятия <?php echo CHtml::encode($model->title); ?>:</h1>
<?php if (empty($model->members)): ?>
<div>Пока никто не зарегистировался.</div>
<?php else: ?>
<table>
	<tr>
		<th>Фамилия</th>
		<th>Имя</th>
		<th>Телефон</th>
		<th>E-mail</th>
		<th>Действия</th>
	</tr>
	<?php foreach ($model->members as $member): ?>
	<tr>
		<td><?php echo CHtml::encode($member->last_name); ?></td>
		<td><?php echo CHtml::encode($member->first_name); ?></td>
		<td><?php echo CHtml::encode($member->phone); ?></td>
		<td><?php echo CHtml::encode($member->email); ?></td>
		<td><?php echo CHtml::link('Удалить', array('member/delete', 'id' => $member->id)); ?></td>
	</tr>
	<?php endforeach; ?>
</table>
<?php endif; ?>
