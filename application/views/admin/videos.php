<div class="page-content">
  <!-- BEGIN PAGE HEADER-->
  <h3 class="page-title"> Videos
      <small>Stores</small>
  </h3>
  <div class="page-bar">
      <ul class="page-breadcrumb">
          <li>
              <i class="icon-home"></i>
              <a href="<?php echo base_url();?>admin">Home</a>
              <i class="fa fa-angle-right"></i>
          </li>
          <li>
              <span>Videos</span>
          </li>
      </ul>
      <!--<a href="<?php /*echo base_url();*/?>admin/add_video" style="float:right; margin-right:20px; margin-top:15px;" class="btn btn-primary" id="" type="submit">Add Video</a>-->
      
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
                  <th>store owner</th>
                  <th>Actions</th>
              </tr>
          </thead>
          <!-- // Table heading END -->
          <!-- Table body -->
          <tbody>
          <?php
          foreach($videos as $video){
          ?>
              <!-- Table row -->
              <tr class="gradeX">
                  <td  ondblclick="edit_field('<?php echo $video['id'];?>', 'videos', 'title', 'category_service_id_<?php echo $video['id'];?>')" id="category_service_id_<?php echo $video['id'];?>"><?php echo $video['title']?></td>
                  <td><?php echo $video['description']?></td>
                  <td><?php echo $this->Generic_model->get_data_value_using_where("users", "id=".$video['user_id'],"name")?></td>
                  <td>
                      <a class="show_delete_claim_type" href="#" onclick="callCrudAction('videos',<?php echo $video['id'];?>,'delete_data', '<?php echo $video['poster'];?>', 'uploaded_videos')" id="<?php echo $video['path'];?>">
                          <span class="glyphicon glyphicon-remove"></span>
                      </a>
                      <a  href="<?php echo base_url();?>admin/edit_video/<?php echo $video['id'];?>" >
                          <span class="glyphicon glyphicon-pencil"></span>
                      </a>
                      <!--<a  href="<?php echo base_url();?>alpha/reset_password/<?php echo $video['id'];?>" >
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