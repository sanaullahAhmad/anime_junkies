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
                  <div class="col-md-12 col-sm-12">
                    <form name="myForm" class="form-horizontal top-space5"  ng-submit="video_uploads(fields)"><!--enctype="multipart/form-data"-->
                            <div class="form-group">
                              <input type="text" name="title" ng-model="fields.title" class="form-control input-lg pull-left" style="width: 75%"  placeholder="title"  required>
                                <span ng-show="myForm.title.$error.required"  style="color: #000000;" class="pull-left">*required</span>
                            </div>
                            <div class="form-group">
                                <input type="text" name="description" ng-model="fields.description"  required class="form-control input-lg pull-left"  style="width: 75%"  placeholder="Description" required>
                                <i ng-show="myForm.description.$error.required" class="pull-left" style="color: #000000;">*required</i>
                            </div>
                            <div class="form-group">
                              <select name="category_id" ng-model="fields.category_id" class="form-control input-lg" required style="width: 75%" >
                              <?php 
							  $rows = $this->Generic_model->select('categories', "", "");
								if(!empty($rows) && sizeof($rows)>0)
								{
									foreach($rows as $row)
									{
									?>
                              		<option value="<?php echo $row['id'];?>"><?php echo $row['title'];?></option>
									<?php
									}
								}
							  ?>
                              </select>
                            </div>
                            <div class="form-group">
                                <div class="btn btn-success fileinput-button pull-left clearfix " style="margin-bottom: 15px;">
                                    <i class="glyphicon glyphicon-plus"></i>
                                    <span>Add file...</span>
                                    <input type="file" ngf-select ng-model="picFile" name="video"
                                           accept=".3gp,.flv,.mkv,.mp4" ngf-max-size="20MB" required style="color: #000000;"
                                           ngf-model-invalid="errorFile" ng-change="uploadPic(picFile)">
                                </div>

                                <div class="progress" ng-show="picFile.progress >= 0 && !picFile.result" style="width: 75%; margin-top: 15px; clear: both;" >
                                    <div style="width:{{picFile.progress}}%" ng-bind="picFile.progress + '%'"></div>
                                 </div>
                                <div class="process_video" ng-show="check_cond"  style="width: 75%; margin-top: 15px; clear: both; color: black;" >
                                    <h4>Processing...Please Wait...</h4>
                                </div>
                                <span id="videofile_placeholder"></span>
                                <div ng-show="picFile.result" style="color: #000000; width: 75%">Upload Successful</div>
                                <span class="err" ng-show="errorMsg" style="color: #000000;">{{errorMsg}}</span>
                            </div>
                            <div class="form-group">
                                    <button class="btn btn-register btn-default btn-block btn-lg pull-left" style="width: 75%"   ng-disabled="!myForm.$valid || !picFile.result || check_cond" type="submit" name="upload_submit_btn" >
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