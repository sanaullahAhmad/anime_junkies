<div class="page-content">
  <!-- BEGIN PAGE HEADER-->
  <h3 class="page-title"> Pages
      <small>Pages</small>
  </h3>
  <div class="page-bar">
      <ul class="page-breadcrumb">
          <li>
              <i class="icon-home"></i>
              <a href="<?php echo base_url();?>admin">Home</a>
              <i class="fa fa-angle-right"></i>
          </li>
          <li>
              <span>Pages</span>
          </li>
      </ul>
      <a href="<?php echo base_url();?>admin/add_page" style="float:right; margin-right:20px; margin-top:15px;" class="btn btn-primary" id="" type="submit">Add Page</a>
      
  </div>
  <!-- END PAGE HEADER-->
  <!-- BEGIN DASHBOARD STATS 1-->
    <?php if($this->session->flashdata('message'))
    {
        echo $this->session->flashdata('message');
    }?>

  <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <!-- Table -->
      <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="genral">
      
          <!-- Table heading -->
          <thead class="bg-gray">
              <tr>
                  <th>Title</th>
                  <th>Description</th>
                  <th>Actions</th>
              </tr>
          </thead>
          <!-- // Table heading END -->
          
          <!-- Table body -->
          <tbody>


          <?php
          if($pages!=false) {
              foreach ($pages as $page) {
                  ?>
                  <!-- Table row -->
                  <tr class="gradeX">
                      <td ondblclick="edit_field('<?php echo $page['id']; ?>', 'pages', 'title', 'category_service_id_<?php echo $page['id']; ?>')"
                          id="category_service_id_<?php echo $page['id']; ?>">
                          <?php echo $page['title'] ?>
                      </td>
                      <td><?php echo $page['description'] ?></td>
                      <td>
                          <a class="show_delete_claim_type" href="#"
                             onclick="callCrudAction('pages',<?php echo $page['id']; ?>,'delete_data','<?php echo $page['image']; ?>','pages_images')"
                             id="<?php echo $page['id']; ?>">
                              <span class="glyphicon glyphicon-remove"></span>
                          </a>
                          <a href="<?php echo base_url(); ?>admin/edit_page/<?php echo $page['id']; ?>">
                              <span class="glyphicon glyphicon-pencil"></span>
                          </a>
                          <!--<a  href="<?php echo base_url(); ?>alpha/reset_password/<?php echo $page['id']; ?>" >
                          <span class="glyphicon glyphicon-home"></span>
                      </a>-->
                      </td>

                  </tr>
                  <!-- // Table row END -->

              <?php }
          }?>
          
              
              
              
          </tbody>
          <!-- // Table body END -->
          
      </table>
      <!-- // Table END -->
      </div>
    </div>
    <div class="clearfix"></div>
    <!-- END DASHBOARD STATS 1-->
</div>