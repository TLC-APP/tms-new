<!--slideshow-->
<?php $courses = $this->requestAction(array('guest' => true, 'controller' => 'courses', 'action' => 'cothedangki')) ?>
<div class="box box-solid">
    <div class="box-body">
        <div data-ride="carousel" class="carousel slide" id="carousel-example-generic">
            <ol class="carousel-indicators">
                <?php
                $i = 0;
                $n = count($courses);
                while ($i < $n):
                    ?>
                    <li class="<?php if ($i == 1) echo 'active'; ?>" data-slide-to="<?php
                    echo $i;
                    $i++;
                    ?>" data-target="#carousel-example-generic"></li>
                    <?php endwhile; ?>

            </ol>
            <div class="carousel-inner">
                <?php
                $i = 0;
                foreach ($courses as $course):
                    ?>
                    <?php
                    $output = preg_match_all('/<img[^>]+src=[\'"]([^\'"]+)[\'"][^>]*>/i', $course['Course']['decription'], $matches);
                    ?>
                    <div class="item <?php if (++$i == 1) echo 'active'; ?>">
                        <div style="background:url(<?php echo (!empty($matches[1][0])) ? $matches[1][0] : $this->Html->url('/', true) . 'img/training_default.jpg'; ?>) center center; 
                             background-size:cover;" class="slider-size">
                            <div class="carousel-caption">
                                <h2 class="main"><?php
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
                    ?> 
                                </h2>
                                <p class="secondary clearfix"><?php
                                echo $this->Text->truncate(strip_tags($course['Course']['decription']), 450, array(
                                    'ellipsis' => '...',
                                    'exact' => false,
                                    'html' => false
                                ));
                                echo $this->Html->link('xem chi tiết và tham gia', array('guest' => true, 'controller' => 'courses', 'action' => 'view', $course['Course']['id']), array('class' => 'add-button fancybox.ajax btn btn-large btn-warning'))
                    ?> </p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
            <!-- Controls -->
            <a class="left carousel-control" href="javascript:void(0)" 
               data-slide="prev" data-target="#carousel-example-generic">
                <span class="glyphicon glyphicon-chevron-left"></span>
            </a>
            <a class="right carousel-control" href="javascript:void(0)" 
               data-slide="next" data-target="#carousel-example-generic">
                <span class="glyphicon glyphicon-chevron-right"></span>
            </a>
        </div>
    </div><!-- /.box-body -->
</div>
<!--end slideshow -->
<style>
    .slider-size {
        height: 400px; /* This is your slider height */
    }
    .carousel {
        width:100%; 
        margin:0 auto; /* center your carousel if other than 100% */ 
    }
    .scroll-able {
        max-height:376px;
        min-height:376px;
        overflow-y:auto;  
    }

    .carousel-caption {
        position: absolute;
        right: 10%;
        bottom: 5px;
        left: 10%;
        z-index: 10;
        padding-top: 20px;
        padding-bottom: 5px;
        color: #ffffff;
        text-align: left;
        text-shadow: 0 1px 2px rgba(0, 0, 0, 0.6);
    }

    .carousel-indicators {
        bottom: -14px;
        float: right;
        list-style: none outside none;
        margin-left: -30%;
        padding-left: 0;
        position: absolute;
        text-align: center;
        width: 60%;
        z-index: 15;
    }
    .carousel-indicators li {
        background-color: rgba(0, 0, 0, 0);
        border: 1px solid #fff;
        border-radius: 10px;
        cursor: pointer;
        display: inline-block;
        height: 10px;
        margin: 1px;
        text-indent: -999px;
        width: 10px;
    }
    .carousel-indicators .active {
        background-color: #fff;
        height: 12px;
        margin: 0;
        width: 12px;
    }

    .carousel .carousel-caption .secondary {
        background: none repeat scroll 0 0 rgba(0, 0, 0, 0.8);
        color: #fff;
        display: inline-block;
        font-size: 13px;
        padding: 5px 15px;
    }
    .carousel .carousel-caption .main {
        background: none repeat scroll 0 0 #6091ba;
        display: inline-block;
        font-size: 14px;
        margin-bottom: 5px;
        padding: 10px 15px;
        text-transform: uppercase;
    }
</style>