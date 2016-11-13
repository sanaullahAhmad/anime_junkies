<div  class="col-sm-12 content-parent col-md-8 col-xs-12">
    <div class="content">

        <?php
        $this->load->view('include/slider');
        ?>

        <div class="subcategory video-items without-text top-space item">

            <div class="row">
              <div class="col-sm-6 col-md-3 col-xs-12">
                <p class="title top-space5"><i class="text-danger icon-fontello-video"></i> Anemi  <strong>Trends</strong></p>
              </div>
              <div class="col-sm-3 col-md-2 col-xs-12 theme">
                <select data-selecter name="selecter_basic" class="selecter_1">
                        <optgroup label="Group One">
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                        </optgroup>
                        <optgroup label="Group One">
                                <option value="4">Four</option>
                                <option value="5">Five</option>
                                <option value="6">Six</option>
                                <option value="7">Seven</option>
                        </optgroup>
                        <optgroup label="Group Three">
                                <option value="8">Eight</option>
                                <option value="9">Nine</option>
                                <option value="10">Ten</option>
                        </optgroup>
                </select>
              </div>
              <div class="col-md-7 col-sm-3 col-xs-12">
                <div class="row sort-parent">
                    <div class="col-md-9 top-space10 text-right text-muted" style="padding-right: 0">
                    <span class="pull-right phone-left">Sortieren nach</span>
                    </div>
                    <div class="col-md-3 col-xs-12">
                            <select data-selecter name="selecter_basic" class="selecter_1">
                                    <optgroup label="Group One">
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                    </optgroup>
                                    <optgroup label="Group One">
                                            <option value="4">Four</option>
                                            <option value="5">Five</option>
                                            <option value="6">Six</option>
                                            <option value="7">Seven</option>
                                    </optgroup>
                                    <optgroup label="Group Three">
                                            <option value="8">Eight</option>
                                            <option value="9">Nine</option>
                                            <option value="10">Ten</option>
                                    </optgroup>
                            </select>
                    </div>
                </div>

              </div>
            </div>

            <div class="row top-space ">
              <div class="col-md-12 videos">
              <?php 
			   $rows = $this->Generic_model->select('videos', "", "", "30"," 'views', 'asc' ");
				if(!empty($rows) && sizeof($rows)>0)
				{
					foreach($rows as $row)
					{
                        $target_dir = dirname(dirname(dirname(dirname(__FILE__)))) . "/uploads/uploaded_videos/";
                        $target_file = $target_dir . basename($row['poster']);
						?>
						<div class="col-sm-3 col-md-2 zoom-it bottom-space">
                            <a class="video-play hover-text" href="<?php echo base_url()?>#/videodetail/<?php echo $row['id']?>">
                              <p class="img">
                                  <?php if($row['poster']=='' || !file_exists($target_file))
                                  { $poster = base_url()."assets/images/no-image-icon-6.jpg"; }
                                  else{ $poster=base_url()."uploads/uploaded_videos/".$row['poster']; }?>
                                <img src="<?= $poster ?>" class="onefiftyonefifty img-responsive" alt="">
                                <span class="icon-play"><i class="fa fa-3x fa-play-circle-o"></i> </span>
                                <span class="time"><i class="fa fa-clock-o"></i> <?php echo $row['duration']?> </span>
                                <span class="pull-right views"><i class="fa fa-eye"></i> <?php echo $row['views']?> views </span>
                              </p>
                              <p class="text"><?php echo $row['title']?></p>
                            </a>
                       </div>
						<?php 
					}
				}
				else
				{
					echo "NO Videos Found.";
				}
			  ?>
                
              </div>
              <div class="clearfix"></div>
              <div class="col-md-12 text-center top-space bottom-space">
                      <button class="btn btn-default btn-load">
                              <span><i class="fa fa-repeat"></i></span> Weitere Flgen Laden ...
                      </button>

              </div>
            </div>
        </div>


    </div>

</div>