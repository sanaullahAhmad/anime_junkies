<nav class="navbar navbar-default navbar-custom navbar-fixed-top">

        <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header col-sm-2 col-md-2 col-lg-2">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                        </button>
            <span class="navbar-brand ">
                <a href="#"  class="menu-toggle hidden-xs hidden-sm">
                        <span class="fa fa-bars"></span>
                </a>

                <a  href="<?php echo base_url()?>" class="logo"> <img class="svg" src="<?= config_item('img_path'); ?>logo-header.svg" style="margin-left: 0px;
                position: relative;top: -10px; max-width: 123px; width: 100%;min-height: 38px;"></a>
            </span>


                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                  <form class="navbar-form navbar-left" role="search" ng-submit="$parent.search_videos(keywords)" >
                    <div class="form-group">
                      <input type="text" class="form-control input-search" placeholder="Suchbegriff eingeben" name="search" ng-model="keywords">
                    </div>
                  </form>


                        <ul class="nav navbar-nav">
                                <li ng-repeat="category in categories">
                                  <a href="category/{{category.slug}}" ng-bind="category.title"></a>
                                </li>
                                <!--<li ng-repeat="category in categories">
                                  <a href="categoryhot/{{category.slug}}/hot" >Hot <span ng-bind="category.title"></span></a>
                                </li>-->

                                <li>
                                    <a href="categoryhot/anime-filme/hot" >HOT <span>FILME</span></a>
                                </li>
                                <li>
                                    <a href="categoryhot/anime-series/hot" >HOT <span>SERIEN</span></a>
                                </li>



                                <!--<li><a href="subcategory.html">ANIME SERIEN</a></li>
                                <li><a href="subcategory.html">HOT FILME</a></li>
                                <li><a href="subcategory.html">HOT HOT SERIEN</a></li>-->
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                        		<?php if($this->session->userdata('id')){?>
                                <li>
                                	<a href="do_logout" class="dropdown-toggle" ><i class="fa fa-user"></i> Logout</a>
                                <li>
                                <li><a href="settings"><i class="fa fa-lock"></i>Settings</a></li>
                                <?php } else {?>
                                <li class="dropdown login">
                                        <a ng-click="preventRedirection($event)" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i> Login</a></a>
                                        <ul class="dropdown-menu">
                                        	<form id="login-form-manager">
                                                <div class="alert alert-danger forincorrectunpass" style="display: none">
                                                    <button class="close" data-close="alert"></button>
                                                    Incorrect Email or Password.
                                                </div>
                                                <li>
                                                    <input name="email" id="email" type="text" class="form-control no-radius" placeholder="Bentzername / E-Mailaddress">
                                        			<span id="email_validate"></span>
                                                </li>
                                                <li>
                                                        <input type="password" class="form-control no-radius" placeholder="Password" name="password" id="password">
                                                        <span id="password_validate"></span>
                                                </li>
                                                <li>
                                                        <button type="submit" class="btn btn-danger no-radius theme-bg btn-block" id="logsubbutton">Anmelden</button>
                                                </li>
                                                <li role="separator" class="divider"><span>OR</span></li>

                                                <li>
                                                        <a href="facebook_login"  class="btn btn-primary btn-fb no-radius fb-bg btn-block">
                                                                <i class="fa fa-facebook-f"></i>
                                                                Facebook anmelden
                                                        </a>
                                                </li>
                                                <li class="text-muted">
                                                        <span id="forgot-pass-click"><i class="fa fa-lock"></i> Password vergessen?</span> oder <span><i class="fa fa-user"></i>
                                                        <a href="<?php echo base_url();?>register" style="padding: 0; background: none;">Registrieren</a></span>
                                                </li>
                                            </form>


                                            <form class="forget-form" id="forgot-pass-form-manager" action="" method="post" style="display: none">
                                                <h5 style="color: #fff;">Forget Password ?</h5>
                                                <p style="color: #fff;"> Enter your e-mail address below to reset your password. </p>
                                                <div class="form-group">
                                                    <input class="form-control placeholder-no-fix" type="text" id="email_forgot" autocomplete="off" placeholder="Email" name="email_forgot" />
                                                    <span id="email_forgot_validate" class="error_individual" style="color: red"></span></div>
                                                <div class="form-actions">
                                                    <button type="button" id="back-btn" class="btn btn-default">Back</button>
                                                    <button type="submit" class="btn btn-success uppercase pull-right" id="forgotpasssubbutton">Submit</button>
                                                </div>
                                            </form>

                                            <li id="success-message" style="display: none;">
                                                Link Sent to your email. click on it to change your password.
                                                <p>&nbsp;</p>
                                                <button id="linksent_back" class="btn btn-success uppercase pull-right">Back</button>
                                            </li>

                                        </ul>
                                </li>
                                <li><a href="register"><i class="fa fa-lock"></i>Registrieren</a></li>
                                <?php } ?>
                        </ul>
                </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
</nav>