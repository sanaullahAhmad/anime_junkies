
<div class="page-content">
  <!-- BEGIN PAGE HEADER-->
  <h3 class="page-title"> Edit Page
      <small>page</small>
  </h3>
  <div class="page-bar">
      <ul class="page-breadcrumb">
          <li>
              <i class="icon-home"></i>
              <a href="<?php echo base_url();?>">Home</a>
              <i class="fa fa-angle-right"></i>
          </li>
          <li>
              <span>Edit Page</span>
          </li>
      </ul>
      
  </div>
  <!-- END PAGE HEADER-->
  <!-- BEGIN DASHBOARD STATS 1-->
  <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <!-- Table -->
          <form class="form-horizontal" role="form"  id="add_store" method="post" enctype="multipart/form-data">
              <div class="form-body">
                  <div class="form-group">
                      <label class="col-md-3 control-label">Title</label>
                      <div class="col-md-9">
                          <input type="text" class="form-control" id="name" name="name" placeholder="Title" value="<?php echo $page_info['title']?>">
                          <span class="error_individual" id="name_validate"></span>
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-md-3 control-label">Description</label>
                      <div class="col-md-9">
                          <textarea class="form-control ckeditor" rows="5" name="description" id="description" placeholder=""><?php echo $page_info['title']?></textarea>
                          <span class="error_individual help-block" id="description_validate"></span>
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-md-3 control-label">File</label>
                      <div class="col-md-4" >
                          <input type="file" name="file_1" id="file_1">
                          <span class="error_individual help-block" id="file_1_validate"></span>
                      </div>
                      <div class="col-md-4" >
                          <img src="<?php echo base_url()?>uploads/pages_images/<?php echo $page_info['image']?>" style="width: 100px;">
                      </div>

                  </div>
              </div>
              <div class="form-actions">
                  <div class="row">
                      <div class="col-md-offset-3 col-md-9">
                          <button type="submit" name="edit_page" class="btn green">Submit</button>
                          <a href="<?php echo base_url();?>" class="btn default">Cancel</a>
                      </div>
                  </div>
              </div>
          </form>
</div>
    </div>
    <div class="clearfix"></div>
    <!-- END DASHBOARD STATS 1-->
</div>