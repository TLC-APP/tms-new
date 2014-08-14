<?php
echo $this->Html->script('jquery.form');
?>
<?php $this->Js->JqueryEngine->jQueryObject = 'jQuery'; ?>
<?php
$before = "$('#datarows').parent().parent().append('<div class=" . '"overlay"></div>' . "<div class=" . '"loading-img"></div>' . "');";
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
<section class="course-finder">
    <h1 class="section-heading text-highlight"><span class="line">Khóa đã hoàn thành</span></h1>
    <div class="section-content">
        <div class="gallery-wrapper ">
            <div class="page-row">
                <?php
                echo $this->Form->create('Course', array(
                    'inputDefaults' => array(
                        'div' => 'form-group',
                        'label' => false,
                        'wrapInput' => false,
                        'class' => 'form-control'
                    ),
                    'url' => array('action' => 'thong_ke', 'manager' => true),
                    'class' => 'form-inline',
                    'id' => 'search_form'
                ));
                ?>
                <fieldset>
                    <?php
                    echo $this->Form->input('field_id', array('empty' => '-- Lĩnh vực --'));
                    echo $this->Form->input('chapter_id', array('empty' => '-- Chuyên đề --', 'required' => false));
                    echo $this->Form->input('teacher_id', array('empty' => '-- Tập huấn bởi --'));
                    ?>
                    <div class="form-group ">
                        <div class="keywords">                
                            <input type="text" name="data[khoang_thoi_gian]" placeholder="Từ - đến..."class=" col-xs-1 form-control pull-left" id="reservation"/>

                        </div><!-- /.input group -->
                    </div>
                    <button type="submit" class="btn btn-theme"><i class="fa fa-search"></i></button>

                </fieldset>

                <?php echo $this->Form->end(); ?>
            </div>
            <hr />
            <div class="clearfix"></div>
            <?php $completedCourses = $this->requestAction(array('guest' => true, 'controller' => 'courses', 'action' => 'guest_completeCourses')) ?>
            <?php
            $courses = $completedCourses['courses'];
            $paginator = $completedCourses['paginator'];
            $this->Paginator->request = $paginator;
            ?>
            <div id="datarows">
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
            </div>
        </div>

    </div><!--//section-content-->
</section><!--//course-finder-->