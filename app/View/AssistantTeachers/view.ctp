<div class="assistantTeachers view">
<h2><?php echo __('Assistant Teacher'); ?></h2>
	<dl>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($assistantTeacher['User']['name'], array('controller' => 'users', 'action' => 'view', $assistantTeacher['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Course'); ?></dt>
		<dd>
			<?php echo $this->Html->link($assistantTeacher['Course']['name'], array('controller' => 'courses', 'action' => 'view', $assistantTeacher['Course']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Lecture Hours'); ?></dt>
		<dd>
			<?php echo h($assistantTeacher['AssistantTeacher']['lecture_hours']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($assistantTeacher['AssistantTeacher']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modifield'); ?></dt>
		<dd>
			<?php echo h($assistantTeacher['AssistantTeacher']['modifield']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($assistantTeacher['AssistantTeacher']['id']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Assistant Teacher'), array('action' => 'edit', $assistantTeacher['AssistantTeacher']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Assistant Teacher'), array('action' => 'delete', $assistantTeacher['AssistantTeacher']['id']), array(), __('Are you sure you want to delete # %s?', $assistantTeacher['AssistantTeacher']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Assistant Teachers'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Assistant Teacher'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Courses'), array('controller' => 'courses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Course'), array('controller' => 'courses', 'action' => 'add')); ?> </li>
	</ul>
</div>
