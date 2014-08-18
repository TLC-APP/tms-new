<?php
echo $this->element('Common/tinymce');
$this->Html->addCrumb('Lĩnh vực', '/fields');
$this->Html->addCrumb('Thêm lĩnh vực');
?>
<div class="fields form">
    <?php
    echo $this->Form->create('Field', array(
        'inputDefaults' => array(
            'div' => 'form-group',
            'wrapInput' => false,
            'class' => 'form-control'
        ),
        'class' => 'well'
    ));
    ?>
    <fieldset>
        <legend>Thêm lĩnh vực mới</legend>
        <?php
        echo $this->Form->input('name', array('label' => 'Tên lĩnh vực'));
        echo $this->Form->input('manage_user_id', array('label' => 'Người quản lý'));
        echo $this->Form->input('certificated_number_suffix', array('label' => 'Đuôi số chứng chỉ'));
        echo $this->Form->input('current_certificate_number', array('label' => 'Chỉ số chứng chỉ hiện tại'));
        echo $this->Form->input('decription', array('label' => 'Miêu tả'));
        ?>
    </fieldset>
    <?php echo $this->Form->button('Lưu', array('type' => 'submit', 'class' => 'btn btn-primary')) ?>
    <?php echo $this->Form->end(); ?>
</div>
<script>
    $(document).ready(function() {
        $("#FieldManageUserId").select2();

    });
</script>