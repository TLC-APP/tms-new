<div class="assistantTeachers form">
<?php echo $this->Form->create('AssistantTeacher'); ?>
	<fieldset>
		<legend><?php echo __('Edit Assistant Teacher'); ?></legend>
	<?php
		echo $this->Form->input('user_id');
		echo $this->Form->input('course_id');
		echo $this->Form->input('lecture_hours');
		echo $this->Form->input('modifield');
		echo $this->Form->input('id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('AssistantTeacher.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('AssistantTeacher.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Assistant Teachers'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Courses'), array('controller' => 'courses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Course'), array('controller' => 'courses', 'action' => 'add')); ?> </li>
	</ul>
</div>
