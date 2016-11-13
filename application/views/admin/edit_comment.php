<div class="page-content">
  <!-- BEGIN PAGE HEADER-->
  <h3 class="page-title"> Edit Comment
      <small>store</small>
  </h3>
  <div class="page-bar">
      <ul class="page-breadcrumb">
          <li>
              <i class="icon-home"></i>
              <a href="<?php echo base_url();?>">Home</a>
              <i class="fa fa-angle-right"></i>
          </li>
          <li>
              <span>Edit Comment</span>
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
                      <label class="col-md-3 control-label">Comment</label>
                      <div class="col-md-9">
                          <input type="text" class="form-control" id="comment" name="comment" placeholder="Title" value="<?php echo $comment_info['comment'];?>">
                          <span class="error_individual" id="name_validate"></span>
                      </div>
                  </div>



              </div>
              <div class="form-actions">
                  <div class="row">
                      <div class="col-md-offset-3 col-md-9">
                          <button type="submit" name="edit_comment_btn" class="btn green">Submit</button>
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