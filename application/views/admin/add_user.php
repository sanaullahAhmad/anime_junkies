<div class="page-content">
  <!-- BEGIN PAGE HEADER-->
  <h3 class="page-title"> Add User
      <small>User</small>
  </h3>
  <div class="page-bar">
      <ul class="page-breadcrumb">
          <li>
              <i class="icon-home"></i>
              <a href="<?php echo base_url();?>"admin>Home</a>
              <i class="fa fa-angle-right"></i>
          </li>
          <li>
              <span>Add User</span>
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
                <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                <span class="error_individual" id="name_validate"></span>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">User Name</label>
            <div class="col-md-9">
                <input type="text" class="form-control" id="user_name" name="user_name" placeholder="User Name">
                <span class="error_individual" id="user_name_validate"></span>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">email</label>
            <div class="col-md-9">
                <input type="text" class="form-control" id="email_reg" name="email_reg" placeholder="Email">
                <span class="error_individual" id="email_reg_validate"></span>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">Password</label>
            <div class="col-md-9">
                <input type="password" class="form-control" id="password_reg" name="password_reg" placeholder="Password">
                <span class="error_individual" id="password_reg_validate"></span>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">Telephone</label>
            <div class="col-md-9">
                <input type="text" class="form-control" id="phone" name="phone" placeholder="Telephone">
                <span class="error_individual" id="phone_validate"></span>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-3 control-label">Image</label>
            <div class="col-md-9 " >
                <input type="file" name="file" id="file">
                <span class="error_individual help-block" id="file_validate"></span>
            </div>
        </div>



<div class="form-group">
<div class="col-sm-offset-2 col-sm-10">
<input type="hidden" id="table" name="table" value="admin">
<button type="submit" id="add_user_btn" name="add_user_btn" class="btn btn-primary">Register User</button>
</div>
</div>
</form>
</div>
    </div>
    <div class="clearfix"></div>
    <!-- END DASHBOARD STATS 1-->
</div>