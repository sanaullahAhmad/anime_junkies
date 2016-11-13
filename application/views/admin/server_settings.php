<div class="page-content">
  <!-- BEGIN PAGE HEADER-->
  <h3 class="page-title"> Server
      <small>Settings</small>
  </h3>
  <div class="page-bar">
      <ul class="page-breadcrumb">
          <li>
              <i class="icon-home"></i>
              <a href="<?php echo base_url();?>">Home</a>
              <i class="fa fa-angle-right"></i>
          </li>
          <li>
              <span>Server Settings</span>
          </li>
      </ul>
      
  </div>
  <!-- END PAGE HEADER-->
  <!-- BEGIN DASHBOARD STATS 1-->
  <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <?php if($this->session->flashdata('message'))
          {
              echo $this->session->flashdata('message');
          }
          ?>
      <!-- Table -->
          <form class="form-horizontal" role="form"  id="add_store" method="post" enctype="multipart/form-data">
              <div class="form-body">

                  <div class="form-group">
                      <label class="col-md-3 control-label">Server</label>
                      <div class="col-md-9">

                          <select class="form-control" id="server" name="server">
                                      <option value="thisserver" <?php if($server_info['value']=='thisserver'){?> selected <?php }?> >
                                          This Server
                                      </option>
                                      <option value="remoteserver" <?php if($server_info['value']=='remoteserver'){?> selected <?php }?> >
                                          Remote Server
                                      </option>
                          </select>
                          <span class="error_individual" id="user_validate"></span>
                      </div>
                  </div>
              </div>
              <div class="form-actions">
                  <div class="row">
                      <div class="col-md-offset-3 col-md-9">
                          <button type="submit" name="edit_server_btn" class="btn green">Submit</button>
                          <a href="<?php echo base_url();?>admin" class="btn default">Cancel</a>
                      </div>
                  </div>
              </div>
          </form>
</div>
    </div>
    <div class="clearfix"></div>
    <!-- END DASHBOARD STATS 1-->
</div>