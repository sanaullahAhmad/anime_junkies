<!DOCTYPE html>
<html lang="en" ng-app="kp_clothes"  data-ng-controller="mainController as mc">
<?php
 $this->load->view('include/head');
?>
<body>
<?php
$this->load->view('include/navbar');
?>
<div class="container-fluid main">
        <div class="row">
            <?php
            $this->load->view('include/sidebar');
            ?>
            <div ui-view="main">
                    <h3 class="col-sm-11 col-md-8 col-xs-12 text-center top-space50"><i class="spin fa fa-refresh"></i> Loading...</h3>
            </div>

        </div>
</div>

<?php
$this->load->view('include/footer');
?>
</body>
</html>
