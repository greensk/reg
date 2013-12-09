<!-- protected/views/member/edit.php -->
<?php echo CHtml::link('На страницу администрирования', array('conference/admin')); ?>

<!-- Выводим форму ввода данных -->
<?php $form = $this->beginWidget('CActiveForm') ?>

<table>
		<tr>
				<th><?php echo $form->labelEx($model,'title'); ?></th>
				<td>
						<?php echo $form->textField($model,'title'); ?>
						<?php echo $form->error($model,'title'); ?>
				</td>
		</tr>
		<tr>
				<th><?php echo $form->labelEx($model,'description'); ?></th>
				<td>
						<?php echo $form->textArea($model,'description'); ?>
						<?php echo $form->error($model,'description'); ?>
				</td>
		</tr>
		<tr>
				<th><?php echo $form->labelEx($model,'location'); ?></th>
				<td>
						<?php echo $form->textArea($model,'location'); ?>
						<?php echo $form->error($model,'location'); ?>
				</td>
		</tr>
		<tr>
				<th><?php echo $form->labelEx($model,'enabled'); ?></th>
				<td>
						<?php echo $form->checkbox($model,'enabled'); ?>
						<?php echo $form->error($model,'enabled'); ?>
				</td>
		</tr>
		<tr>
				<th><?php echo $form->labelEx($model,'start_date'); ?></th>
				<td>
						<?php echo $form->textField($model,'start_date'); ?>
						<?php echo $form->error($model,'start_date'); ?>
				</td>
		</tr>
		<tr>
				<th><?php echo $form->labelEx($model,'start_time'); ?></th>
				<td>
						<?php echo $form->textField($model,'start_time'); ?>
						<?php echo $form->error($model,'start_time'); ?>
				</td>
		</tr>
		<tr>
				<td></td>
				<td>
						<!-- Выводим кнопку для отправки данных формы -->
						<?php echo CHtml::submitButton('Сохранить'); ?>
				</td>
		</tr>
</table>

<!-- Завершаем вывод формы данных -->
<?php $this->endWidget(); ?>
