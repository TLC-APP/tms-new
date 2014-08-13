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
                <a class="flex-prev" href="http://giaodien.local/college-green/#">Previous</a></li><li><a class="flex-next" href="http://giaodien.local/college-green/#">Next</a></li></ul></div><!--//flexslider-->
    <!--//promo-->
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
                        <div class="col-md-4 news-item">
                            <h2 class="title"><a href="news-single.html">Phasellus scelerisque metus</a></h2>
                            <img class="thumb" src="assets/images/news/news-thumb-1.jpg" alt="">
                            <p>Suspendisse purus felis, porttitor quis sollicitudin sit amet, elementum et tortor. Praesent lacinia magna in malesuada vestibulum. Pellentesque urna libero.</p>
                            <a class="read-more" href="news-single.html">Read more<i class="fa fa-chevron-right"></i></a>                
                        </div><!--//news-item-->
                        <div class="col-md-4 news-item">
                            <h2 class="title"><a href="news-single.html">Morbi at vestibulum turpis</a></h2>
                            <p>Nam feugiat erat vel neque mollis, non vulputate erat aliquet. Maecenas ac leo porttitor, semper risus condimentum, cursus elit. Vivamus vitae libero tellus.</p>
                            <a class="read-more" href="news-single.html">Read more<i class="fa fa-chevron-right"></i></a>
                            <img class="thumb" src="assets/images/news/news-thumb-2.jpg" alt="">
                        </div><!--//news-item-->
                        <div class="col-md-4 news-item">
                            <h2 class="title"><a href="news-single.html">Aliquam id iaculis urna</a></h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam bibendum mauris eget sapien consectetur pellentesque. Proin elementum tristique euismod. </p>
                            <a class="read-more" href="news-single.html">Read more<i class="fa fa-chevron-right"></i></a>
                            <img class="thumb" src="assets/images/news/news-thumb-3.jpg" alt="">
                        </div><!--//news-item-->
                    </div><!--//item-->
                    <div class="item"> 
                        <div class="col-md-4 news-item">
                            <h2 class="title"><a href="news-single.html">Phasellus scelerisque metus</a></h2>
                            <img class="thumb" src="assets/images/news/news-thumb-4.jpg" alt="">
                            <p>Suspendisse purus felis, porttitor quis sollicitudin sit amet, elementum et tortor. Praesent lacinia magna in malesuada vestibulum. Pellentesque urna libero.</p>
                            <a class="read-more" href="news-single.html">Read more<i class="fa fa-chevron-right"></i></a>                
                        </div><!--//news-item-->
                        <div class="col-md-4 news-item">
                            <h2 class="title"><a href="news-single.html">Morbi at vestibulum turpis</a></h2>
                            <p>Nam feugiat erat vel neque mollis, non vulputate erat aliquet. Maecenas ac leo porttitor, semper risus condimentum, cursus elit. Vivamus vitae libero tellus.</p>
                            <a class="read-more" href="news-single.html">Read more<i class="fa fa-chevron-right"></i></a>
                            <img class="thumb" src="assets/images/news/news-thumb-5.jpg" alt="">
                        </div><!--//news-item-->
                        <div class="col-md-4 news-item">
                            <h2 class="title"><a href="news-single.html">Aliquam id iaculis urna</a></h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam bibendum mauris eget sapien consectetur pellentesque. Proin elementum tristique euismod. </p>
                            <a class="read-more" href="news-single.html">Read more<i class="fa fa-chevron-right"></i></a>
                            <img class="thumb" src="assets/images/news/news-thumb-6.jpg" alt="">
                        </div><!--//news-item-->
                    </div><!--//item-->
                </div><!--//carousel-inner-->
            </div><!--//news-carousel-->  
        </div><!--//section-content-->     
    </section>
    <?php $courses_today = $this->requestAction(array('guest' => true, 'controller' => 'courses_rooms', 'action' => 'guest_lich_homnay')) ?>
    <div class="row cols-wrapper">
        <div class="col-md-3">
            <section class="events">
                <h1 class="section-heading text-highlight"><span class="line">Lịch học</span></h1>
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
                                <p class="time"><i class="fa fa-clock-o"></i><?php echo $start->format('H:i') . ' - ' . $end->format('H:i'); ?>10:00am - 18:00pm</p>
                                <p class="location"><i class="fa fa-map-marker"></i><?php echo $course_today['Room']['name']; ?></p>                            
                            </div><!--//details-->
                        </div><!--event-item-->  
                    <?php endforeach; ?>
                </div><!--//section-content-->
            </section><!--//events-->
        </div><!--//col-md-3-->
        <div class="col-md-9">
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
                                'id' => 'thong_ke_form'
                            ));
                            ?>
                            <fieldset>
                                <?php
                                echo $this->Form->input('field_id', array('empty' => '-- Lĩnh vực --'));
                                echo $this->Form->input('chapter_id', array('empty' => '-- Chuyên đề --', 'required' => false));

                                echo $this->Form->input('teacher_id', array('empty' => '-- Tập huấn bởi --'));
                                //echo $this->Form->input('begin', array('label' => 'Từ ', 'type' => 'date', 'dateFormat' => 'DMY', 'monthNames' => false, 'empty' => true, 'minYear' => 2010));
                                //echo $this->Form->input('end', array('label' => 'Đến ', 'type' => 'date', 'dateFormat' => 'DMY', 'monthNames' => false, 'empty' => true, 'minYear' => 2010));
                                ?>
                                <div class="form-group ">
                                    <div class="keywords">                
                                        <input type="text" name="data[khoang_thoi_gian]" placeholder="Từ - đến..."class=" form-control pull-left" id="reservation"/>

                                    </div><!-- /.input group -->
                                </div>
                                <button type="submit" class="btn btn-theme"><i class="fa fa-search"></i></button>

                            </fieldset>

                            <?php echo $this->Form->end(); ?>
                        </div>
                        <div class="page-row">

                        </div>
                        <div class="row page-row">
                            <div class="col-md-6 col-sm-6 col-xs-12 text-center">
                                <div class="album-cover">
                                    <a href="gallery-album.html" tppabs="http://themes.3rdwavemedia.com/college-green/gallery-album.html"><img class="img-responsive" src="assets/images/gallery/gallery-thumb-1.jpg" tppabs="http://themes.3rdwavemedia.com/college-green/assets/images/gallery/gallery-thumb-1.jpg" alt=""></a>
                                    <div class="desc">
                                        <h4><small><a href="#">Album Lorem Ipsum</a></small></h4>
                                        <p>Integer ornare nisl tortor, sed condimentum metus pulvinar ut. Etiam ac pretium nunc. Donec porttitor erat non nibh pellentesque vehicula. Vestibulum tincidunt</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12 text-center">
                                <div class="album-cover">
                                    <a href="gallery-album.html" tppabs="http://themes.3rdwavemedia.com/college-green/gallery-album.html"><img class="img-responsive" src="assets/images/gallery/gallery-thumb-2.jpg" tppabs="http://themes.3rdwavemedia.com/college-green/assets/images/gallery/gallery-thumb-2.jpg" alt=""></a>
                                    <div class="desc">
                                        <h4><small><a href="#">Album Ornare</a></small></h4>
                                        <p>Aenean dictum urna nec ligula consectetur, id ornare leo tincidunt. Praesent ut tempor nibh. Sed eleifend, elit at ornare pretium, lorem mauris convallis arcu</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12 text-center">
                                <div class="album-cover">
                                    <a href="gallery-album.html" tppabs="http://themes.3rdwavemedia.com/college-green/gallery-album.html"><img class="img-responsive" src="assets/images/gallery/gallery-thumb-3.jpg" tppabs="http://themes.3rdwavemedia.com/college-green/assets/images/gallery/gallery-thumb-3.jpg" alt=""></a>
                                    <div class="desc">
                                        <h4><small><a href="#">Album Suspendisse</a></small></h4>
                                        <p>Suspendisse at purus ac neque auctor viverra vel in arcu. Quisque commodo augue nisi, ut ultrices odio suscipit et. Quisque interdum massa sem</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12 text-center">
                                <div class="album-cover">
                                    <a href="gallery-album.html" tppabs="http://themes.3rdwavemedia.com/college-green/gallery-album.html"><img class="img-responsive" src="assets/images/gallery/gallery-thumb-4.jpg" tppabs="http://themes.3rdwavemedia.com/college-green/assets/images/gallery/gallery-thumb-4.jpg" alt=""></a>
                                    <div class="desc">
                                        <h4><small><a href="#">Album Suspendisse</a></small></h4>
                                        <p>Suspendisse at purus ac neque auctor viverra vel in arcu. Quisque commodo augue nisi, ut ultrices odio suscipit et. Quisque interdum massa sem</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12 text-center">
                                <div class="album-cover">
                                    <a href="gallery-album.html" tppabs="http://themes.3rdwavemedia.com/college-green/gallery-album.html"><img class="img-responsive" src="assets/images/gallery/gallery-thumb-5.jpg" tppabs="http://themes.3rdwavemedia.com/college-green/assets/images/gallery/gallery-thumb-5.jpg" alt=""></a>
                                    <div class="desc">
                                        <h4><small><a href="#">Album Suspendisse</a></small></h4>
                                        <p>Suspendisse at purus ac neque auctor viverra vel in arcu. Quisque commodo augue nisi, ut ultrices odio suscipit et. Quisque interdum massa sem</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12 text-center">
                                <div class="album-cover">
                                    <a href="gallery-album.html" tppabs="http://themes.3rdwavemedia.com/college-green/gallery-album.html"><img class="img-responsive" src="assets/images/gallery/gallery-thumb-6.jpg" tppabs="http://themes.3rdwavemedia.com/college-green/assets/images/gallery/gallery-thumb-6.jpg" alt=""></a>
                                    <div class="desc">
                                        <h4><small><a href="#">Album Suspendisse</a></small></h4>
                                        <p>Suspendisse at purus ac neque auctor viverra vel in arcu. Quisque commodo augue nisi, ut ultrices odio suscipit et. Quisque interdum massa sem</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12 text-center">
                                <div class="album-cover">
                                    <a href="gallery-album.html" tppabs="http://themes.3rdwavemedia.com/college-green/gallery-album.html"><img class="img-responsive" src="assets/images/gallery/gallery-thumb-7.jpg" tppabs="http://themes.3rdwavemedia.com/college-green/assets/images/gallery/gallery-thumb-7.jpg" alt=""></a>
                                    <div class="desc">
                                        <h4><small><a href="#">Album Suspendisse</a></small></h4>
                                        <p>Suspendisse at purus ac neque auctor viverra vel in arcu. Quisque commodo augue nisi, ut ultrices odio suscipit et. Quisque interdum massa sem</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12 text-center">
                                <div class="album-cover">
                                    <a href="gallery-album.html" tppabs="http://themes.3rdwavemedia.com/college-green/gallery-album.html"><img class="img-responsive" src="assets/images/gallery/gallery-thumb-8.jpg" tppabs="http://themes.3rdwavemedia.com/college-green/assets/images/gallery/gallery-thumb-8.jpg" alt=""></a>
                                    <div class="desc">
                                        <h4><small><a href="#">Album Suspendisse</a></small></h4>
                                        <p>Suspendisse at purus ac neque auctor viverra vel in arcu. Quisque commodo augue nisi, ut ultrices odio suscipit et. Quisque interdum massa sem</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12 text-center">
                                <div class="album-cover">
                                    <a href="gallery-album.html" tppabs="http://themes.3rdwavemedia.com/college-green/gallery-album.html"><img class="img-responsive" src="assets/images/gallery/gallery-thumb-9.jpg" tppabs="http://themes.3rdwavemedia.com/college-green/assets/images/gallery/gallery-thumb-9.jpg" alt=""></a>
                                    <div class="desc">
                                        <h4><small><a href="#">Album Suspendisse</a></small></h4>
                                        <p>Suspendisse at purus ac neque auctor viverra vel in arcu. Quisque commodo augue nisi, ut ultrices odio suscipit et. Quisque interdum massa sem</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12 text-center">
                                <div class="album-cover">
                                    <a href="gallery-album.html" tppabs="http://themes.3rdwavemedia.com/college-green/gallery-album.html"><img class="img-responsive" src="assets/images/gallery/gallery-thumb-10.jpg" tppabs="http://themes.3rdwavemedia.com/college-green/assets/images/gallery/gallery-thumb-10.jpg" alt=""></a>
                                    <div class="desc">
                                        <h4><small><a href="#">Album Suspendisse</a></small></h4>
                                        <p>Suspendisse at purus ac neque auctor viverra vel in arcu. Quisque commodo augue nisi, ut ultrices odio suscipit et. Quisque interdum massa sem</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12 text-center">
                                <div class="album-cover">
                                    <a href="gallery-album.html" tppabs="http://themes.3rdwavemedia.com/college-green/gallery-album.html"><img class="img-responsive" src="assets/images/gallery/gallery-thumb-11.jpg" tppabs="http://themes.3rdwavemedia.com/college-green/assets/images/gallery/gallery-thumb-11.jpg" alt=""></a>
                                    <div class="desc">
                                        <h4><small><a href="#">Album Suspendisse</a></small></h4>
                                        <p>Suspendisse at purus ac neque auctor viverra vel in arcu. Quisque commodo augue nisi, ut ultrices odio suscipit et. Quisque interdum massa sem</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12 text-center">
                                <div class="album-cover">
                                    <a href="gallery-album.html" tppabs="http://themes.3rdwavemedia.com/college-green/gallery-album.html"><img class="img-responsive" src="assets/images/gallery/gallery-thumb-12.jpg" tppabs="http://themes.3rdwavemedia.com/college-green/assets/images/gallery/gallery-thumb-12.jpg" alt=""></a>
                                    <div class="desc">
                                        <h4><small><a href="#">Album Suspendisse</a></small></h4>
                                        <p>Suspendisse at purus ac neque auctor viverra vel in arcu. Quisque commodo augue nisi, ut ultrices odio suscipit et. Quisque interdum massa sem</p>
                                    </div>
                                </div>
                            </div>                              
                        </div><!--//page-row-->
                    </div>
                    <a class="read-more" href="http://giaodien.local/college-green/courses.html">View all our courses<i class="fa fa-chevron-right"></i></a>
                </div><!--//section-content-->
            </section><!--//course-finder-->

        </div>
        <!--//col-md-3-->
    </div><!--//cols-wrapper-->

</div>
<?php echo $this->Html->script('/user/plugins/flexslider/jquery.flexslider-min') ?>
<?php echo $this->Html->script('/user/plugins/pretty-photo/js/jquery.prettyPhoto') ?>
<?php echo $this->Html->script('/user/plugins/jflickrfeed/jflickrfeed.min') ?>
<?php
echo $this->Html->script('main');
