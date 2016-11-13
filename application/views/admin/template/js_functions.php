<?php 
	$timestamp = time();?>
<script>

//setTimeout(function(){
	
	$(document).ready( function(){
		$('#start_date').datepicker({
			format: 'yyyy-mm-dd',
		});
		$('#end_date').datepicker({
			format: 'yyyy-mm-dd',
		});
	});

$("#add_store").validate({
	rules: {
		name: {
			required: true,
		},
		description: {
			required: true,
		},
		file: {
			required: true
		},
		store: {
			required: true
		},
	},
	messages: {
		name: {
			required: "Please enter name."
		},
		description: {
			required: "Please enter description.",
		},
		file: {
			required: "Please select an image."
		},
		store: {
			required: "Please select a store."
		},
	},
	debug: true,
	errorPlacement: function(error, element) {
		var name = $(element).attr("name");
		error.appendTo($("#" + name + "_validate"));
	},
	submitHandler: function(form) {
		form.submit();
	}
});
$("#register_user").validate({
	rules: {
		name: {
			required: true,
		},
		user_name: {
			required: true,
		},
		email_reg: {
			/*required: true,*/
			email: true
		},
		password_reg: {
			required: true
		},
		file: {
			required: true
		},
	},
	messages: {
		name: {
			required: "Please enter name."
		},
		user_name: {
			required: "Please enter User name."
		},
		email_reg: {
			/*required: "Please enter email.",*/
			email: "Email is not valid."
		},
		password_reg: {
			required: "Please enter password."
		},
		file: {
			required: "Please select an image."
		},
	},
	debug: true,
	errorPlacement: function(error, element) {
		var name = $(element).attr("name");
		error.appendTo($("#" + name + "_validate"));
	},
	submitHandler: function(form) {
		form.submit();
	}
});
$("#add_category_form").validate({
	rules: {
		name: {
			required: true,
		},
		file: {
			required: true
		},
	},
	messages: {
		name: {
			required: "Please enter name."
		},
		file: {
			required: "Please select an image."
		},
	},
	debug: true,
	errorPlacement: function(error, element) {
		var name = $(element).attr("name");
		error.appendTo($("#" + name + "_validate"));
	},
	submitHandler: function(form) {
		form.submit();
	}
});
	//Add Knowledge base
	$("#send_resident_email").validate({
				  rules: {
					condo: {
	                    required: true,
	                },
					subject: {
	                    required: true,
	                },
					 message: {
	                    required: true
	                },
	            },
	            messages: {
					condo: {
	                    required: "Please select condo",
	                },
					subject: {
	                    required: "Please enter subject",
	                },
					 message: {
	                    required: "Please enter message",
	                },
					/* add_link: {
	                    required: "Please enter link",
	                }*/
	            },
				debug: true,
				errorPlacement: function(error, element) {
					var name = $(element).attr("name");
					error.appendTo($("#" + name + "_validate"));
				}, 
        submitHandler: function(form) {
        		form.submit();
        }
    });
	

	$(function () {
		'use strict';
		//$("#progress").hide();
			$('#advertisement_featured_image').fileupload({
				url: '<?php echo base_url()?>admin/upload_ad_image',
				dataType: 'json',
				done: function (e, data) 
				{
					$.each(data.result.files, function (index, file) 
					{
						//check if file upload exeeded
						var check_images = $("#files").html();
						if(check_images!='')
						{
							var lenth = $('.images_names').length;
							if(lenth>0)
							{ 
								alert("You have already selected 1 image.");
								return false;//this will stop add progress bar
							}
						}
						//check if file upload exeeded ends
						var res = file.name.split(".");
						var ran = "";
						var charset = "abcdefghijklmnopqrstuvwxyz";
						for( var i=0; i < 5; i++ )
							ran += charset.charAt(Math.floor(Math.random() * charset.length));
						if(file.valid_file=='yes')
						{
							if(file.extension=='pdf')
							{
							
							$('#files').append('<section style="position:relative;" class="'+ran+'">'+file.name+'<span onclick="delete_image_section(&#39;'+ran+'&#39;)" class="image_delete_cross" style="margin-left:5px">&#120;</span><input type="hidden" name="images_names[]" value="'+file.name+'" class="images_names"></section>');
							}
							else
							{
						$('#files').append('<section style="position:relative; float:left;" class="'+ran+'"><img src="<?php echo base_url()?>uploads/advertisement_images/'+file.name+'" class="img_responsive" style="width:100px; float:left"/><span onclick="delete_image_and_section(&#39;'+ran+'&#39;, &#39;'+res[0]+'&#39;, &#39;'+res[1]+'&#39;, &#39;incident_images&#39;, &#39;incident_images&#39;)" class="image_delete_cross" >&#120;</span><input type="hidden" name="images_names[]" value="'+file.name+'" class="images_names"></section>');
							}
						}
						else
						{
							$('#files').append('<section style="position:relative; float:left;" class="'+ran+'"><span class="label label-warning">'+file.name+'</span><span onclick="delete_image_section(&#39;'+ran+'&#39;)" class="image_delete_cross" style="margin-left:5px">&#120;</span></section>');
						}
					});
				},
				progressall: function (e, data) 
				{
					$("#progress").show();
					$("#progress_loading").show();
					var progress = parseInt(data.loaded / data.total * 100, 10);
					$('#progress .progress-bar').css(
						'width',
						progress + '%'
					);
						if(progress>99){ setTimeout(function(){ $("#progress, #progress_loading").css( 'display', 'none'); }, 3000); }
				}
			}).prop('disabled', !$.support.fileInput)
				.parent().addClass($.support.fileInput ? undefined : 'disabled');
			$('#email_attachement').fileupload({
				url: '<?php echo base_url()?>manager/email_attachement',
				dataType: 'json',
				done: function (e, data) 
				{
					$.each(data.result.files, function (index, file) 
					{
						//check if file upload exeeded
						var check_images = $("#files").html();
						if(check_images!='')
						{
							var lenth = $('.images_names').length;
							if(lenth>0)
							{ 
								alert("You have already selected 1 image.");
								return false;//this will stop add progress bar
							}
						}
						//check if file upload exeeded ends
						var res = file.name.split(".");
						var ran = "";
						var charset = "abcdefghijklmnopqrstuvwxyz";
						for( var i=0; i < 5; i++ )
							ran += charset.charAt(Math.floor(Math.random() * charset.length));
						if(file.valid_file=='yes')
						{
							if(file.extension=='pdf' || file.extension=='psd' || file.extension=='doc' || file.extension=='docx' )
							{
							
							$('#files').append('<section style="position:relative;" class="'+ran+'">'+file.name+'<span onclick="delete_image_section(&#39;'+ran+'&#39;)" class="image_delete_cross" style="margin-left:5px">&#120;</span><input type="hidden" name="images_names[]" value="'+file.name+'" class="images_names"></section>');
							}
							else
							{
						$('#files').append('<section style="position:relative; float:left;" class="'+ran+'"><img src="<?php echo base_url()?>uploads/email_attachement/'+file.name+'" class="img_responsive" style="width:100px; float:left"/><span onclick="delete_image_and_section(&#39;'+ran+'&#39;, &#39;'+res[0]+'&#39;, &#39;'+res[1]+'&#39;, &#39;email_attachement&#39;, &#39;email_attachment_files&#39;)" class="image_delete_cross" >&#120;</span><input type="hidden" name="images_names[]" value="'+file.name+'" class="images_names"></section>');
							}
						}
						else
						{
							$('#files').append('<section style="position:relative; float:left;" class="'+ran+'"><span class="label label-warning">'+file.name+'</span><span onclick="delete_image_section(&#39;'+ran+'&#39;)" class="image_delete_cross" style="margin-left:5px">&#120;</span></section>');
						}
					});
				},
				progressall: function (e, data) 
				{
					$("#progress").show();
					$("#progress_loading").show();
					var progress = parseInt(data.loaded / data.total * 100, 10);
					$('#progress .progress-bar').css(
						'width',
						progress + '%'
					);
						if(progress>99){ setTimeout(function(){ $("#progress, #progress_loading").css( 'display', 'none'); }, 3000); }
				}
			}).prop('disabled', !$.support.fileInput)
		    .parent().addClass($.support.fileInput ? undefined : 'disabled');
		
	
	});
	
	
	
	function delete_image()
	{
		$('#featured_image').val('0');
		$('#img_featured').html('');
	}
	
	function edit_field(id, table, field, current_value_id)
	{
		var current_value = $('#'+current_value_id).html();
		var postData={ 
						id				  :id,
						table			  :table,
						field  			  :field,
						current_value_id  :current_value_id,
						current_value	  :current_value
					 }
			$.ajax({
			type: 'POST',
			data: postData,
			url: '<?php echo base_url();?>admin/edit_field',
			success: function(result){
					$('#'+current_value_id).html(result);
			}
			});
	}
	function edit_field_value(id, field, changed_name, table,current_value_id )
	{
		$('#'+current_value_id).html('');
		//alert('feild = '+field+', change_id = '+change_id+', lead_id = '+ lead_id+', targettable = '+ targettable+', target_table_name = '+ target_table_name);
		var postData={ 
				id				:id,
				field			:field,
				table			:table,
				changed_name	:changed_name
				}
			$.ajax({
			type: 'POST',
			data: postData,
			url: '<?php echo base_url();?>admin/edit_field_value',
			success: function(result){
					$('#'+current_value_id).html(result);
				}});
	}
//Delete
	function callCrudAction(table,id,controller,image_url,image_folder,video_url) {
		image_url = image_url || 0;
		image_folder = image_folder || 0;
		video_url = video_url || 0;
		if (confirm('Are you sure?')) {
			queryString = 'table='+table+'&id='+ id+'&image_url='+ image_url+'&image_folder='+ image_folder;
			
			jQuery.ajax({
			url: "<?php echo base_url()?>admin/"+controller,
			data:queryString,
			type: "POST",
			success:function(data){
				window.location.reload();
			},
		
			error:function (){
			}
		});
	} else {
           return false;
       }
	}

	
	function delete_image_section(classname)
	{
		$('.'+classname).remove();
	}
	
	function delete_image_and_section(classname, imagename, imageextention, imagefolder, table)
	{
		$('.'+classname).remove();
		var postData={ 
						imagefolder			:imagefolder,
						imagename			:imagename,
						imageextention		:imageextention,
						table				:table,
					 }
		$.ajax({
			type: 'POST',
			data: postData,
			url: '<?php echo base_url().'home/delete_image_and_section/'; ?>', 
			success: function(result){
			  
			}
		});
	}
function change_stores(id)
{
	var postData={
		id				:id
	}
	$.ajax({
		type: 'POST',
		data: postData,
		url: '<?php echo base_url();?>admin/change_stores',
		success: function(result){
			$('.stores_markup').html(result);
		}});
}
</script>
