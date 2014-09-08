<?php
echo $this->element('Common/tinymce');
$this->Html->addCrumb('Khóa học đăng đăng ký', '/chapters/index/1');
$this->Html->addCrumb('Sửa khóa học ' . $this->Form->value('name'));
?>
<?php
echo $this->Form->create('Course', array(
    'type' => 'file',
    'inputDefaults' => array(
        'div' => 'form-group',
        'wrapInput' => false,
        'class' => 'form-control'
    )
));
?>
<div class="box box-solid box-success">
    <div class="box-header">
        <h3 class="box-title">Thêm Khóa học mới</h3>
        <div class="box-tools pull-right">
            <?php echo $this->Html->link('Back', array('action' => 'index', 1), array('type' => 'button', 'class' => 'btn btn-warning')) ?>
            <?php echo $this->Form->button('Lưu', array('type' => 'submit', 'class' => 'btn btn-info')) ?>
        </div>
    </div><!-- /.box-header -->
    <div class="box-body">
        <div class="box-group" id="accordion">
            <div class="panel box box-primary">
                <div class="box-header">
                    <h4 class="box-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#thong_tin">
                            Thông tin khóa học
                        </a>
                    </h4>
                </div>
                <div id="thong_tin" class="panel-collapse collapse in">
                    <div class="box-body">
                        <?php
                        echo $this->Form->input('id');
                        echo $this->Form->input('name', array('label' => 'Tên khóa'));
                        echo $this->Form->input('is_published', array('label' => 'Xuất bản', 'options' => array('1' => 'Có', '0' => 'Không')));
                        echo $this->Form->input('chung_chi_co_so', array('label' => 'Chứng nhận có số', 'options' => array('1' => 'Có', '0' => 'Không')));
                        echo $this->Form->input('enrolling_expiry_date', array('label' => 'Ngày hết hạn đăng ký: ', 'class' => 'input datetime', 'dateFormat' => 'DMY', 'monthNames' => false));

                        echo $this->Form->input('chapter_id', array('label' => 'Chủ đề'));
                        echo $this->Form->input('max_enroll_number', array('label' => 'Số người tối đa'));
                        ?>
                    </div>
                </div>
            </div>
            <div class="panel box box-danger">
                <div class="box-header">
                    <h4 class="box-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#noi_dung">
                            Nội dung
                        </a>
                    </h4>
                </div>
                <div id="noi_dung" class="panel-collapse collapse">
                    <div class="box-body">
                        <?php
                        echo $this->Form->input('decription', array('label' => 'Miêu tả'));
                        ?>
                    </div>
                </div>
            </div>
            <div class="panel box box-success">
                <div class="box-header">
                    <h4 class="box-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#tro_giang">
                            Tập huấn viên - Trợ giảng
                        </a>
                    </h4>
                </div>
                <div id="tro_giang" class="panel-collapse collapse">
                    <div class="box-body">
                        <?php
                        echo $this->Form->input('teacher_id', array('label' => 'Tập huấn bởi'));
                        echo $this->Form->input('AssistantTeacher.0.user_id', array('empty' => 'Chọn', 'label' => 'Trợ giảng 1', 'options' => $teachers, 'required' => false));
                        echo $this->Form->input('AssistantTeacher.0.lecture_hours', array('label' => 'Số tiết TG 1', 'required' => false));
                        echo $this->Form->input('AssistantTeacher.1.user_id', array('empty' => 'Chọn', 'label' => 'Trợ giảng 2', 'options' => $teachers, 'required' => false));
                        echo $this->Form->input('AssistantTeacher.1.lecture_hours', array('label' => 'Số tiết TG 2', 'required' => false));
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="box-footer">
        <?php echo $this->Form->end(); ?>
    </div>
</div>

<script>
    $(document).ready(function() {
        $("#CourseChapterId").select2();
        $("#CourseTeacherId").select2();
    });
</script>
