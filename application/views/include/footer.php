<footer>
        <div class="container-fluid">
                <div class="row">
                        <div class="col-sm-8 col-md-8 col-sm-offset-2 col-md-offset-2">
              <span class="copy">
                        Copyright &copy; 2012-2016 <a href="#" class="text-muted"> <img src="<?= config_item('img_path'); ?>icon_animejunkies.JPG"> Anime-Junkies.tv</a>
              </span>
              <span class="pull-right links text-muted">
                    <a href="#" class="text-muted">Impressum</a> | <a href="#" class="text-muted">Kontakt</a>
              </span>
                        </div>
                </div>

        </div>
</footer>


<script src="<?= config_item('js_path'); ?>jquery.min.js"></script>
<script src="<?= config_item('js_path'); ?>bootstrap.min.js"></script>

<script src="<?= base_url(); ?>angular/angular.min.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>angular/ui/angular-ui-router.min.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>angular/other/ocLazyLoad/ocLazyLoad.min.js"></script>


<script src="<?= config_item('plugins_path'); ?>owl-carousel/owl.carousel.min.js"></script>

<!--

<script src="<?/*= config_item('js_path'); */?>icheck.min.js"></script>

-->
<script src="<?= config_item('js_path'); ?>jquery.fs.selecter.min.js"></script>
<script src="<?= config_item('js_path'); ?>jquery.fs.stepper.min.js"></script>

<script src="<?= base_url(); ?>angular/other/file-upload/ng-file-upload-shim.min.js"></script>
<script src="<?= base_url(); ?>angular/other/file-upload/ng-file-upload.min.js"></script>

<script src="<?= config_item('js_path'); ?>angular/frontend/app.js"></script>
<script type="text/javascript" src="<?= config_item('js_path'); ?>angular/frontend/routes/my-ui-route.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>angular/directives/owlcarousel.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>angular/directives/selecter.js"></script>
<script type="text/javascript" src="<?= config_item('js_path'); ?>angular/frontend/controllers/mainController.js"></script>
<script type="text/javascript" src="<?= config_item('js_path'); ?>jquery.validate.js"></script>
 <?php $this->load->view('include/js_functions');?>