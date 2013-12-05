<!-- protected/views/conference/view.php -->

<!-- Отображение названия конференции -->
<h1><?php echo CHtml::encode($model->title); ?></h1>
<!-- Отображение описания -->
<div><?php echo CHtml::encode($model->description); ?></div>
<!-- Место проведения -->
<div>Место проведения: <?php echo CHtml::encode($model->location); ?></div>
<!-- Дата проведения — используем функцию date для преобразования даты
формат, принятый в России. Т.к. поле start_date в БД имеет тип date, 
модель возвращает его значение в строковом виде. Перед использованием 
функции date нужно преобразовать его в формат даты функцией strtotime. -->
<div>Дата: <?php echo CHtml::encode(date('d.m.Y', strtotime($model->start_date))); ?></div>
<!-- Время начала -->
<div>Начало: <?php echo CHtml::encode($model->start_time); ?></div>


<!-- Отображение ссылки для записи на конференцию — для вывода
будем использовать вспомогательный класс CHtml, метод link.
Первый параметр — текст ссылки, второй параметр — путь к странице,
на которую должна быть ссылка. -->
<?php echo CHtml::link('Записаться', array('member/add', 'conference' => $model->id)); ?>
