
<div class="page-content">
  <!-- BEGIN PAGE HEADER-->
  <h3 class="page-title"> Add Product
      <small>Product</small>
  </h3>
  <div class="page-bar">
      <ul class="page-breadcrumb">
          <li>
              <i class="icon-home"></i>
              <a href="<?php echo base_url();?>admin">Home</a>
              <i class="fa fa-angle-right"></i>
          </li>
          <li>
              <span>Add Product</span>
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
                      <label class="col-md-3 control-label">Product Name</label>
                      <div class="col-md-9">
                          <input type="text" class="form-control" id="name" name="name" placeholder="Name" >
                          <span class="error_individual" id="name_validate"></span>
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-md-3 control-label">User</label>
                      <div class="col-md-9">

                          <select class="form-control" id="user" name="user" onchange="change_stores(this.value)">
                              <?php
                              if(sizeof($users)>0 && $users!=false)
                              {
                                  foreach ($users as $user)
                                  {
                                      ?>
                                      <option value="<?php echo $user['id'];?>"  >
                                          <?php echo $user['firstname']." ".$user['lastname'];?>
                                      </option>
                                      <?php
                                  }
                              }
                              ?>
                          </select>
                          <span class="error_individual" id="user_validate"></span>
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-md-3 control-label">Store</label>
                      <div class="col-md-9 stores_markup">

                          <select class="form-control" id="store" name="store">
                              <?php
                             /* if(sizeof($stores)>0 && $stores!=false)
                              {
                                  foreach ($stores as $store)
                                  {
                                      */?><!--
                                      <option value="<?php /*echo $store['id'];*/?>"  >
                                          <?php /*echo $store['name'];*/?>
                                      </option>
                                      --><?php
/*                                  }
                              }*/
                              ?>
                          </select>
                          <span class="error_individual" id="store_validate"></span>
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
                      <label class="col-md-3 control-label">File</label>
                      <div class="col-md-4" >
                          <input type="file" name="file" id="file">
                          <span class="error_individual help-block" id="file_validate"></span>
                      </div>

                  </div>



              </div>
              <div class="form-actions">
                  <div class="row">
                      <div class="col-md-offset-3 col-md-9">
                          <button type="submit" name="add_product" class="btn green">Submit</button>
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