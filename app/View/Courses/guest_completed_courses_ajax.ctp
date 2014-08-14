<?php $this->Js->JqueryEngine->jQueryObject = 'jQuery'; ?>
<?php
$before = "$('#datarows').parent().append('<div class=" . '"overlay"></div>' . "<div class=" . '"loading-img"></div>' . "');";
$complete = "$('.overlay').remove();$('.loading-img').remove();";
$this->Paginator->options(array(
    'url' => array('controller' => 'Courses', 'action' => 'completeCourses', 'guest' => true),
    'update' => '#datarows',
    'evalScripts' => true,
    'data' => http_build_query($this->request->data),
    'method' => 'POST',
    'before' => $before,
    'complete' => $complete
));
?>
<div class="row page-row">

    <?php if (!empty($courses)): ?>
        <?php foreach ($courses as $course): ?>
            <?php $output = preg_match_all('/<img[^>]+src=[\'"]([^\'"]+)[\'"][^>]*>/i', $course['Course']['decription'], $matches); ?>

            <div class="col-md-4 col-sm-4 col-xs-12 text-center">
                <div class="album-cover">
                    <?php echo $this->Html->link($this->Html->image($matches[1][0], array('class' => 'img-responsive', 'alt' => '')), array('guest' => true, 'controller' => 'courses', 'action' => 'view', $course['Course']['id']), array('class' => 'add-button fancybox.ajax', 'escape' => false)) ?>

                    <div class="desc">
                        <h4><small><a href="#"><?php echo $course['Course']['name'] ?></a></small></h4>
                        <p></p>
                    </div>
                </div>
            </div>  
        <?php endforeach; ?>
    <?php endif; ?>

</div><!--//page-row-->
<div class="row"><?php
    echo $this->Paginator->pagination(array(
        'ul' => 'pagination'
    ));
    ?>
    <?php echo $this->Js->writeBuffer(); ?></div>

<script>
    $(function() {
        $("#CourseFieldId").select2();
        $("#CourseTeacherId").select2();
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
                        chapterbox.select2('destroy');
                        $.each(data, function(i, value) {
                            $.each(value, function(index, text) {
                                chapterbox.append($('<option>').text(text).attr('value', index));
                            });

                            chapterbox.select2();
                        });
                    });
        });

        $('#search_form').on('submit', function(e) {
            e.preventDefault(); // prevent native submit
            $('#datarows').parent().append('<div class="overlay"></div><div class="loading-img"></div>');
            $(this).ajaxSubmit({
                url: '<?php echo SUB_DIR; ?>/guest/courses/completeCourses',
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

    });

</script>