<?php $courses_today = $this->requestAction(array('guest' => true, 'controller' => 'courses_rooms', 'action' => 'guest_lich_homnay')) ?>
<section class="events">
    <h1 class="section-heading text-highlight"><span class="line">Sự kiện</span></h1>
    <div class="section-content">

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
                <div>

                    <div>
                        <a href="<?php echo SUB_DIR; ?>/messages/xem_thong_bao/<?php echo $message['Message']['id'] ?>" class="add-button fancybox.ajax"><?php echo $message['Message']['title'] ?>
                            <span class="badge"><?php
                                $date = new DateTime($message['Message']['created']);
                                echo $date->format('H:i:s, d-m-Y')
                                ?></span></a>                            
                    </div><!--//details-->
                </div><!--event-item-->  
            <?php endforeach; ?>
        <?php endif; ?>
    </div><!--//section-content-->
</section><!--//events-->