<!-- protected/views/conference/index.php -->
<!-- Выполняем действия для каждого элемента массива list -->
<?php foreach($list as $item): ?>
	<!-- Выводим ссылку на страницу соответствующей конференции -->
	<h2><?php echo CHtml::link(CHtml::encode($item->title),
			array('conference/view', 'id' => $item->id)); ?></h2>
<!-- В представлениях удобнее использовать такой вариант синтаксиса
вместо фигурных скобок -->
<?php endforeach; ?>
<?php echo CHtml::link('Администрирование', array('conference/admin')); ?>
