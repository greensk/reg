<!-- protected/views/member/edit.php -->

<!-- Выводим форму ввода данных -->
<?php $form = $this->beginWidget('CActiveForm') ?>

<!-- Выводим скрытое поле с указанием id конференции, на которую осуществляется регистрация -->
<?php echo $form->hiddenField($model,'conference_id'); ?>
<table>
		<tr>
				<!-- Вывод названия поля, определенного в модели (в данном случае фамилии) -->
				<th><?php echo $form->labelEx($model,'last_name'); ?></th>
				<td>
						<!-- Отображаем текстовое поле для ввода фамилии -->
						<?php echo $form->textField($model,'last_name', array('size' => 45,'maxlength' => 45)); ?>
						<!-- На случай, если форма отображается повторно, после одной неудачной попытки ввода, отобразим сообщение об ошибке в этом поле (если ошибки нет, ничего не отобразится). -->
						<?php echo $form->error($model,'last_name'); ?>
				</td>
		</tr>
		<tr>
				<th><?php echo $form->labelEx($model,'first_name'); ?></th>
				<td>
						<?php echo $form->textField($model,'first_name', array('size' => 45,'maxlength' => 45)); ?>
						<?php echo $form->error($model,'first_name'); ?>
				</td>
		</tr>
		<tr>
				<th><?php echo $form->labelEx($model,'phone'); ?></th>
				<td>
						<?php echo $form->textField($model,'phone', array('size' => 45,'maxlength' => 45)); ?>
						<?php echo $form->error($model,'phone'); ?>
				</td>
		</tr>
		<tr>
				<th><?php echo $form->labelEx($model,'email'); ?></th>
				<td>
						<?php echo $form->textField($model,'email', array('size' => 45,'maxlength' => 45)); ?>
						<?php echo $form->error($model,'email'); ?>
				</td>
		</tr>
		<tr>
				<td></td>
				<td>
						<!-- Выводим кнопку для отправки данных формы -->
						<?php echo CHtml::submitButton('Зарегистрироваться'); ?>
				</td>
		</tr>
</table>

<!-- Завершаем вывод формы данных -->
<?php $this->endWidget(); ?>
