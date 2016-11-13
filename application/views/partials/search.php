<div  class="col-sm-12 content-parent col-md-8 col-xs-12">
        <div class="content">

                <?php
                $this->load->view('include/slider');
                ?>

                <div class="subcategory video-items without-text top-space item">

                  <div class="row">
                    <div class="col-sm-6 col-md-3 col-xs-12">
                       <p class="title top-space5"><i class="text-danger icon-fontello-video"></i> Search  <strong>Results</strong></p>
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
                    
                    <p ng-hide="videos.length">No videos</p>
                      <div class="col-sm-3 col-md-2 zoom-it bottom-space" ng-repeat="video in videos">
                        <a class="video-play hover-text" href="<?php echo base_url()?>#/videodetail/{{ video.id }}">
                          <p class="img">
                            <img src="<?= base_url(); ?>uploads/uploaded_videos/{{ video.poster }}" class="img-responsive" alt="">
                            <span class="icon-play"><i class="fa fa-3x fa-play-circle-o"></i> </span>
                            <span class="time"><i class="fa fa-clock-o"></i> 30:20 </span>
                            <span class="pull-right views"><i class="fa fa-eye"></i> 1223 views </span>
                          </p>
                          <p class="text">{{ video.title }}</p>
                        </a>
                      </div>


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