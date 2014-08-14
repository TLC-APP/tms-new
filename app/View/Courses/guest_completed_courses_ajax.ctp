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