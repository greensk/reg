<?php $form = $this->beginWidget('CActiveForm') ?>
<?php echo $form->hiddenField($model,'conference_id'); ?>
<table>
		<tr>
				<th><?php echo $form->labelEx($model,'last_name'); ?></th>
				<td>
						<?php echo $form->textField($model,'last_name', array('size' => 45,'maxlength' => 45)); ?>
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
						<?php echo CHtml::submitButton('Зарегистрироваться'); ?>
				</td>
		</tr>
</table>
<?php $this->endWidget(); ?>
