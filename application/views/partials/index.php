<div  class="col-sm-12 content-parent col-md-8 col-xs-12">
        <div class="content">
              <?php
                     $this->load->view('include/slider');
              ?>
                <div id="slider1" class="video-items without-text arrows shadow item">
                        <p class="title">
                                <i class="text-danger fa fa-star-o"></i> NEUESTE <strong>ANIME SERIEN</strong>
                        </p>
                        <a ng-click="preventRedirection($event)" href="#" class="btn-next pull-right arrow right " style="top:110px; right:-10px;">
                                <i class="glyphicon glyphicon-chevron-right"></i>
                        </a>
                        <a ng-click="preventRedirection($event)" href="#" class="btn-prev pull-left arrow left" style="top:110px; left:-10px;">
                                <i class="glyphicon glyphicon-chevron-left"></i>
                        </a>
                        <div class="videos">
                                <div owlcarousel="owlConfig" data-owl-next="#slider1 .btn-next" data-owl-prev="#slider1 .btn-prev" class="owl-carousel zoom multiple no-pagination top-space">
                                        <?php
                                        $slug='anime-series';
                                        $video_query = "select * from videos ";
                                        if(!empty($slug)) {
                                                $video_query .= "where category_id IN(select id from categories where slug='" . $slug . "')  order by id DESC LIMIT 10";
                                        }
                                        $query = $this->db->query($video_query);
                                        $series_videos = $query->result_array();

                                        if(sizeof($series_videos)>0) {
                                                foreach ($series_videos as $key => $field) {
                                                        $target_dir = dirname(dirname(dirname(dirname(__FILE__)))) . "/uploads/uploaded_videos/";
                                                        $target_file = $target_dir . basename($field['poster']);
                                                        //echo $target_file;exit;
                                                        if ($field['poster']=='' || !file_exists($target_file)) {
                                                                //echo $field['poster'];exit;
                                                                $field['poster'] = base_url()."assets/images/no-image-icon-6.jpg";
                                                        }
                                                        else{
                                                                $field['poster'] = base_url()."uploads/uploaded_videos/".$field['poster'];
                                                        }
                                                ?>
                                                <div>
                                                        <a href="<?php echo base_url() ?>#/videodetail/<?php echo $field['id'];?>">
                                                                <img class="onefiftytwosixtyone"  src="<?php echo $field['poster'];?>" alt="">
                                                        </a>
                                                </div>
                                                <?php
                                                }
                                        } ?>

                                </div>
                        </div>
                </div>
                <div id="slider2" class="video-items with-text arrows item">
                        <p class="title">
                                <i class="text-danger fa fa-star-o"></i> NEUESTE <strong>ANIME FOLGEN</strong>
                        </p>
                        <a ng-click="preventRedirection($event)" href="#" class="btn-next pull-right arrow right " style="top:45px; right:-10px;">
                                <i class="glyphicon glyphicon-chevron-right"></i>
                        </a>
                        <a ng-click="preventRedirection($event)" href="#" class="btn-prev pull-left arrow left" style="top:45px; left:-10px;">
                                <i class="glyphicon glyphicon-chevron-left"></i>
                        </a>
                        <div class="videos">
                                <div owlcarousel="owlConfig" data-owl-next="#slider2 .btn-next" data-owl-prev="#slider2 .btn-prev" class="owl-carousel zoom multiple no-pagination top-space">

                                        <?php
                                        $slug='anime-filme';
                                        $video_query = "select * from videos ";
                                        if(!empty($slug)) {
                                                $video_query .= "where category_id IN(select id from categories where slug='" . $slug . "')  order by id DESC LIMIT 10";
                                        }
                                        $query = $this->db->query($video_query);
                                        $series_videos = $query->result_array();

                                        if(sizeof($series_videos)>0) {
                                                foreach ($series_videos as $key => $field) {
                                                        $target_dir = dirname(dirname(dirname(dirname(__FILE__)))) . "/uploads/uploaded_videos/";
                                                        $target_file = $target_dir . basename($field['poster']);
                                                        if ($field['poster']=='' || !file_exists($target_file)) {
                                                                //echo $field['poster'];exit;
                                                                $field['poster'] = base_url()."assets/images/no-image-icon-158_87.jpg";
                                                        }
                                                        else{
                                                                $field['poster'] = base_url()."uploads/uploaded_videos/".$field['poster'];
                                                        }
                                                        ?>
                                                        <div>
                                                                <a href="<?php echo base_url()?>#/videodetail/<?php echo $field['id'];?>">
                                                                        <img  class="onefiftyeighteightyseven" src="<?php echo $field['poster'];?>" alt="">
                                                                        <p class="text-justify video-text">
                                                                                <?php echo substr($field['description'],0,20);?>
                                                                        </p>
                                                                </a>
                                                        </div>
                                                        <?php
                                                }
                                        } ?>








                                </div>
                        </div>

                </div>


                <div id="slider3" class="video-items without-text arrows shadow item">
                        <p class="title">
                                <i class="text-danger fa fa-heart-o"></i> BELIEBTESTE <strong>ANIME SERIEN</strong>
                        </p>
                        <a ng-click="preventRedirection($event)" href="#" class="btn-next pull-right arrow right " style="top:110px; right:-10px;">
                                <i class="glyphicon glyphicon-chevron-right"></i>
                        </a>
                        <a ng-click="preventRedirection($event)" href="#" class="btn-prev pull-left arrow left" style="top:110px; left:-10px;">
                                <i class="glyphicon glyphicon-chevron-left"></i>
                        </a>

                        <div class="videos">
                                <div owlcarousel="owlConfig" data-owl-next="#slider3 .btn-next" data-owl-prev="#slider3 .btn-prev" class="owl-carousel zoom multiple no-pagination top-space">
                                        <?php
                                        $slug='anime-series';
                                        $video_query = "select * from videos ";
                                        if(!empty($slug)) {
                                                $video_query .= "where category_id IN(select id from categories where slug='" . $slug . "')  order by id DESC LIMIT 10";
                                        }
                                        $query = $this->db->query($video_query);
                                        $series_videos = $query->result_array();

                                        if(sizeof($series_videos)>0) {
                                                foreach ($series_videos as $key => $field) {
                                                        $target_dir = dirname(dirname(dirname(dirname(__FILE__)))) . "/uploads/uploaded_videos/";
                                                        $target_file = $target_dir . basename($field['poster']);
                                                        if ($field['poster']=='' || !file_exists($target_file)) {
                                                                //echo $field['poster'];exit;
                                                                $field['poster'] = base_url()."assets/images/no-image-icon-6.jpg";
                                                        }
                                                        else{
                                                                $field['poster'] = base_url()."uploads/uploaded_videos/".$field['poster'];
                                                        }
                                                        ?>
                                                        <div>
                                                                <a href="<?php echo base_url() ?>#/videodetail/<?php echo $field['id'];?>">
                                                                        <img class="onefiftytwosixtyone"  src="<?php echo $field['poster'];?>" alt="">
                                                                </a>
                                                        </div>
                                                        <?php
                                                }
                                        } ?>

                                </div>
                        </div>

                </div>


                <div id="slider4" class="video-items with-text arrows item">
                        <p class="title">
                                <i class="text-danger fa fa-heart-o"></i> BELIEBTESTE <strong>ANIME FOLGEN</strong>

                        </p>
                        <a ng-click="preventRedirection($event)" href="#" class="btn-next pull-right arrow right " style="top:45px; right:-10px;">
                                <i class="glyphicon glyphicon-chevron-right"></i>
                        </a>
                        <a ng-click="preventRedirection($event)" href="#" class="btn-prev pull-left arrow left" style="top:45px; left:-10px;">
                                <i class="glyphicon glyphicon-chevron-left"></i>
                        </a>

                        <div class="videos">
                                <div owlcarousel="owlConfig" data-owl-next="#slider4 .btn-next" data-owl-prev="#slider4 .btn-prev" class="owl-carousel zoom multiple no-pagination top-space">



                                        <?php
                                        $slug='anime-filme';
                                        $video_query = "select * from videos ";
                                        if(!empty($slug)) {
                                                $video_query .= "where category_id IN(select id from categories where slug='" . $slug . "')  order by id DESC LIMIT 10";
                                        }
                                        $query = $this->db->query($video_query);
                                        $series_videos = $query->result_array();

                                        if(sizeof($series_videos)>0) {
                                                foreach ($series_videos as $key => $field) {
                                                        $target_dir = dirname(dirname(dirname(dirname(__FILE__)))) . "/uploads/uploaded_videos/";
                                                        $target_file = $target_dir . basename($field['poster']);
                                                        if ($field['poster']=='' || !file_exists($target_file)) {
                                                                //echo $field['poster'];exit;
                                                                $field['poster'] = base_url()."assets/images/no-image-icon-158_87.jpg";
                                                        }
                                                        else{
                                                                $field['poster'] = base_url()."uploads/uploaded_videos/".$field['poster'];
                                                        }
                                                        ?>
                                                        <div>
                                                                <a href="<?php echo base_url()?>#/videodetail/<?php echo $field['id'];?>">
                                                                        <img  class="onefiftyeighteightyseven" src="<?php echo $field['poster'];?>" alt="">
                                                                        <p class="text-justify video-text">
                                                                                <?php echo substr($field['description'],0,20);?>
                                                                        </p>
                                                                </a>
                                                        </div>
                                                        <?php
                                                }
                                        } ?>



                                </div>
                        </div>

                </div>

                <hr style="width: 100%" />
                <div id="slider5" class="video-items with-text arrows item">
                        <p class="title bottom-space">
                                <img src="<?php echo base_url()?>assets/img/line-graphic-arrow-red.svg" width="20" alt=""> ANIME  <strong>TRENDS</strong>

                        </p>
                        <a ng-click="preventRedirection($event)" href="#" class="btn-next pull-right arrow right " style="top:45px; right:-10px;">
                                <i class="glyphicon glyphicon-chevron-right"></i>
                        </a>
                        <a ng-click="preventRedirection($event)" href="#" class="btn-prev pull-left arrow left" style="top:45px; left:-10px;">
                                <i class="glyphicon glyphicon-chevron-left"></i>
                        </a>

                        <div class="videos">
                                <div owlcarousel="owlConfig" data-owl-next="#slider5 .btn-next" data-owl-prev="#slider5 .btn-prev" class="owl-carousel zoom multiple no-pagination top-space">

                                        <?php
                                        $slug='anime-filme';
                                        $video_query = "select * from videos ";
                                        if(!empty($slug)) {
                                                $video_query .= "where category_id IN(select id from categories where slug='" . $slug . "')  order by id DESC LIMIT 10";
                                        }
                                        $query = $this->db->query($video_query);
                                        $series_videos = $query->result_array();

                                        if(sizeof($series_videos)>0) {
                                                foreach ($series_videos as $key => $field) {
                                                        $target_dir = dirname(dirname(dirname(dirname(__FILE__)))) . "/uploads/uploaded_videos/";
                                                        $target_file = $target_dir . basename($field['poster']);
                                                        if ($field['poster']=='' || !file_exists($target_file)) {
                                                                //echo $field['poster'];exit;
                                                                $field['poster'] = base_url()."assets/images/no-image-icon-158_87.jpg";
                                                        }
                                                        else{
                                                                $field['poster'] = base_url()."uploads/uploaded_videos/".$field['poster'];
                                                        }
                                                        ?>

                                                        <div>
                                                                <a class="video-play hover-text" href="<?php echo base_url()?>#/videodetail/<?php echo $field['id'];?>">
                                                                        <p class="img">
                                                                                <img src="<?php echo $field['poster'];?>" class="onefiftyeighteightyseven img-responsive" alt="">
                                                                                <span class="icon-play"><i class="fa fa-3x fa-play-circle-o"></i> </span>
                                                                                <span class="time"><i class="fa fa-clock-o"></i> <?php echo $field['duration']?> </span>
                                                                                <span class="pull-right views"><i class="fa fa-eye"></i> <?php echo $field['views']?> views </span>
                                                                        </p>
                                                                        <p class="text"><?php echo substr($field['description'],0,20);?></p>
                                                                </a>
                                                        </div>
                                                        <?php
                                                }
                                        } ?>
                                </div>
                        </div>

                </div>

        </div>
</div>