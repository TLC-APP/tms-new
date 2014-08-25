<section class="widget has-divider">
    <h3 class="title">Thông báo</h3>
    <div  class="scroll-able">
        <?php $courses_today = $this->requestAction(array('guest' => true, 'controller' => 'courses_rooms', 'action' => 'guest_lich_homnay')) ?>
        <?php
        foreach ($courses_today as $course_today):
            $start = new DateTime($course_today['CoursesRoom']['start']);
            $end = new DateTime($course_today['CoursesRoom']['end']);
            ?>    
            <div class="event-item">
                <p class="date-label">
                    <span class="month"><?php echo $start->format('M'); ?></span>
                    <span class="date-number"><?php echo $start->format('d'); ?></span>
                </p>
                <div class="details">
                    <h2 class="title"><?php echo $course_today['Course']['name'] ?></h2>
                    <p class="time"><i class="fa fa-clock-o"></i><?php echo $start->format('H:i') . ' - ' . $end->format('H:i'); ?></p>
                    <p class="location"><i class="fa fa-map-marker"></i><?php echo $course_today['Room']['name']; ?></p>                            
                </div><!--//details-->
            </div><!--event-item-->  
        <?php endforeach; ?>
        <?php
        if (AuthComponent::user('id')) {
            $messages = $this->requestAction(array('controller' => 'messages', 'action' => 'getLastMessage', 'guest'));
        } else {
            $messages = $this->requestAction(array('controller' => 'messages', 'action' => 'getLastMessage'));
        }
        ?>
        <?php if (!empty($messages)): ?>
            <?php foreach ($messages as $message): ?>
                <article class="news-item row">       
                    <figure class="thumb col-md-2">
                        <img alt="" src="assets/images/news/news-thumb-1.jpg">
                    </figure>
                    <div class="details col-md-10">
                        <h4 class="title">
                            <a href="<?php echo SUB_DIR; ?>/messages/xem_thong_bao/<?php echo $message['Message']['id'] ?>" class="add-button fancybox.ajax">
                                <?php echo $message['Message']['title'] ?><br/><span>
                                <?php
                                $date = new DateTime($message['Message']['created']);
                                echo $date->format('H:i:s, d-m-Y')
                                ?></span>
                            </a></h4>
                    </div>
                </article><!--//news-item-->
            <?php endforeach; ?>
        <?php endif; ?>
        <!--
                <article class="news-item row">       
            <figure class="thumb col-md-2">
                <img alt="" src="assets/images/news/news-thumb-1.jpg">
            </figure>
            <div class="details col-md-10">
                <h4 class="title"><a href="news-single.html">Morbi bibendum consectetuer vulputate sollicitudin</a></h4>
            </div>
        </article><!--//news-item-->        
    </div>

</section><!--//widget-->