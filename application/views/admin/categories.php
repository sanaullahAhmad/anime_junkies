<div class="page-content">
  <!-- BEGIN PAGE HEADER-->
  <h3 class="page-title"> Categories
      <small>Categories</small>
  </h3>
  <div class="page-bar">
      <ul class="page-breadcrumb">
          <li>
              <i class="icon-home"></i>
              <a href="<?php echo base_url();?>admin">Home</a>
              <i class="fa fa-angle-right"></i>
          </li>
          <li>
              <span>Categories</span>
          </li>
      </ul>
      <a href="<?php echo base_url();?>admin/add_category" style="float:right; margin-right:20px; margin-top:15px;" class="btn btn-primary" id="" type="submit">Add Category</a>
      
  </div>
  <!-- END PAGE HEADER-->
  <!-- BEGIN DASHBOARD STATS 1-->
  <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <!-- Table -->

      <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="genral">
      
          <!-- Table heading -->
          <thead class="bg-gray">
              <tr>
                  <th>Title</th>
                  <th>Slug</th>
                  <th>Description</th>
                  <th>Actions</th>
              </tr>
          </thead>
          <!-- // Table heading END -->
          
          <!-- Table body -->
          <tbody>
          <?php if($this->session->flashdata('message'))
          {
              echo $this->session->flashdata('message');
          }
          foreach($categories as $category){
          ?>
              <!-- Table row -->
              <tr class="gradeX">
                  <td  ondblclick="edit_field('<?php echo $category['id'];?>', 'categories', 'title', 'category_service_id_<?php echo $category['id'];?>')" id="category_service_id_<?php echo $category['id'];?>"><?php echo $category['title']?></td>
                  <td><?php echo $category['slug']?></td>
                  <td><?php echo $category['description']?></td>
                  <td>
                      <a class="show_delete_claim_type" href="#" onclick="callCrudAction('categories',<?php echo $category['id'];?>,'delete_data')" id="<?php echo $category['id'];?>">
                          <span class="glyphicon glyphicon-remove"></span>
                      </a>
                      <a  href="<?php echo base_url();?>admin/edit_category/<?php echo $category['id'];?>" >
                          <span class="glyphicon glyphicon-pencil"></span>
                      </a>
                      <!--<a  href="<?php echo base_url();?>alpha/reset_password/<?php echo $category['id'];?>" >
                          <span class="glyphicon glyphicon-home"></span>
                      </a>-->
                  </td>
                  
              </tr>
              <!-- // Table row END -->
              <?php } ?>
          </tbody>
          <!-- // Table body END -->
          
      </table>
      <!-- // Table END -->
      </div>
    </div>
    <div class="clearfix"></div>
    <!-- END DASHBOARD STATS 1-->
</div>