<!-- protected/views/conference/view.php -->

<!-- Отображение названия конференции -->
<h1><?php echo CHtml::encode($model->title); ?></h1>
<!-- Отображение описания -->
<div><?php echo CHtml::encode($model->description); ?></div>
<!-- Отображение ссылки для записи на конференцию — для вывода
будем использовать вспомогательный класс CHtml, метод link.
Первый параметр — текст ссылки, второй параметр — путь к странице,
на которую должна быть ссылка. -->
<?php echo CHtml::link('Записаться!', array('conference/view')); ?>
