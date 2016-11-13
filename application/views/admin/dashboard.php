<div class="page-content">                    <!-- BEGIN PAGE HEADER-->
                    <h3 class="page-title"> Dashboard
                    </h3>
                    <div class="page-bar">
                        <ul class="page-breadcrumb">
                            <li>
                                <i class="icon-home"></i>
                                <a href="<?php echo base_url()?>admin">Home</a>
                                <i class="fa fa-angle-right"></i>
                            </li>
                            <li>
                                <span>Dashboard</span>
                            </li>
                        </ul>
                    </div>
                    <!-- END PAGE HEADER-->
                    <!-- BEGIN DASHBOARD STATS 1-->
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <a class="dashboard-stat dashboard-stat-v2 blue" href="#">
                                <div class="visual">
                                    <i class="fa fa-building"></i>
                                </div>
                                <div class="details" onclick="window.location.href='<?php echo base_url('admin/users')?>'">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="<?php echo $this->db->count_all_results('users')?>">0</span>
                                    </div>
                                    <div class="desc"> Users </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <a class="dashboard-stat dashboard-stat-v2 red" href="#">
                                <div class="visual">
                                    <i class="fa fa-user"></i>
                                </div>
                                <div class="details" onclick="window.location.href='<?php echo base_url('admin/videos')?>'">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="<?php echo $this->db->count_all_results('videos')?>"></span></div>
                                    <div class="desc"> Videos </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <a class="dashboard-stat dashboard-stat-v2 green" href="#">
                                <div class="visual">
                                    <i class="fa fa-legal"></i>
                                </div>
                                <div class="details" onclick="window.location.href='<?php echo base_url('admin/videos')?>'">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="<?php echo $this->db->count_all_results('video_comments')?>">0</span>
                                    </div>
                                    <div class="desc"> Comments </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <a class="dashboard-stat dashboard-stat-v2 purple" href="#">
                                <div class="visual">
                                    <i class="fa fa-globe"></i>
                                </div>
                                <div class="details" onclick="window.location.href='<?php echo base_url('admin/categories')?>'">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="<?php echo $this->db->count_all_results('categories')?>"></span></div>
                                    <div class="desc"> Categories </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <!-- END DASHBOARD STATS 1-->
                </div>

