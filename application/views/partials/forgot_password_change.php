<div class="col-sm-12 content-parent col-md-8 col-xs-12">
    <div class="content registration-form">
        <div class="form">
            <div>
                <div class="row">
                    <div class="col-sm-12 logo col-md-12 col-xs-12 text-center top-space50">
                        <img src="/anime_junkies/assets/img/logo.png" alt="" >
                    </div>
                    <div class="col-md-offset-2 col-sm-offset-1 col-sm-11 col-md-8 col-xs-12 text-center top-space50">
                        <div class="row bottom-space">
                            <div class="col-md-12 col-sm-12">
                                <h1 style="width: 100%;color: #fff;">Change forgot password.</h1>
                                <?php
                                if($verify_data != 'USED'){
                                    ?>


                                    <form id="forgot-password-change" role="form" method="POST">
                                        <input type="hidden" value="<?php echo $verify_data;?>" name="id">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Password</label>
                                            <input type="password" class="form-control" id="password" name="password" placeholder="New Password">
                                            <span id="password_validate"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Retype Password</label>
                                            <input type="password" class="form-control" id="repassword" name="repassword" placeholder="Retype Password">
                                            <span id="repassword_validate"></span>
                                        </div>

                                        <button type="submit" name="forgotpasssubbutton" class="btn btn-primary btn-block">Change Password</button>

                                    </form>

                                    <?php
                                } else {
                                    ?>
                                    <h1 class="separator bottom center">Link Expired.</h1>
                                    <p class="margin-none innerT center"><a href="<?php echo base_url()?>manager" class="btn btn-warning">Try Forgot Password Option again.</a></p>
                                    <?php

                                }
                                ?>
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