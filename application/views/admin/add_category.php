<div class="page-content">
  <!-- BEGIN PAGE HEADER-->
  <h3 class="page-title"> Add Category
      <small>Category</small>
  </h3>
  <div class="page-bar">
      <ul class="page-breadcrumb">
          <li>
              <i class="icon-home"></i>
              <a href="<?php echo base_url();?>"admin>Home</a>
              <i class="fa fa-angle-right"></i>
          </li>
          <li>
              <span>Add Category</span>
          </li>
      </ul>
      
  </div>
  <!-- END PAGE HEADER-->
  <!-- BEGIN DASHBOARD STATS 1-->
  <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <!-- Table -->
    <form id="add_category_form" class="form-horizontal" role="form" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label class="col-md-3 control-label">Name</label>
            <div class="col-md-9">
                <input type="text" class="form-control" id="title" name="title" placeholder=Ttitle" >
                <span class="error_individual" id="title_validate"></span>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">Slug</label>
            <div class="col-md-9">
                <input type="text" class="form-control" id="slug" name="slug" placeholder="Slug" >
                <span class="error_individual" id="slug_validate"></span>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">Description</label>
            <div class="col-md-9">
                <textarea class="form-control ckeditor" rows="5" name="description" id="description" placeholder=""></textarea>
                <span class="error_individual help-block" id="description_validate"></span>
            </div>
        </div>


<div class="form-group">
<div class="col-sm-offset-2 col-sm-10">
<input type="hidden" id="table" name="table" value="admin">
<button type="submit" id="add_user_btn" name="add_catgory_btn" class="btn btn-primary">Register Category</button>
</div>
</div>
</form>
</div>
    </div>
    <div class="clearfix"></div>
    <!-- END DASHBOARD STATS 1-->
</div>