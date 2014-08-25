<div id="message"></div>
<div class="assistantTeachers form">
    <?php
    echo $this->Form->create('AssistantTeacher', array(
        'inputDefaults' => array(
            'div' => 'form-group',
            'label' => array(
                'class' => 'col col-sm-3 control-label'
            ),
            'wrapInput' => 'col col-sm-7',
            'class' => 'form-control'
        ),
        'class' => 'form-inline well',
        'id' => 'edit_form'
    ));
    ?> 
    <fieldset>
        <?php
        //echo $this->Form->input('user_id');
        //echo $this->Form->input('course_id');
        echo $this->Form->input('lecture_hours',array('label'=>'Số tiết'));
        echo $this->Form->input('id');
        ?>
    </fieldset>
    <?php echo $this->Form->end('Lưu'); ?>
</div>
<script>
    $(function() {
        $('#edit_form').on('submit', function(e) {
            e.preventDefault(); // prevent native submit
            $(this).ajaxSubmit({
                url: '<?php echo SUB_DIR; ?>/assistant_teachers/updateLectureHours/<?php echo $this->Form->value('AssistantTeacher.id');?>.json',
                success: response
            });
            return false;
        });
    });

// post-submit callback 
    function response(responseText, statusText, xhr, $form) {
        if (responseText.response.status) {
            $('#lecture_hours_'+responseText.response.id).html(responseText.response.name);
            $.fancybox.close();
        } else {
            $('#message').html(responseText.response.message);
        }
        return true;
    }
</script>
