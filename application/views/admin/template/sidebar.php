<?php $current_page = base_url(uri_string());
	  $active = 'start active open';
	  $selected = '<span class="selected"></span>';
	  $arrow = 'open';

?>
<div class="page-sidebar-wrapper">
                <div class="page-sidebar navbar-collapse collapse">
                    <ul class="page-sidebar-menu  page-header-fixed page-sidebar-menu-hover-submenu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">


                        <li class="nav-item <?php if($current_page == base_url('admin/dashboard')){ echo $active;}?>">
                            <a href="<?php echo base_url()?>admin/dashboard" class="nav-link nav-toggle">
                                <i class="icon-home"></i>
                                <span class="title">Dashboard</span>
                                 <?php if($current_page == base_url('admin/dashboard')){ echo $selected;}?>
                                 <span class="arrow <?php if($current_page == base_url('admin/dashboard')){ echo $arrow;}?>"></span>
                            </a>
                            
                        </li>
                        <li class="nav-item <?php if($current_page == base_url('admin/pages')){ echo $active;}?>">
                            <a href="<?php echo base_url()?>admin/pages" class="nav-link nav-toggle">
                                <i class="fa fa-image"></i>
                                <span class="title">Pages</span>
                                <?php if($current_page == base_url('admin/pages')){ echo $selected;}?>
                                <span class="arrow <?php if($current_page == base_url('admin/pages')){ echo $arrow;}?>"></span>
                            </a>
                        </li>
                        <li class="nav-item <?php if($current_page == base_url('admin/users')){ echo $active;}?>">
                            <a href="<?php echo base_url()?>admin/users" class="nav-link nav-toggle">
                                <i class="fa fa-user"></i>
                                <span class="title">Users</span>
								<?php if($current_page == base_url('admin/users')){ echo $selected;}?>
                                <span class="arrow <?php if($current_page == base_url('admin/users')){ echo $arrow;}?>"></span>
                            </a>
                            
                        </li>
                     
                        <li class="nav-item <?php if($current_page == base_url('admin/videos')){ echo $active;}?>">
                            <a href="<?php echo base_url()?>admin/videos" class="nav-link nav-toggle">
                                <i class="fa fa-building"></i>
                                <span class="title">Videos</span>
								<?php if($current_page == base_url('admin/videos')){ echo $selected;}?>
                                <span class="arrow <?php if($current_page == base_url('admin/videos')){ echo $arrow;}?>"></span>
                            </a>
                            
                        </li>
                        <li class="nav-item <?php if($current_page == base_url('admin/categories')){ echo $active;}?>">
                            <a href="<?php echo base_url()?>admin/categories" class="nav-link nav-toggle">
                                <i class="fa fa-image"></i>
                                <span class="title">Categories</span>
                                <?php if($current_page == base_url('admin/categories')){ echo $selected;}?>
                                <span class="arrow <?php if($current_page == base_url('admin/categories')){ echo $arrow;}?>"></span>
                            </a>
                        </li>
                        <li class="nav-item <?php if($current_page == base_url('admin/server_settings')){ echo $active;}?>">
                            <a href="<?php echo base_url()?>admin/server_settings" class="nav-link nav-toggle">
                                <i class="fa fa-image"></i>
                                <span class="title">Server Settings</span>
                                <?php if($current_page == base_url('admin/server_settings')){ echo $selected;}?>
                                <span class="arrow <?php if($current_page == base_url('admin/server_settings')){ echo $arrow;}?>"></span>
                            </a>
                        </li>
                        </ul>
                    <!-- END SIDEBAR MENU -->
                </div>
                <!-- END SIDEBAR -->
            </div>







<!--<div id="menu" class="hidden-print hidden-xs sidebar-blue sidebar-brand-primary">

			
<div id="sidebar-fusion-wrapper">
	<div id="brandWrapper">
		<a href="<?php echo base_url()?>admin" class="display-block-inline pull-left logo"><img src="<?php echo base_url()?>adminassets/admin/images/logo/alia-logo.png" alt=""></a>
		<!--<a href="<?php echo base_url()?>admin/"><span class="text">ALIA</span></a>
	</div>
	

	<ul class="menu list-unstyled" id="navigation_current_page">
            <li <?php if($current_page == base_url('admin/dashboard')){ echo $active;}?>><a href="<?php echo base_url()?>admin/dashboard" class="glyphicons cardio"><i></i><span>Dashboard</span></a></li>
        <li <?php if($current_page == base_url('admin/condos')){ echo $active;}?>><a href="<?php echo base_url()?>admin/condos" class="glyphicons building"><i></i><span>Condos</span></a></li>
         <li <?php if($current_page == base_url('admin/vendors')){ echo $active;}?>><a href="<?php echo base_url()?>admin/vendors" class="glyphicons group"><i></i><span>Vendors</span></a></li>
        
        <li class="hasSubmenu">
            <a href="#settings_tables" data-toggle="collapse"><i class="fa fa-cog"></i> Settings</a>
            <ul class="collapse" id="settings_tables">
            	<li <?php if($current_page == base_url('admin/users')){ echo $active;}?>><a href="<?php echo base_url()?>admin/users" class="glyphicons user"><i></i><span>Users</span></a></li>
                 <li <?php if($current_page == base_url('admin/service_categories')){ echo $active;}?>><a href="<?php echo base_url()?>admin/service_categories" class="glyphicons cardio"><i></i><span>Services Categories</span></a></li>
        		 <li <?php if($current_page == base_url('admin/services')){ echo $active;}?>><a href="<?php echo base_url()?>admin/services" class="glyphicons wrench"><i></i><span>Services</span></a></li>
                 <li <?php if($current_page == base_url('admin/incident_categories')){ echo $active;}?>><a href="<?php echo base_url()?>admin/incident_categories" class="glyphicons cardio"><i></i><span>Incident Categories</span></a></li>

            </ul>
        </li>
	</ul>
</div>
</div>-->