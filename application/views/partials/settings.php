<div class="col-sm-12 content-parent col-md-8 col-xs-12">
    <div class="content registration-form">
        <div class="form">
          <div>
            <div class="row">
              <div class="col-sm-12 logo col-md-12 col-xs-12 text-center top-space50">
                      <img src="<?= config_item('img_path') ?>logo.png" alt="" >
              </div>
              <div class="col-md-offset-2 col-sm-offset-1 col-sm-11 col-md-8 col-xs-12 text-center top-space50">
                <div class="row bottom-space">
                  <div class="col-md-6 col-sm-6">
                    <form class="form-horizontal top-space5" method="post" action="<?php echo base_url()?>home/index" enctype="multipart/form-data">
                            <div class="form-group">
                            <?php 
							  $rows = $this->Generic_model->select_one('users', "", "id=".$this->session->userdata('id'));
							  //print_r($rows);
							  ?>
                              <input type="text" name="email" class="form-control input-lg" placeholder="Email" 
                              value="<?php echo $rows['email'];?>" required>


                            </div>
                            <div class="form-group" style="float: left;color: black;">
                                Delete Account? <input type="checkbox"  name="delete_account"  />
                            </div>
                            <div class="form-group">
                                    <button class="btn btn-register btn-default btn-block btn-lg" type="submit" name="account_submit_btn" >
                                            Submit
                                    </button>
                            </div>
                    </form>
                  </div>
                  <div class="col-md-6 col-sm-6">
                          
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="item top-space50 text-justify">
               
        </div>

        <div class="item top-space50">
        </div>
    </div>



</div>