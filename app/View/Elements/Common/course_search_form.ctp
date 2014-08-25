<?php
echo $this->element('Common/ajax_pagination_options', array('update' => '#datarows'));
echo $this->Html->script('jquery.form');
?>

<?php
echo $this->Form->create('Course', array(
    'inputDefaults' => array(
        'div' => 'form-group',
        'label' => false,
        'wrapInput' => false,
        'class' => 'form-control'
    ),
    'url' => array('action' => 'index', $status),
    'class' => 'form-inline ajax',
    'id' => 'search_form'
));
?>
<fieldset>
    <?php
    echo $this->Form->input('name', array('placeholder' => 'Tên khóa...', 'required' => false));
    echo $this->Form->input('field_id', array('empty' => '-- Lĩnh vực --'));
    echo $this->Form->input('chapter_id', array('empty' => '-- Chuyên đề --', 'required' => false));
    echo $this->Form->input('teacher_id', array('empty' => '-- Tập huấn bởi --'));
    echo $this->Form->input('is_published', array('empty' => '-- Xuất bản --', 'required' => false, 'options' => array('1' => 'Có', '0' => 'Không')));
    echo $this->Form->submit('Lọc', array('div' => 'form-group', 'class' => "btn btn-info"));
    ?>
</fieldset>

<?php echo $this->Form->end(); ?>
<script>
    $(function() {
        $('#search_form').on('submit', function(e) {
            e.preventDefault(); // prevent native submit
            $('#datarows').parent().parent().append('<div class="overlay"></div><div class="loading-img"></div>');
            $(this).ajaxSubmit({
                success: response
            });
            return false;
        });
// post-submit callback 
        function response(responseText, statusText, xhr, $form) {

            $('.overlay').remove();
            $('.loading-img').remove();

            $('#datarows').html(responseText);
            return true;
        }
        var fieldbox = $('#CourseFieldId');
        var chapterbox = $('#CourseChapterId');
        fieldbox.change(function() {
            var field_id = (this.value);
            $.ajax({
                url: "<?php echo SUB_DIR; ?>/chapters/fill_selectbox/" + field_id + ".json"
            })
                    .done(function(data) {
                        chapterbox.empty();
                        chapterbox.append($('<option>').text('-- Chuyên đề --').attr('value', ''));
                        $.each(data, function(i, value) {
                            $.each(value, function(index, text) {
                                chapterbox.append($('<option>').text(text).attr('value', index));
                            });

                        });
                    });
        });
    });

</script>