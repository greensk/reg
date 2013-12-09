<!-- protected/views/conference/admin.php -->
<?php echo CHtml::link('Выход', array('site/logout')); ?>
<table>
	<tr>
		<th>№</th>
		<th>Название</th>
		<th>Активность</th>
		<th>Действия</th>
	</tr>
	<?php foreach ($list as $item): ?>
		<tr>
			<td><?php echo $item->id; ?></td>
			<td><?php echo $item->title; ?></td>
			<td><?php 
				if ($item->enabled)
					echo 'Да';
				else
					echo 'Нет';
			 ?></td>
			 <td>
				<?php echo CHtml::link('Редактировать', array('conference/edit', 'id' => $item->id)); ?>
				<?php echo CHtml::link('Список участников', array('conference/members', 'id' => $item->id)); ?>
			 </td>
		</tr>
	<?php endforeach; ?>
	<tr>
		<td colspan="3"></td>
		<td><?php echo CHtml::link('Добавить', array('conference/add')); ?></td>
	</tr>
</table>
