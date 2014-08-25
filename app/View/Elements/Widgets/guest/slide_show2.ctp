<?php $courses = $this->requestAction(array('guest' => true, 'controller' => 'courses', 'action' => 'cothedangki')) ?>
<div id="promo-slider" class="slider flexslider">
    <ul class="slides">
        <?php foreach ($courses as $course): ?>
            <?php $output = preg_match_all('/<img[^>]+src=[\'"]([^\'"]+)[\'"][^>]*>/i', $course['Course']['decription'], $matches); ?>
            <li class="flex-active-slide" style="width: 100%; float: left; margin-right: -100%; position: relative; display: list-item;">
                <?php echo (!empty($matches[1][0])) ? $this->Html->image($matches[1][0]) : $this->Html->image('training_default.jpg'); ?>
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
            <a class="flex-prev" href="#">Previous</a></li><li><a class="flex-next" href="#">Next</a></li>
    </ul>
</div><!--//flexslider-->