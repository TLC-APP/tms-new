<div class="content container">
    <?php $courses = $this->requestAction(array('guest' => true, 'controller' => 'courses', 'action' => 'cothedangki')) ?>
    <div id="promo-slider" class="slider flexslider">
        <ul class="slides">
            <?php foreach ($courses as $course): ?>
                <?php $output = preg_match_all('/<img[^>]+src=[\'"]([^\'"]+)[\'"][^>]*>/i', $course['Course']['decription'], $matches); ?>
                <li class="flex-active-slide" style="width: 100%; float: left; margin-right: -100%; position: relative; display: list-item;">
                    <?php echo $this->Html->image($matches[1][0]); ?>
                    <p class="flex-caption">
                        <span class="main"><?php
                            $teacher = '';
                            if (!empty($course['Teacher']['HocHam']))
                                $teacher.=$course['Teacher']['HocHam']['name'];
                            if (!empty($course['Teacher']['HocHam']) && !empty($course['Teacher']['HocVi'])) {
                                $teacher.=' ' . $course['Teacher']['HocVi']['name'];
                            } else {
                                if (!empty($course['Teacher']['HocVi']))
                                    $teacher.=$course['Teacher']['HocVi']['name'];
                            }
                            $teacher.=' ' . $course['Teacher']['name'];

                            echo $course['Course']['name'] . ' - ' . $teacher;
                            ?></span>
                        <br>
                        <span class="secondary clearfix">
                            <?php
                            echo $this->Text->truncate(strip_tags($course['Course']['decription']), 450, array(
                                'ellipsis' => '...',
                                'exact' => false,
                                'html' => false
                            ));
                            ?>

                            <?php echo $this->Html->link('xem chi tiết và tham gia', array('guest' => true, 'controller' => 'courses', 'action' => 'view', $course['Course']['id']), array('class' => 'add-button fancybox.ajax btn btn-large btn-warning')) ?>
                    </p>
                </li>
            <?php endforeach; ?>
        </ul><!--//slides-->
        <ul class="flex-direction-nav">
            <li>
                <a class="flex-prev" href="#">Previous</a></li><li><a class="flex-next" href="#">Next</a></li></ul></div><!--//flexslider-->
    <!--//promo-->
    <!--//Đang mở-->
    <?php echo $this->element('Widgets/guest/uncompleted_courses'); ?>
    <div class="row cols-wrapper">
        <div class="col-md-3">
            <?php echo $this->element('Widgets/guest/courses_today'); ?>
        </div><!--//col-md-3-->
        <div class="col-md-9">
            <?php echo $this->element('Widgets/guest/completed_courses'); ?>

        </div>
        <!--//col-md-3-->
    </div><!--//cols-wrapper-->

</div>
<?php echo $this->Html->script('/user/plugins/flexslider/jquery.flexslider-min') ?>
<?php echo $this->Html->script('/user/plugins/pretty-photo/js/jquery.prettyPhoto') ?>
<?php echo $this->Html->script('/user/plugins/jflickrfeed/jflickrfeed.min') ?>
<?php
echo $this->Html->script('main');
?>
<script>

    $(function() {
        $("#CourseFieldId").select2();
        $("#CourseChapterId").select2();
        $("#CourseTeacherId").select2();
        //Date range picker
        $('#reservation').daterangepicker(
                {
                    showDropdowns: true,
                    format: 'YYYY/MM/DD'
                });
        var fieldbox = $('#CourseFieldId');
        var chapterbox = $('#CourseChapterId');
        fieldbox.change(function() {
            var field_id = (this.value);
            $.ajax({
                url: "<?php echo SUB_DIR; ?>/chapters/fill_selectbox/" + field_id + ".json"
            })
                    .done(function(data) {
                        chapterbox.empty();
                        $.each(data, function(i, value) {
                            $.each(value, function(index, text) {
                                chapterbox.append($('<option>').text(text).attr('value', index));
                            });

                        });
                    });
        });
        $('#search_form').on('submit', function(e) {

            e.preventDefault(); // prevent native submit
            $('#ket_qua').parent().append('<div class="overlay"></div><div class="loading-img"></div>');
            $(this).ajaxSubmit({
                url: '<?php echo SUB_DIR; ?>/manager/courses/thong_ke',
                success: response
            });
            return false;
        });
// post-submit callback 
        function response(responseText, statusText, xhr, $form) {

            $('.overlay').remove();
            $('.loading-img').remove();

            $('#ket_qua').html(responseText);
            return true;
        }
    });
</script>