<?php
$unCompleteCourses = $this->requestAction(array('guest' => true, 'controller' => 'courses', 'action' => 'unCompleteCourses'));
if (!empty($unCompleteCourses)):
    $counter = 0;
    ?>
    <section class="news">
        <h1 class="section-heading text-highlight"><span class="line">Khóa đang mở</span></h1>     
        <div class="carousel-controls">
            <a class="prev" href="#news-carousel" data-slide="prev"><i class="fa fa-caret-left"></i></a>
            <a class="next" href="#news-carousel" data-slide="next"><i class="fa fa-caret-right"></i></a>
        </div><!--//carousel-controls--> 
        <div class="section-content clearfix">
            <div id="news-carousel" class="news-carousel carousel slide">
                <div class="carousel-inner">
                    <div class="item active"> 
                        <?php foreach ($unCompleteCourses as $course): $counter++; ?>
                            <?php if ($counter <= 3): ?>
                                <div class="col-md-4 news-item">
                                    <h2 class="title">                                            
                                        <?php echo $this->Html->link($course['Course']['name'] . ' - ' . $course['Teacher']['name'], array('guest' => true, 'controller' => 'courses', 'action' => 'view', $course['Course']['id']), array('class' => 'add-button fancybox.ajax', 'escape' => false)) ?>
                                    </h2>
                                    <?php $output = preg_match_all('/<img[^>]+src=[\'"]([^\'"]+)[\'"][^>]*>/i', $course['Course']['decription'], $matches); ?>
                                    <?php  echo $this->Html->link($this->Html->image($matches[1][0], array('class' => 'thumb', 'alt' => '', 'width' => 100, 'height' => '100')), array('guest' => true, 'controller' => 'courses', 'action' => 'view', $course['Course']['id']), array('class' => 'add-button fancybox.ajax', 'escape' => false)) ?>
                                    <p><?php
                                        /* echo $this->Text->truncate(strip_tags($course['Course']['decription']), 100, array(
                                          'ellipsis' => '...',
                                          'exact' => false,
                                          'html' => false
                                          )); */
                                        ?>
                                    </p>
                                               
                                </div><!--//news-item-->
                            <?php endif; ?>
                            <?php
                        endforeach;
                        $counter = 0;
                        ?>
                    </div><!--//item-->
                    <div class="item">
                        <?php foreach ($unCompleteCourses as $course): $counter++; ?>
                            <?php if ($counter > 3): ?>
                                <div class="col-md-4 news-item">
                                    <h2 class="title"><a href="#"><?php echo $course['Course']['name'] ?></a></h2>
                                    <?php $output = preg_match_all('/<img[^>]+src=[\'"]([^\'"]+)[\'"][^>]*>/i', $course['Course']['decription'], $matches); ?>
                                    <?php echo $this->Html->image($matches[1][0], array('class' => 'thumb', 'alt' => '')); ?>
                                    <p><?php
                                        echo $this->Text->truncate(strip_tags($course['Course']['decription']), 450, array(
                                            'ellipsis' => '...',
                                            'exact' => false,
                                            'html' => false
                                        ));
                                        ?></p>
                                    <a class="read-more" href="news-single.html">chi tiết<i class="fa fa-chevron-right"></i></a>                
                                </div><!--//news-item-->
                            <?php endif; ?>
                            <?php
                        endforeach;
                        ?>
                    </div><!--//item-->
                </div><!--//carousel-inner-->
            </div><!--//news-carousel-->  
        </div><!--//section-content-->     
    </section>
<?php endif; ?>