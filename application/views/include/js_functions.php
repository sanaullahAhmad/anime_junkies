<script>
$(document).ready( function(){
//Login manager
	$("#login-form-manager").validate({
				  rules: {
	                email: {
	                    required: true,
						email: true
	                },	               
					 password: {
	                    required: true
	                },
	            },
	            messages: {
	                email: {
	                    required: "Please enter email.",
						email: "Email is not valid."
	                },				
					password: {
	                    required: "Please enter password."
	                },	              
	            },
				debug: true,		
				errorPlacement: function(error, element) {
					var name = $(element).attr("name");
					error.appendTo($("#" + name + "_validate"));
				}, 
        submitHandler: function(form) {
		  $.ajax({
                   type: "POST",
                   url: "<?php echo base_url()?>home/check_login",
                   data: $("#login-form-manager").serialize(), 
                   cache: false,
				   beforeSend: function(){ $("#logsubbutton").text('Checking...');},
                  success: function(data) {
					   if(data == 'active'){
                           	$('.fornotactive').hide();
							$('.forincorrectunpass').hide();
							$('.condoinactive').hide();
                            $("#logsubbutton").html('Logging you in... <i class="m-icon-swapright m-icon-white"></i>');
                            
							<?php if(isset($_GET['next'])){?>
							window.location.href = "<?php echo $_GET['next'];?>";
							<?php } else {?>
							window.location.href = "<?php echo base_url()?>home";
							<?php }?>
                        } else if(data == 'condo inactive'){
							$("#logsubbutton").html('Login <i class="m-icon-swapright m-icon-white"></i>');
							$('.condoinactive').show();
                            $('.fornotactive').hide();
							$('.forincorrectunpass').hide();
                        }else if(data == 'notactive'){
							$("#logsubbutton").html('Login <i class="m-icon-swapright m-icon-white"></i>');
                            $('.fornotactive').show();
							$('.forincorrectunpass').hide();
							$('.condoinactive').hide();
                        } else {
							$("#logsubbutton").html('Login <i class="m-icon-swapright m-icon-white"></i>');
							 $("#password").val('');
						   $('.forincorrectunpass').show();
						   $('.fornotactive').hide();
							$('.condoinactive').hide();
                        }
                    },
                   error: function() {
                        alert('Something went wrong');
                   }
                 });
        }
    });
    $('#forgot-pass-click').click(function(){
        $("#forgot-pass-form-manager").show();
        $("#login-form-manager").hide();
    });
    $('#back-btn').click(function(){
        $("#login-form-manager").show();
        $("#forgot-pass-form-manager").hide();
    });
    $('#linksent_back').click(function(){
        $("#login-form-manager").show();
        $("#success-message").hide();
    });
    //Forgot Password
    $("#forgot-pass-form-manager").validate({
        rules: {
            email_forgot: {
                required: true,
                email: true,
                remote: {
                    url: "<?php echo base_url()?>home/check_data_exists_forgot_pass/email_forgot/users",
                    type: "post",
                    data: {
                        email_forgot: function(){ return $("#email_forgot").val(); }
                    }
                }
            }
        },
        messages: {
            email_forgot: {
                required: "Please enter Email",
                email: "Please enter a valid email",
                remote: "Seems we do not have this email address. Please check."
            }
        },
        debug: true,

        errorPlacement: function(error, element) {
            var name = $(element).attr("name");
            error.appendTo($("#" + name + "_validate"));
        },



        submitHandler: function(form) {
            $.ajax({

                type: "POST",

                url: "<?php echo base_url()?>home/forgot_password",

                data: $("#forgot-pass-form-manager").serialize(),

                cache: false,

                beforeSend: function(){ $("#forgotpasssubbutton").text('Sending Link...');},

                success: function(data) {
                    if(data == 'LINKSENT'){
                        $("#success-message").show();
                        $("#forgot-pass-form-manager").hide();
                    }
                },


                error: function() {
                    alert('Something went wrong');
                }

            });

        }
    });
	
	 //Add Resident Form
	$("#addresident-form").validate({
			
					  rules: {
						name: {
							required: true/*,
							  remote: {
							  url: "<?php echo base_url()?>manager/check_data_exists/name/residents",
							  type: "post",
							  data: {
								  name: function(){ return $("#name").val(); }
								}
							  }*/
						},
							
						email: {
							required: true,
							  remote: {
							  url: "<?php echo base_url()?>home/check_data_exists/email/users",
							  type: "post",
							  data: {
								  email: function(){ return $("#email").val(); }
							  }
							}
						},
						
						password: {
							required: true
						},
						
					},
					messages: {
					  name: {
							required: "Please enter Name"/*,
							remote: "Name Already Exist.",*/
						},
					  email: {
							required: "Please enter Email",
							remote: "Email Already Exist.",
						},
					  password: {
							required: "Please enter block",
						},
					},
					debug: true,
					errorPlacement: function(error, element) {
						var name = $(element).attr("name");
						error.appendTo($("#" + name + "_validate"));
					}, 
	
			submitHandler: function(form) 
			{
				form.submit();
				//alert('success');
				//return false;
			}
		});


    $('nav.navbar').on('click','.menu-toggle', function (e) {
        e.preventDefault();
        $('.sidebar').toggleClass('col-md-2').toggleClass('col-md-1').children('ul').toggleClass('hidden').delay(300);
        $('.content-parent').toggleClass('col-md-8').toggleClass('col-md-10');
    });


});
</script>