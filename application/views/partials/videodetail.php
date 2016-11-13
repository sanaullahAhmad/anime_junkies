<div class="col-sm-12 content-parent  detail-page-parent col-md-8 col-xs-12">
            <div class="content detail-page">
                <div class="top-banner"></div>
                <div class="details-single" >
                    <div class="detail-header top-banner-space">
                       <h3><i class="icon-fontello-video theme-text"></i> {{ videos.title }}</h3>
                        <div class="row">
                            <div class="col-md-4">
                                <a href="<?php echo base_url();?>#/video/{{ videos.id }}">
                                    <img height="350"  src="{{ videos.poster }}" alt="">
                                </a>
                            </div>
                           <div class="table-style col-md-6">
                                <div>
                                   <div class="row">
                                        <div class="col-md-6 border-right table-column-lg border-bottom">
                                           <button class="btn btn-default btn-block button-info-detail-page theme-bg"><i class="fa fa-play-circle-o"></i> Jetzt anschauen</button>
                                        </div>
                                        <div class="col-md-6 border-bottom table-column-lg"><i class="fa fa-television theme-text"></i> {{ videos.category }}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 border-right table-column-sm border-bottom">
                                           <i class="fa fa-info-circle theme-text"></i> <span class="badge theme-bg">Adventure</span> &nbsp; <span class="badge theme-bg">Fun</span>
                                        </div>
                                        <div class="col-md-6 border-bottom table-column-sm">{{ videos.user }}</div>
                                    </div>
                                    <div class="row">
                                        <div id="fb-root"></div>
                                        <script>(function(d, s, id) {
                                                var js, fjs = d.getElementsByTagName(s)[0];
                                                if (d.getElementById(id)) return;
                                                js = d.createElement(s); js.id = id;
                                                js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.7";
                                                fjs.parentNode.insertBefore(js, fjs);
                                            }(document, 'script', 'facebook-jssdk'));</script>
                                        <script>window.twttr = (function(d, s, id) {
                                                var js, fjs = d.getElementsByTagName(s)[0],
                                                    t = window.twttr || {};
                                                if (d.getElementById(id)) return t;
                                                js = d.createElement(s);
                                                js.id = id;
                                                js.src = "https://platform.twitter.com/widgets.js";
                                                fjs.parentNode.insertBefore(js, fjs);

                                                t._e = [];
                                                t.ready = function(f) {
                                                    t._e.push(f);
                                                };

                                                return t;
                                            }(document, "script", "twitter-wjs"));</script>
                                        <div class="col-md-6 border-right table-column-lg">
                                            <i class="fa fa-share-alt theme-text"></i> Deinen Freunden teilen :
                                           <p class="top-space5">
                                            <div class="fb-like" style="width: 50px; top: -5px;" data-href="<?php echo base_url()?>videodetail/{{ videos.id }}" data-layout="standard" data-action="like" data-show-faces="false" data-share="false"></div>
                                            <a class="twitter-share-button"
                                               href="https://twitter.com/intent/tweet?text=Nice%20Video">
                                                Tweet</a>
                                               <a href="#" class="btn btn-xs btn-info"><i class="fa fa-twitter"></i> Twtter</a>
                                           </p>

                                        </div>
                                        <div class="col-md-6 table-column-lg">
                                            <span>
                                                 <img src="<?= base_url(); ?>assets/img/icon-hands.png" style="width:24px; position: relative; top:-2px" alt="">
                                            Bewertung
                                            </span>

                                            <p class="top-space5">
                                                <i class="fa fa-thumbs-o-up text-muted"></i> {{video_likes_count}}
                                                &nbsp;&nbsp;
                                                <i class="fa fa-thumbs-o-down text-muted"></i> {{video_unlikes_count}}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="detail-footer">
                        <div class="row">
                            <div class="col-md-offset-4 col-md-7">
                                <p><strong class="theme-text">Title : </strong> {{ videos.title }}</p>
                                <p><strong class="theme-text">Genere : </strong> {{ videos.category }}, Dolorum ,eveniet, fugiat, modi, nihil, nisi, repellat, veniam, repellendus</p>
                                <p><strong class="theme-text">Beschreibung : </strong>{{ videos.description }}</p>                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="subcategory video-items with-text top-space50 item">

                  <div class="row">
                      <div class="col-sm-6 col-md-3 col-xs-12">
                          <p class="title top-space5"><i class="text-danger icon-fontello-video"></i> NEUESTE <strong>ANIME FOLGEN</strong></p>
                      </div>

                  </div>

              </div>

              <div class="col-sm-12 col-md-12 col-xs-12 content-parent" >
                <ul class="nav nav-tabs" id="aboutVideo">
                    <li class="pull-right" <?php if($this->session->userdata('id')){?>ng-click="like_video(0)"<?php }?>>
                        <a href="javascript:void(0)"
                           <?php if($this->session->userdata('id')){ }else{?>style="cursor: not-allowed" title="Login first"<?php }?>>
                            <i class="fa fa-thumbs-o-down"></i></a></li>
                    <li class="pull-right" <?php if($this->session->userdata('id')){?>ng-click="like_video(1)"<?php }?>>
                        <a  href="javascript:void(0)"
                            <?php if($this->session->userdata('id')){ }else{?>style="cursor: not-allowed" title="Login first"<?php }?>>
                            <i class="fa fa-thumbs-o-up"></i> {{video_likes_count}}</a></li>
                </ul>    
            </div>
              

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

              
              	
            </div>
        </div>
        <style>
		.top-banner {
			position: absolute;
   			margin: 30px 15% 0px 15%;
			top: 10px;
		}
		
		</style>