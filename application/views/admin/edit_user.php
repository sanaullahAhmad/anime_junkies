<div class="page-content">
  <!-- BEGIN PAGE HEADER-->
  <h3 class="page-title"> Edit User
      <small>User</small>
  </h3>
  <div class="page-bar">
      <ul class="page-breadcrumb">
          <li>
              <i class="icon-home"></i>
              <a href="<?php echo base_url();?>">Home</a>
              <i class="fa fa-angle-right"></i>
          </li>
          <li>
              <span>User</span>
          </li>
      </ul>
      
  </div>
  <!-- END PAGE HEADER-->
  <!-- BEGIN DASHBOARD STATS 1-->
  <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <!-- Table -->
          <form id="register_user" class="form-horizontal" role="form" method="POST" enctype="multipart/form-data">
              <div class="form-group">
                  <label class="col-md-3 control-label">Name</label>
                  <div class="col-md-9">
                      <?php //print_r($user_info);?>
                      <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="<?php echo $user_info['name']?>">
                      <span class="error_individual" id="name_validate"></span>
                  </div>
              </div>
              <div class="form-group">
                  <label class="col-md-3 control-label">User Name</label>
                  <div class="col-md-9">
                      <?php //print_r($user_info);?>
                      <input type="text" class="form-control" id="user_name" name="user_name" placeholder="User Name" value="<?php echo $user_info['user_name']?>">
                      <span class="error_individual" id="user_name_validate"></span>
                  </div>
              </div>
              <div class="form-group">
                  <label class="col-md-3 control-label">Email</label>
                  <div class="col-md-9">
                      <input type="text" class="form-control" id="email_reg" name="email_reg" placeholder="Email" value="<?php echo $user_info['email']?>">
                      <span class="error_individual" id="email_reg_validate"></span>
                  </div>
              </div>
              <div class="form-group">
                  <label class="col-md-3 control-label">Password</label>
                  <div class="col-md-9">
                      <input type="password" class="form-control" id="password_reg_1" name="password_reg_1" placeholder="Leave it empty if not want to change">
                      <span class="error_individual" id="password_reg_1_validate"></span>
                  </div>
              </div>
              <div class="form-group">
                  <label class="col-md-3 control-label">Telephone</label>
                  <div class="col-md-9">
                      <input type="text" class="form-control" id="phone" name="phone" placeholder="Telephone" value="<?php echo $user_info['phone']?>">
                      <span class="error_individual" id="phone_validate"></span>
                  </div>
              </div>

              <div class="form-group">
                  <label class="col-md-3 control-label">Image</label>
                  <div class="col-md-4 " >
                      <input type="file" name="file_1" id="file_1">
                      <span class="error_individual help-block" id="file_1_validate"></span>
                  </div>
                  <div class="col-md-5 " >
                     <img src="<?php echo base_url();?>uploads/profile_images/<?php echo  $user_info['image']?>" style="width: 100px;">
                  </div>
              </div>



              <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                      <input type="hidden" id="table" name="table" value="admin">
                      <button type="submit" id="add_user_btn" name="edit_user_btn" class="btn btn-primary">Update User</button>
                  </div>
              </div>
          </form>
</div>
    </div>
    <div class="clearfix"></div>
    <!-- END DASHBOARD STATS 1-->
</div>