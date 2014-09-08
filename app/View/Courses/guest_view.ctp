<div class="col-lg-12 content-right" style="margin-top:-40px">
    <div class="row">
        <h3 class="page-header" style=" font-family: arial">Khóa học: <?php echo $course['Course']['name'] . ' '; ?>                
            <?php if ($course['Course']['status'] == COURSE_REGISTERING): ?>
                <a href="<?php echo SUB_DIR ?>/attends/register/<?php echo $course['Course']['id'] ?>"><button class="btn btn-success">Đăng ký</button></a>
            <?php endif; ?>    
        </h3>
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li ><a data-toggle="tab" href="#lich_hoc">Lịch học</a></li>
                    <li class=""><a data-toggle="tab" href="#thong_tin">Thông tin</a></li>
                    <li class="active"><a data-toggle="tab" href="#noi_dung">Nội dung</a></li>
                </ul>
                <div class="tab-content">
                    <div id="noi_dung" class="tab-pane active">
                        <div class="noi_dung" >
                            <p><?php echo $course['Course']['decription']; ?></p>
                        </div>
                    </div><!-- /.tab-pane -->
                    <div id="thong_tin" class="tab-pane">
                        <table class="table table-condensed">
                            <tbody style="font-size: 15px;">
                                                               ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Chuyên đề</td>
                                    <td>                 
                                        <strong><?php echo $course['Chapter']['name'] ?></strong> 
                                    </td>
                                </tr>
                                <tr>
                                    <td>Lĩnh vực</td>
                                    <td>                 
                                        <?php echo $course['Chapter']['Field']['name']; ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div><!-- /.tab-pane -->
                    <div id="lich_hoc" class="tab-pane">
                        <div class="row">
                            <div class="col-md-12">

                                <div class="well">
                                    <div class="row">
                                        <div class="col-sm-12">

                                            <div class="table-responsive">
                                                <table class="table table-hover table-condensed">
                                                    <thead>
                                                        <tr><th>STT</th><th>Tên</th><th>Bắt đầu</th><th>Địa điểm</th></tr>
                                                    </thead>
                                                    <tbody>

                                                        <?php
                                                        $stt = 0;
                                                        foreach ($course['CoursesRoom'] as $buoi):
                                                            ?>
                                                            <tr>
                                                                <td><?php echo ++$stt; ?></td>
                                                                <td><?php echo $buoi['title']; ?></td>
                                                                <td><?php
                                                                    $start = new DateTime($buoi['start']);
                                                                    echo $start->format('H:i');
                                                                    echo", ngày: ";
                                                                    echo $start->format('d/m/Y');
                                                                    ?>
                                                                </td>
                                                                <td><?php echo $buoi['room']; ?></td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div> 
                    </div>
                </div><!-- /.tab-content -->
            </div>
            <div class="pull-right">
                <?php if ($course['Course']['status'] == COURSE_REGISTERING): ?>
                    <a href="<?php echo SUB_DIR ?>/attends/register/<?php echo $course['Course']['id'] ?>"><button class="btn btn-success">Đăng ký</button></a>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <hr>
</div>


