<div class="groups form">
    <?php echo $this->Form->create('Group'); ?>
    <fieldset>
        <legend><?php echo __('Edit Group'); ?></legend>
        <?php
        echo $this->Form->input('name');
        echo $this->Form->input('alias');
        echo $this->Form->input('decription');
        echo $this->Form->input('id');
        //echo $this->Form->input('User');
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Submit')); ?>
</div>