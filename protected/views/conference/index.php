<!-- protected/views/conference/index.php -->
<h1>Наши мероприятия</h1>
<table>
	<tr>
		<th>Название</th>
		<th>Дата окончания регистрации</th>
	</tr>
	<?php foreach($list as $item): ?>
	<tr>
		<td><?php echo CHtml::link(CHtml::encode($item->title),
			array('conference/view', 'id' => $item->id)); ?></td>
		<td><?php echo CHtml::encode($item->till); ?></td>
	</tr>
	<?php endforeach; ?>
</table>
