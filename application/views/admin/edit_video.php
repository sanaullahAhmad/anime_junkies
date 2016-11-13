<div class="page-content">
  <!-- BEGIN PAGE HEADER-->
  <h3 class="page-title"> Edit Video
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
              <span>Edit Video</span>
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
                      <label class="col-md-3 control-label">Video Title</label>
                      <div class="col-md-9">
                          <input type="text" class="form-control" id="title" name="title" placeholder="Title" value="<?php echo $video_info['title'];?>">
                          <span class="error_individual" id="name_validate"></span>
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-md-3 control-label">User</label>
                      <div class="col-md-9">

                          <select class="form-control" id="user" name="user">
                              <?php
                              if(sizeof($users)>0 && $users!=false)
                              {
                                  foreach ($users as $user)
                                  {
                                      ?>
                                      <option value="<?php echo $user['id'];?>" <?php if($video_info['user_id']==$user['id']){?> selected <?php }?> >
                                          <?php echo $user['user_name'];?>
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
                      <label class="col-md-3 control-label">Description</label>
                      <div class="col-md-9">
                          <textarea class="form-control ckeditor" rows="5" name="description" id="description" placeholder=""><?php echo $video_info['description'];?></textarea>
                          <span class="error_individual help-block" id="description_validate"></span>
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-md-3 control-label">File</label>
                      <div class="col-md-4" >
                          <input type="file" name="file_1" id="file_1">
                          <span class="error_individual help-block" id="file_1_validate"></span>
                      </div>
                      <div class="col-md-5" >
                          <img src="<?php echo base_url();?>uploads/uploaded_videos/<?php echo  $video_info['poster']?>" style="width: 100px;">
                      </div>
                  </div>



              </div>
              <div class="form-actions">
                  <div class="row">
                      <div class="col-md-offset-3 col-md-9">
                          <button type="submit" name="edit_store_btn" class="btn green">Submit</button>
                          <a href="<?php echo base_url();?>" class="btn default">Cancel</a>
                      </div>
                  </div>
              </div>
          </form>

</div>
    </div>
    <div class="clearfix"></div>



    <h3 class="page-title" style="margin-top: 80px;">  Video Comments
        <small></small>
    </h3>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <!-- Table -->
            <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="genral">
                <!-- Table heading -->
                <thead class="bg-gray">
                <tr>
                    <th>Comment</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <!-- // Table heading END -->
                <!-- Table body -->
                <tbody>
                <?php
                if($video_comments!=false)
                {
                foreach($video_comments as $video_comment){
                    ?>
                    <!-- Table row -->
                    <tr class="gradeX">

                        <td><?php echo $video_comment['comment']?></td>

                        <td>
                            <a class="show_delete_claim_type" href="#" onclick="callCrudAction('video_comments',<?php echo $video_comment['id'];?>,'delete_data')" id="<?php echo $video_comment['id'];?>">
                                <span class="glyphicon glyphicon-remove"></span>
                            </a>
                            <a  href="<?php echo base_url();?>admin/edit_comment/<?php echo $video_comment['id'];?>/<?php echo $video_info['id'];?>" >
                                <span class="glyphicon glyphicon-pencil"></span>
                            </a>

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