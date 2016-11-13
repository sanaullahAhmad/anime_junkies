<div class="col-sm-12 content-parent col-md-8 col-xs-12">
        <div class="content detail-page">
                <?php
                        $this->load->view('include/slider');
                ?>

                <div class="item video-name-lg">
                        <div class="row">
                                <div class="col-md-6 col-sm-6">
                                        <h4 class="title lead top-space50"><i class="fa fa-envelope-o text-danger"></i> {{ videos.title }}</h4>
                                </div>
                                <div class="col-md-6 col-sm-6 overlay-toggle">
                                    <span class="pull-right top-space50">
                                        <label class="toggle">
                                                <input type="checkbox">
                                                <span class="handle"></span>
                                        </label>
                                        <strong class="toggle-label"> Kino-Modus einschalten</strong>
                                    </span>

                                </div>
                        </div>

                </div>
        </div>
</div>

<div class="col-sm-12 col-md-12 col-xs-12 detail-video-play">
        <div class="row">
                <div class="col-md-3 col-sm-2 right btn-prev">
                        <a href="#"><i class="glyphicon glyphicon-chevron-left"></i> </a>
                </div>
                <div class="col-md-6 col-sm-8 video-parent" style="z-index: 1">
                        <div class="video">

                                <div class="videoWrapper" style="position: relative; padding-bottom: 56.25%; /* 16:9 */ padding-top: 25px; height: 0;">
                                        <!--<iframe aria-controls="true"  scrolling="NO" frameborder="0" style="overflow:hidden;border: 0px;position: absolute;top: 0;left: 0;width: 100%;height: 100%;" webkitallowfullscreen mozallowfullscreen allowfullscreen
                                                         src="https://www.youtube.com/embed/XGSy3_Czz8k">
                                        </iframe>-->

                                        <video  autoplay="autoplay" width="660" height="396" controls style="overflow:hidden;border: 0px;position: absolute;top: 0;left: 0;">
                                                <source src="{{ videos.path }}" type="video/mp4">


                                                Your browser does not support the video tag.
                                        </video>
                                </div>
                        </div>
                </div>
                <div class="col-md-3 col-sm-2 left btn-next text-right">
                        <a href="#"><i class="glyphicon glyphicon-chevron-right"></i> </a>
                </div>
        </div>
</div>
<div class=" col-md-offset-2 col-sm-12 col-md-8 col-xs-12 content-parent" >
        <div class="content2  detail-page">
                <div class="item top-space">
                        <div class="panel">
                                <ul class="nav nav-tabs" id="myTab1">
                                        <li class="active"><a data-toggle="tab" href="#home1"><i class="fa fa-share-alt text-danger"></i> Teilen</a></li>
                                        <li class=""><a data-toggle="tab" href="#profile1">Profile</a></li>
                                        <li class="dropdown">
                                                <a data-toggle="dropdown" class="dropdown-toggle" id="myTabDrop1-1" href="#">Dropdown <b class="caret"></b></a>
                                                <ul aria-labelledby="myTabDrop1" role="menu" class="dropdown-menu">
                                                        <li><a data-toggle="tab" tabindex="-1" href="#dropdown1-1">@fat</a></li>
                                                        <li><a data-toggle="tab" tabindex="-1" href="#dropdown1-2">@mdo</a></li>
                                                </ul>
                                        </li>
                                        <li class="pull-right"><a data-toggle="tab" href="#profile1">Profile</a></li>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                        <div id="home1" class="tab-pane fade active in">
                                                <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica.</p>
                                        </div>
                                        <div id="profile1" class="tab-pane fade">
                                                <p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee.  </p>
                                        </div>
                                        <div id="dropdown1-1" class="tab-pane fade">
                                                <p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone...</p>
                                        </div>
                                        <div id="dropdown1-2" class="tab-pane fade">
                                                <p>Trust fund seitan letterpress, keytar raw denim keffiyeh etsy art party before they sold out master cleanse gluten-free squid scenester freegan cosby sweater. Fanny pack portland seitan DIY, art party locavore wolf cliche ... </p>
                                        </div>
                                </div>
                        </div>
                </div>
                <div class="bg-white">
                        <div class="item">
                                <p class="title"><i class="fa fa-play text-danger"></i> About this video</p>
                                <p>
                                        <strong class="text-danger"></strong>{{ videos.description }}
                                </p>
                        </div>
                        <hr width="100%">

                        <div class="item">
                                <div class="row">
                                        <div class="col-sm-2 col-md-2 theme">
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
                                        <div class="col-sm-8 col-md-8 text-muted text-right phone-text-left top-space5">
                                                <strong class="top-space5">Sortieren nach</strong>
                                        </div>
                                        <div class="col-sm-2 col-md-2">
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
                                <div class="row top-space subcategory ">
                                        <div class="col-md-12 videos">
                                                <div class="col-sm-3 col-md-2 zoom-it bottom-space"  ng-repeat="video in related_videos">
                                                        <a class="video-play" href="<?php echo base_url()?>#/video/{{ video.id}}">
                                                                <p class="img">
                                                                        <img src="{{ video.poster }}" class="img-responsive oneeightynineonezerofor" alt="">
                                                                        <span class="icon-play"><i class="fa fa-3x fa-play-circle-o"></i> </span>
                                                                        <span class="time"><i class="fa fa-clock-o"></i> {{ video.duration }} </span>
                                                                        <span class="pull-right views"><i class="fa fa-eye"></i> {{ video.views }} views </span>
                                                                </p>
                                                                <p class="text">{{ video.title }}</p>
                                                        </a>
                                                </div>


                                        </div>
                                        <div class="col-md-12 text-center top-space bottom-space">
                                                <button class="btn btn-default btn-load">
                                                        <span><i class="fa fa-repeat"></i></span> Weitere Flgen Laden ...
                                                </button>

                                        </div>
                                </div>
                        </div>
                        <hr width="100%">
                        <div class="item comment-section">
                                <p class="title top-space"><i class="fa fa-comment-o text-danger"></i> {{comments.length}} <strong>KOMMENTARE</strong></p>
                                <?php if($this->session->userdata('id')){?>
                                        <div class="row bottom-space">
                                                <div class="col-md-1 col-sm-1 col-xs-12">
                                                        <img src="http://vexoid.com/wp-content/uploads/2015/10/Jackie-Chan-WTF-32x32@2x.jpg" alt="">
                                                </div>
                                                <div class="col-md-11 col-sm-11 col-xs-12">
                                                        <div class="comment-input" >
                                                                <form ng-submit="post_comments()" >
                                                                        <textarea  class="form-control" ng-model="commnet_data.comment_text" placeholder="Offentlichen Kommentar posten... " ng-keypress="comment_submit_function($event)"></textarea>

                                                                        <input type="hidden"    ng-model="commnet_data.parent_id"  />
                                                                </form>
                                                        </div>
                                                </div>
                                        </div>
                                <?php }?>
                                <hr />
                                <div class="row bottom-space">
                                        <div class="col-md-2 col-sm-2">
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
                                <ul class="media-list">
                                        <li ng-if="comment.parent_id=='0'" class="media" ng-repeat="comment in comments | commentfilter | orderBy:'id':true" >
                                                <a href="#" class="pull-left"><img src="http://vexoid.com/wp-content/uploads/2015/10/Jackie-Chan-WTF-32x32@2x.jpg" class="media-object img-rounded"></a>
                                                <div class="media-body">
                                                        <h4 class="media-heading">{{ comment.name }}</h4>
                                                        <p>{{ comment.created_at }}</p>
                                                        <p>{{ comment.comment }}</p>

                                                        <!-- Nested media object -->
                                                        <div ng-if="replies.parent_id>0 && replies.secondary_parent_id=='0' && comment.id==replies.parent_id"
                                                             class="media" ng-repeat="replies in comments">
                                                                <a href="#" class="pull-left">
                                                                        <img src="http://vexoid.com/wp-content/uploads/2015/10/Jackie-Chan-WTF-32x32@2x.jpg"
                                                                             class="media-object img-rounded"></a>
                                                                <div class="media-body">
                                                                        <h4 class="media-heading">{{ replies.name }}</h4>
                                                                        <p>{{ replies.created_at }}</p>
                                                                        <p>{{ replies.comment }}</p>

                                                                        <!-- Nested media object -->
                                                                        <div ng-if="secondaryreplies.secondary_parent_id>0 && replies.id==secondaryreplies.secondary_parent_id"
                                                                             class="media" ng-repeat="secondaryreplies in comments">
                                                                                <a href="#" class="pull-left">
                                                                                        <img src="http://vexoid.com/wp-content/uploads/2015/10/Jackie-Chan-WTF-32x32@2x.jpg"
                                                                                             class="media-object img-rounded"></a>
                                                                                <div class="media-body">
                                                                                        <h4 class="media-heading">{{ secondaryreplies.name }}</h4>
                                                                                        <p>{{ secondaryreplies.created_at }}</p>
                                                                                        <p>{{ secondaryreplies.comment }}</p>
                                                                                </div>
                                                                        </div>

                                                                </div>
                                                        </div>
                                                </div>
                                        </li>

                                </ul>
                        </div>
                        <hr width="100%">
                        <div class="item text-center">
                                <button class="btn btn-default btn-load">
                                        <span><i class="fa fa-repeat"></i></span> Weitere Flgen Laden ...
                                </button>
                        </div>
                </div>

        </div>
</div>