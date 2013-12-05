<!-- protected/views/conference/index.php -->
<h1>Наши мероприятия</h1>
<ul>
	<!-- Выполняем действия для каждого элемента массива list -->
	<?php foreach($list as $item): ?>
		<!-- Выводим ссылку на страницу соответствующей конференции -->
		<li><?php echo CHtml::link(CHtml::encode($item->title),
				array('conference/view', 'id' => $item->id)); ?></li>
	<!-- В представлениях удобнее использовать такой вариант синтаксиса
	вместо фигурных скобок -->
	<?php endforeach; ?>
</ul>
