
<div class="page-content">
  <!-- BEGIN PAGE HEADER-->
  <h3 class="page-title"> Products
      <small>Products</small>
  </h3>
  <div class="page-bar">
      <ul class="page-breadcrumb">
          <li>
              <i class="icon-home"></i>
              <a href="<?php echo base_url();?>admin">Home</a>
              <i class="fa fa-angle-right"></i>
          </li>
          <li>
              <span>Products</span>
          </li>
      </ul>
      <a href="<?php echo base_url();?>admin/add_product" style="float:right; margin-right:20px; margin-top:15px;" class="btn btn-primary" id="" type="submit">Add Product</a>
      
  </div>
  <!-- END PAGE HEADER-->
  <!-- BEGIN DASHBOARD STATS 1-->
  <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <!-- Table -->
      <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="genral">
      
          <!-- Table heading -->
          <thead class="bg-gray">
              <tr>
                  <th>Name</th>
                  <th>Description</th>
                  <th>Store</th>
                  <th>User</th>
                  <th>Actions</th>
              </tr>
          </thead>
          <!-- // Table heading END -->
          
          <!-- Table body -->
          <tbody>
          <?php if($this->session->flashdata('message'))
          {
              echo $this->session->flashdata('message');
          }?>

          <?php
          foreach($products as $product){
          ?>
              <!-- Table row -->
              <tr class="gradeX">
                  <td  ondblclick="edit_field('<?php echo $product['id'];?>', 'admin', 'full_name', 'category_service_id_<?php echo $product['id'];?>')" id="category_service_id_<?php echo $product['id'];?>"><?php echo $product['name']?></td>
                  <td><?php echo $product['description']?></td>
                  <td><?php echo $this->Generic_model->get_data_value_using_where("stores", "id=".$product['store_id'],"name")?></td>
                  <td><?php echo $this->Generic_model->get_data_value_using_where("users", "id=".$product['user_id'],"firstname")?></td>
                  <td>
                      <a class="show_delete_claim_type" href="#" onclick="callCrudAction('products',<?php echo $product['id'];?>,'delete_data')" id="<?php echo $product['id'];?>">
                          <span class="glyphicon glyphicon-remove"></span>
                      </a>
                      <a  href="<?php echo base_url();?>admin/edit_product/<?php echo $product['id'];?>" >
                          <span class="glyphicon glyphicon-pencil"></span>
                      </a>
                      <!--<a  href="<?php echo base_url();?>alpha/reset_password/<?php echo $product['id'];?>" >
                          <span class="glyphicon glyphicon-home"></span>
                      </a>-->
                  </td>
                  
              </tr>
              <!-- // Table row END -->
              
              <?php } ?>
          
              
              
              
          </tbody>
          <!-- // Table body END -->
          
      </table>
      <!-- // Table END -->
      </div>
    </div>
    <div class="clearfix"></div>
    <!-- END DASHBOARD STATS 1-->
</div>