<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	
	var $data;
	var $admin_id;
	var $access_level;
	var $url;

	public function __construct(){

		parent::__construct();
		
		$this->admin_id=$this->session->userdata('');
		$this->access_level=$this->session->userdata('access_level');
		$this->load->model('Generic_model');
		$protocol = explode('/',$_SERVER['SERVER_PROTOCOL']);
		$this->url = urlencode($protocol[0]."://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
	}
	
	public function index()
	{
 		if($this->session->userdata('admin_id')!=""){
			redirect('admin/dashboard');
		}
		$this->data['title']='Admin | Log in';
		$this->load->view('admin/login',$this->data);
	}
	
	/******************************************************************************************/
	//////////////////////////////////////////// LOGIN /////////////////////////////////////////
	/******************************************************************************************/

	public function check_login(){
		//echo 'success';
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		if($email=="admin@admin.com" && $password=="admin"){
			$data = array(
				'admin_id'     	  => '1',
				'access_level'    => '1',
				'admin_name'   	  => 'name'
			);
			$this->session->set_userdata($data);
			echo 'active';
		} else {
			echo 'fail';
		}
	}
	
	
	
	/******************************************************************************************/
	//////////////////////////////////////// END LOGIN /////////////////////////////////////////
	/******************************************************************************************/
	
	
	
	public function dashboard()
	{

		if(empty($this->session->userdata('admin_id'))){
			redirect(base_url()."admin?next=".$this->url); }
		
		$this->data['title']='Admin | Dashboard';
		//$this->data['condos']=$this->Generic_model->select('condos');
		$this->data['view']='admin/dashboard';
		$this->load->view('admin/template/main',$this->data);
	}
    public function products()
    {
        if(empty($this->session->userdata('admin_id'))){
            redirect(base_url()."admin?next=".$this->url); }

        $this->data['products']=$this->Generic_model->select('products');
        $this->data['title']='Admin | Products';
        $this->data['view']='admin/products';
        $this->load->view('admin/template/main',$this->data);
    }
    public function add_product()
    {
        if(empty($this->session->userdata('admin_id'))){
            redirect(base_url()."admin?next=".$this->url); }
        $this->data['users']= $this->Generic_model->select('users');
        $this->data['stores']= $this->Generic_model->select('stores');
        if(isset($_POST['add_product']))
        {
            $this->load->library('upload');
            $files = $_FILES;
            $cpt = $_FILES['file']['name'];
            $original_filename = '';
            //&&  strtolower(pathinfo($_FILES['files']['name'], PATHINFO_EXTENSION))!='pdf'
            if($_FILES['file']['name']!= '' )
            {
                $upload_path = "uploads/product_images/";
                $file_type = "gif|jpg|jpeg|png";
                $this->upload->initialize($this->set_upload_options($upload_path, $file_type));

                if($this->upload->do_upload('file'))
                {
                    $uploaddata = $this->upload->data();
                    $result['filename'] = $uploaddata['file_name'];
                    $original_filename = $result['filename'];

                    $DbFieldsArray =  array('image'=>$original_filename,
                        'slug'=>$this->createslug($_POST['name'], 'products'),
                        'name'=>$_POST['name'],
                        'description'=>$_POST['description'],
                        'user_id'=>$_POST['user'],
                        'store_id'=>$_POST['store']);
                    $id = $this->Generic_model->insert($DbFieldsArray, 'products');
                    //echo $image_url;

                    //resize image if size much big
                    list($width, $height) = getimagesize("uploads/product_images/".$original_filename);
                    if($width > "1000" || $height > "1000") {
                        $config = array('image_library'=>'gd2',
                            'source_image'=>'uploads/product_images/'.$original_filename,
                            'maintain_ratio'=>TRUE,
                            'width'=>'1000',
                            'height'=>'1000',);
                        $this->load->library('image_lib', $config);
                        $this->image_lib->initialize($config);
                        $this->image_lib->resize();
                    }
                    //resizeimage ends
                    $this->session->set_flashdata("message","<div class='alert alert-info'>Product Added Successfully.</div>");

                }
                else
                {
                    $this->session->set_flashdata("message","<div class='alert alert-danger'>Product adding faild.</div>");
                    echo "not uploaded";
                }
            }
            redirect(base_url()."admin/products");
        }


        $this->data['title']='Admin | Add product ';
        $this->data['view']='admin/add_product';
        $this->load->view('admin/template/main',$this->data);
    }
    public function edit_product($id)
    {
        if(empty($this->session->userdata('admin_id'))){
            redirect(base_url()."admin?next=".$this->url); }
        $this->data['product_info']= $this->Generic_model->select_one('products','*',"id=".$id);
        $this->data['users']= $this->Generic_model->select('users');
        $this->data['stores']= $this->Generic_model->select('stores','*',"user_id=".$this->data['product_info']['user_id']);
        if(isset($_POST['edit_product']))
        {
            $this->load->library('upload');
            $files = $_FILES;
            $cpt = $_FILES['file_1']['name'];
            $original_filename = $this->data['product_info']['image'];
            //&&  strtolower(pathinfo($_FILES['files']['name'], PATHINFO_EXTENSION))!='pdf'
            if($_FILES['file_1']['name']!= '' )
            {
                $upload_path = "uploads/product_images/";
                $file_type = "gif|jpg|jpeg|png";
                $this->upload->initialize($this->set_upload_options($upload_path, $file_type));

                if($this->upload->do_upload('file_1'))
                {
                    $uploaddata = $this->upload->data();
                    $result['filename'] = $uploaddata['file_name'];
                    $original_filename = $result['filename'];


                    //echo $image_url;

                    //resize image if size much big
                    list($width, $height) = getimagesize("uploads/product_images/".$original_filename);
                    if($width > "1000" || $height > "1000") {
                        $config = array('image_library'=>'gd2',
                            'source_image'=>'uploads/product_images/'.$original_filename,
                            'maintain_ratio'=>TRUE,
                            'width'=>'1000',
                            'height'=>'1000',);
                        $this->load->library('image_lib', $config);
                        $this->image_lib->initialize($config);
                        $this->image_lib->resize();
                    }
                    //resizeimage ends
                    $this->session->set_flashdata("message","<div class='alert alert-info'>Product Added Successfully.</div>");

                }
                else
                {
                    $this->session->set_flashdata("message","<div class='alert alert-danger'>Product adding faild.</div>");
                    echo "not uploaded";
                }
            }
            $DbFieldsArray =  array('image'=>$original_filename,
                'name'=>$_POST['name'],
                'description'=>$_POST['description'],
                'user_id'=>$_POST['user'],
                'store_id'=>$_POST['store']);
            $this->Generic_model->update($DbFieldsArray, 'products',"id=".$id);
            redirect(base_url()."admin/products");
        }


        $this->data['title']='Admin | Edit product ';
        $this->data['view']='admin/edit_product';
        $this->load->view('admin/template/main',$this->data);
    }
    public function change_stores()
    {

        $id = $this->input->post('id');
        $stores=$this->Generic_model->select('stores',"*","user_id=$id");
        ?>
        <select class="form-control" id="store" name="store">
            <?php if(sizeof($stores)>0 && $stores!=false){foreach($stores as $store){?>
                <option value="<?php echo $store['id']?>"><?php echo $store['name']?></option>
            <?php }}?>
        </select>
        <?php
    }

    public function pages()
    {
        if(empty($this->session->userdata('admin_id'))){
            redirect(base_url()."admin?next=".$this->url); }

        $this->data['pages']=$this->Generic_model->select('pages');
        $this->data['title']='Admin | Pages';
        $this->data['view']='admin/pages';
        $this->load->view('admin/template/main',$this->data);
    }
    public function add_page()
    {
        if(empty($this->session->userdata('admin_id'))){
            redirect(base_url()."admin?next=".$this->url); }
        if(isset($_POST['add_page']))
        {
            $this->load->library('upload');
            $files = $_FILES;
            $cpt = $_FILES['file']['name'];
            $original_filename = '';
            //&&  strtolower(pathinfo($_FILES['files']['name'], PATHINFO_EXTENSION))!='pdf'
            if($_FILES['file']['name']!= '' )
            {
                $upload_path = "uploads/pages_images/";
                $file_type = "gif|jpg|jpeg|png";
                $this->upload->initialize($this->set_upload_options($upload_path, $file_type));

                if($this->upload->do_upload('file'))
                {
                    $uploaddata = $this->upload->data();
                    $result['filename'] = $uploaddata['file_name'];
                    $original_filename = $result['filename'];

                    //resize image if size much big
                    list($width, $height) = getimagesize("uploads/pages_images/".$original_filename);
                    if($width > "1000" || $height > "1000") {
                        $config = array('image_library'=>'gd2',
                            'source_image'=>'uploads/pages_images/'.$original_filename,
                            'maintain_ratio'=>TRUE,
                            'width'=>'1000',
                            'height'=>'1000',);
                        $this->load->library('image_lib', $config);
                        $this->image_lib->initialize($config);
                        $this->image_lib->resize();
                    }
                    //resizeimage ends
                    $this->session->set_flashdata("message","<div class='alert alert-info'>Page Added Successfully.</div>");

                }
                else
                {
                    $this->session->set_flashdata("message","<div class='alert alert-danger'>Page adding faild.</div>");
                    echo "not uploaded";
                }
            }
            $DbFieldsArray =  array('image'=>$original_filename,
                'slug'=>$this->createslug($_POST['name'], 'pages'),
                'title'=>$_POST['name'],
                'description'=>$_POST['description']);
            $id = $this->Generic_model->insert($DbFieldsArray, 'pages');
            redirect(base_url()."admin/pages");
        }


        $this->data['title']='Admin | Add Page ';
        $this->data['view']='admin/add_page';
        $this->load->view('admin/template/main',$this->data);
    }
    public function edit_page($id)
    {
        if(empty($this->session->userdata('admin_id'))){
            redirect(base_url()."admin?next=".$this->url); }
        $this->data['page_info']= $this->Generic_model->select_one('pages','*',"id=".$id);


        if(isset($_POST['edit_page']))
        {
            $this->load->library('upload');
            $files = $_FILES;
            $cpt = $_FILES['file_1']['name'];
            $original_filename = $this->data['page_info']['image'];
            //&&  strtolower(pathinfo($_FILES['files']['name'], PATHINFO_EXTENSION))!='pdf'
            if($_FILES['file_1']['name']!= '' )
            {
                $upload_path = "uploads/pages_images/";
                $file_type = "gif|jpg|jpeg|png";
                $this->upload->initialize($this->set_upload_options($upload_path, $file_type));

                if($this->upload->do_upload('file_1'))
                {
                    $uploaddata = $this->upload->data();
                    $result['filename'] = $uploaddata['file_name'];
                    $original_filename = $result['filename'];

                    //resize image if size much big
                    list($width, $height) = getimagesize("uploads/pages_images/".$original_filename);
                    if($width > "1000" || $height > "1000") {
                        $config = array('image_library'=>'gd2',
                            'source_image'=>'uploads/pages_images/'.$original_filename,
                            'maintain_ratio'=>TRUE,
                            'width'=>'1000',
                            'height'=>'1000',);
                        $this->load->library('image_lib', $config);
                        $this->image_lib->initialize($config);
                        $this->image_lib->resize();
                    }
                    //resizeimage ends
                    $this->session->set_flashdata("message","<div class='alert alert-info'>Page Edited Successfully.</div>");

                }
                else
                {
                    $this->session->set_flashdata("message","<div class='alert alert-danger'>Page Edition faild.</div>");
                    echo "not uploaded";
                }
            }
            $DbFieldsArray =  array('image'=>$original_filename,
                'title'=>$_POST['name'],
                'description'=>$_POST['description']);
            $id = $this->Generic_model->update($DbFieldsArray, 'pages',"id=".$id);
            redirect(base_url()."admin/pages");
        }
        $this->data['title']='Admin | Edit Page ';
        $this->data['view']='admin/edit_page';
        $this->load->view('admin/template/main',$this->data);
    }


    public function videos()
    {
        if(empty($this->session->userdata('admin_id'))){
            redirect(base_url()."admin?next=".$this->url); }

        $this->data['videos']=$this->Generic_model->select('videos');
        $this->data['title']='Admin | Videos';
        $this->data['view']='admin/videos';
        $this->load->view('admin/template/main',$this->data);
    }
    /*public function add_video()
    {
        if(empty($this->session->userdata('admin_id'))){
            redirect(base_url()."admin?next=".$this->url); }
        $this->data['videos']= $this->Generic_model->select('videos');
        if(isset($_POST['add_video']))
        {
            $this->load->library('upload');
            $files = $_FILES;
            $cpt = $_FILES['file']['name'];
            $original_filename = '';
            //&&  strtolower(pathinfo($_FILES['files']['name'], PATHINFO_EXTENSION))!='pdf'
            if($_FILES['file']['name']!= '' )
            {
                $upload_path = "uploads/uploaded_videos/";
                $file_type = "gif|jpg|jpeg|png";
                $this->upload->initialize($this->set_upload_options($upload_path, $file_type));

                if($this->upload->do_upload('file'))
                {
                    $uploaddata = $this->upload->data();
                    $result['filename'] = $uploaddata['file_name'];
                    $original_filename = $result['filename'];

                    $DbFieldsArray =  array('image'=>$original_filename,
                        'slug'=>$this->createslug($_POST['name'], 'stores'),
                        'name'=>$_POST['name'],
                        'description'=>$_POST['description'],
                        'user_id'=>$_POST['user']);
                    $id = $this->Generic_model->insert($DbFieldsArray, 'stores');
                    //resize image if size much big
                    list($width, $height) = getimagesize("uploads/uploaded_videos/".$original_filename);
                    if($width > "1000" || $height > "1000") {
                        $config = array('image_library'=>'gd2',
                            'source_image'=>'uploads/uploaded_videos/'.$original_filename,
                            'maintain_ratio'=>TRUE,
                            'width'=>'1000',
                            'height'=>'1000',);
                        $this->load->library('image_lib', $config);
                        $this->image_lib->initialize($config);
                        $this->image_lib->resize();
                    }
                    //resizeimage ends
                    $this->session->set_flashdata("message","<div class='alert alert-info'>Videos Added Successfully.</div>");
                }
                else
                {
                    $this->session->set_flashdata("message","<div class='alert alert-danger'>Video adding faild.</div>");
                    echo "not uploaded";
                }
            }
            redirect(base_url()."admin/videos");
        }
        $this->data['title']='Admin | Add Video';
        $this->data['view']='admin/add_video';
        $this->load->view('admin/template/main',$this->data);
    }*/
    public function edit_video($id)
    {
        if(empty($this->session->userdata('admin_id'))){
            redirect(base_url()."admin?next=".$this->url); }
        $this->data['video_info']    = $this->Generic_model->select_one('videos','*',"id=".$id);
        $this->data['users']         = $this->Generic_model->select('users');
        $this->data['video_comments']= $this->Generic_model->select('video_comments','*', "video_id=".$id);
        if(isset($_POST['edit_store_btn'])){
            $this->load->helper('string');
            $password = random_string('alnum', 8);

            $this->load->library('upload');
            $files = $_FILES;
            $cpt = $_FILES['file_1']['name'];
            $original_filename = $this->data['video_info']['poster'];
            //&&  strtolower(pathinfo($_FILES['files']['name'], PATHINFO_EXTENSION))!='pdf'
            if($_FILES['file_1']['name']!= '' )
            {
                $upload_path = "uploads/uploaded_videos/";
                $file_type = "gif|jpg|jpeg|png";
                $this->upload->initialize($this->set_upload_options($upload_path, $file_type));

                if($this->upload->do_upload('file_1'))
                {
                    $uploaddata = $this->upload->data();
                    $result['filename'] = $uploaddata['file_name'];
                    $original_filename = $result['filename'];
                    //resize image if size much big
                    list($width, $height) = getimagesize("uploads/uploaded_videos/".$original_filename);
                    if($width > "1000" || $height > "1000") {
                        $config = array('image_library'=>'gd2',
                            'source_image'=>'uploads/uploaded_videos/'.$original_filename,
                            'maintain_ratio'=>TRUE,
                            'width'=>'1000',
                            'height'=>'1000',);
                        $this->load->library('image_lib', $config);
                        $this->image_lib->initialize($config);
                        $this->image_lib->resize();
                    }
                    //resizeimage ends


                }
                else
                {

                    echo "not uploaded";
                }
            }
            //echo $original_filename;exit;
            $DbFieldsArray =  array('poster'=>$original_filename,
                'title'=>$_POST['title'],
                'description'=>$_POST['description'],
                'user_id'=>$_POST['user']);

            $this->Generic_model->update($DbFieldsArray, 'videos', "id=".$id);
            $this->session->set_flashdata("message","<div class='alert alert-info'>Updated Successfully.</div>");
            redirect(base_url()."admin/videos");
        }
        $this->data['title']='Admin | Update Video ';
        $this->data['view']='admin/edit_video';
        $this->load->view('admin/template/main',$this->data);
    }
    public function edit_comment($id,$video_id)
    {
        if(empty($this->session->userdata('admin_id'))){
            redirect(base_url()."admin?next=".$this->url); }
        $this->data['comment_info']    = $this->Generic_model->select_one('video_comments','*',"id=".$id);
        if(isset($_POST['edit_comment_btn'])){
            $DbFieldsArray =  array(
                'comment'=>$_POST['comment']);

            $this->Generic_model->update($DbFieldsArray, 'video_comments', "id=".$id);
            $this->session->set_flashdata("message","<div class='alert alert-info'>Updated Successfully.</div>");
            redirect(base_url()."admin/edit_video/".$video_id);
        }
        $this->data['title']='Admin | Update Comment ';
        $this->data['view']='admin/edit_comment';
        $this->load->view('admin/template/main',$this->data);
    }

	public function users()
	{
		if(empty($this->session->userdata('admin_id'))){
			redirect(base_url()."admin?next=".$this->url); }

		$this->data['users']=$this->Generic_model->select('users');
		$this->data['title']='Admin | Users';
		$this->data['view']='admin/users';
		$this->load->view('admin/template/main',$this->data);
	}
	public function add_user()
	{
		if(empty($this->session->userdata('admin_id'))){
			redirect(base_url()."admin?next=".$this->url); }

		if(isset($_POST['add_user_btn'])){
			$this->load->helper('string');
			$password = random_string('alnum', 8);

			$this->load->library('upload');
			$files = $_FILES;
			$cpt = $_FILES['file']['name'];
			$original_filename = '';
			//&&  strtolower(pathinfo($_FILES['files']['name'], PATHINFO_EXTENSION))!='pdf'
			if($_FILES['file']['name']!= '' )
			{
				$upload_path = "uploads/profile_images/";
				$file_type = "gif|jpg|jpeg|png";
				$this->upload->initialize($this->set_upload_options($upload_path, $file_type));

				if($this->upload->do_upload('file'))
				{
					$uploaddata = $this->upload->data();
					$result['filename'] = $uploaddata['file_name'];
					$original_filename = $result['filename'];

					$DbFieldsArray =  array('name'=>$_POST['name'],
                        'user_name'=>$_POST['user_name'],
                        'image'=>$original_filename,
                        'email'=>$_POST['email_reg'],
                        'phone'=>$_POST['phone'],
                        'password'=>md5($_POST['password_reg']),
                        'status'=>0);
					$id = $this->Generic_model->insert($DbFieldsArray, 'users');


					//echo $image_url;

					//resize image if size much big
					list($width, $height) = getimagesize("uploads/profile_images/".$original_filename);
					if($width > "1000" || $height > "1000") {
						$config = array('image_library'=>'gd2',
							'source_image'=>'uploads/profile_images/'.$original_filename,
							'maintain_ratio'=>TRUE,
							'width'=>'1000',
							'height'=>'1000',);
						$this->load->library('image_lib', $config);
						$this->image_lib->initialize($config);
						$this->image_lib->resize();
					}
					//resizeimage ends
					$this->session->set_flashdata("message","<div class='alert alert-info'>Registered Successfully.</div>");
					redirect(base_url()."admin/users");

				}
				else
				{
					$this->session->set_flashdata("message","<div class='alert alert-danger'>Registration faild.</div>");
					echo "not uploaded";
				}
			}

		}

		$this->data['title']='admin | Add User ';
		$this->data['view']='admin/add_user';
		$this->load->view('admin/template/main',$this->data);
	}
	public function edit_user($id)
	{
		if(empty($this->session->userdata('admin_id'))){
			redirect(base_url()."admin?next=".$this->url); }
        $this->data['user_info']= $this->Generic_model->select_one('users','*',"id=".$id);
		if(isset($_POST['edit_user_btn'])){
			$this->load->helper('string');
			$password = random_string('alnum', 8);

			$this->load->library('upload');
			$files = $_FILES;
			$cpt = $_FILES['file_1']['name'];
			$original_filename = $this->data['user_info']['image'];
			//&&  strtolower(pathinfo($_FILES['files']['name'], PATHINFO_EXTENSION))!='pdf'
			if($_FILES['file_1']['name']!= '' )
			{
				$upload_path = "uploads/profile_images/";
				$file_type = "gif|jpg|jpeg|png";
				$this->upload->initialize($this->set_upload_options($upload_path, $file_type));

				if($this->upload->do_upload('file_1'))
				{
					$uploaddata = $this->upload->data();
					$result['filename'] = $uploaddata['file_name'];
					$original_filename = $result['filename'];
					//resize image if size much big
					list($width, $height) = getimagesize("uploads/profile_images/".$original_filename);
					if($width > "1000" || $height > "1000") {
						$config = array('image_library'=>'gd2',
							'source_image'=>'uploads/profile_images/'.$original_filename,
							'maintain_ratio'=>TRUE,
							'width'=>'1000',
							'height'=>'1000',);
						$this->load->library('image_lib', $config);
						$this->image_lib->initialize($config);
						$this->image_lib->resize();
					}
					//resizeimage ends


				}
				else
				{

					echo "not uploaded";
				}
			}
            $DbFieldsArray =  array('name'=>$_POST['name'],
                'user_name'=>$_POST['user_name'],
                'image'=>$original_filename,
                'email'=>$_POST['email_reg'],
                'phone'=>$_POST['phone']);
            if($_POST['password_reg_1']!=''){ $DbFieldsArray['password']=md5($_POST['password_reg_1']);}
            $this->Generic_model->update($DbFieldsArray, 'users', "id=".$id);
            $this->session->set_flashdata("message","<div class='alert alert-info'>Updated Successfully.</div>");
            redirect(base_url()."admin/users");
		}


		$this->data['title']='Admin | Update User ';
		$this->data['view']='admin/edit_user';
		$this->load->view('admin/template/main',$this->data);
	}

    public function categories()
    {
        if(empty($this->session->userdata('admin_id'))){
            redirect(base_url()."admin?next=".$this->url); }

        $this->data['categories']=$this->Generic_model->select('categories','*');
        $this->data['title']='Admin | Categories';
        $this->data['view']='admin/categories';
        $this->load->view('admin/template/main',$this->data);
    }
    public function add_category()
    {
        if(empty($this->session->userdata('admin_id'))){
            redirect(base_url()."admin?next=".$this->url); }

        if(isset($_POST['add_catgory_btn'])){
            $DbChangeArray =  array('title'=>$_POST['title'],'description'=>$_POST['description'], 'slug'=>$_POST['slug']);
            $this->Generic_model->insert($DbChangeArray,'categories');
            redirect(base_url()."admin/categories");
        }

        $this->data['title']='admin | Add Category ';
        $this->data['view']='admin/add_category';
        $this->load->view('admin/template/main',$this->data);
    }
    public function edit_category($id)
    {
        if(empty($this->session->userdata('admin_id'))){
            redirect(base_url()."admin?next=".$this->url); }
        $this->data['category_info']= $this->Generic_model->select_one('categories','*',"id=".$id);

        if(isset($_POST['add_catgory_btn'])){
            $this->load->helper('string');
            $password = random_string('alnum', 8);

            $this->load->library('upload');
            $files = $_FILES;
            $cpt = $_FILES['file_1']['name'];

            $DbChangeArray =  array('title'=>$_POST['title'],'description'=>$_POST['description'], 'slug'=>$_POST['slug']);
            $this->Generic_model->update($DbChangeArray, 'categories', "id=".$id);
            $this->session->set_flashdata("message","<div class='alert alert-info'>Registered Successfully.</div>");
            redirect(base_url()."admin/categories");
        }
        $this->data['title']='admin | Edit Category ';
        $this->data['view']='admin/edit_category';
        $this->load->view('admin/template/main',$this->data);
    }


    public function server_settings()
    {
        if(empty($this->session->userdata('admin_id'))){
            redirect(base_url()."admin?next=".$this->url); }
        $this->data['server_info']= $this->Generic_model->select_one('settings','*',"name='server'");

        if(isset($_POST['edit_server_btn'])){
            $DbChangeArray =  array('value'=>$_POST['server']);
            $this->Generic_model->update($DbChangeArray, 'settings', "name='server'");
            $this->session->set_flashdata("message","<div class='alert alert-info'>Ultered Successfully.</div>");
            redirect(base_url()."admin/server_settings");
        }
        $this->data['title']='Admin | Server Settings ';
        $this->data['view']='admin/server_settings';
        $this->load->view('admin/template/main',$this->data);
    }

    public function createslug($keyword, $table,$slugfield='slug', $increment=1){
        $keyword = trim($keyword);
        $keyword = str_replace (" ","", $keyword);
        $rows = $this->Generic_model->select($table,$slugfield, "$slugfield='$keyword'");
        if ($rows!=false) {
            $keyword.=$increment;
            return  $this->createslug($keyword, $table, $slugfield,$increment);
        }
        else{
            //echo $keyword;
            return $keyword;
        }
    }
    public function delete_data()
	{
		$get_email_data = $this->Generic_model->delete($_POST['table'],"id=".$_POST['id']);
        if($_POST['table']=='users')
        {
            $this->Generic_model->delete('videos',"user_id=".$_POST['id']);
            $this->Generic_model->delete('video_comments',"user_id=".$_POST['id']);
            $this->Generic_model->delete('video_feedback',"user_id=".$_POST['id']);
        }
        if($_POST['table']=='videos')
        {
            $this->Generic_model->delete('video_comments',"video_id=".$_POST['id']);
            $this->Generic_model->delete('video_feedback',"video_id=".$_POST['id']);
        }
		//echo $this->db->last_query();
		if(isset($_POST['image_url']) && $_POST['image_url']!='0' && isset($_POST['image_folder']) && $_POST['image_folder']!='0')
		{
            $filename = pathinfo($_POST['image_url'], PATHINFO_FILENAME);
			$file = dirname(dirname(dirname(__FILE__)))."/uploads/".$_POST['image_folder']."/".$filename;
            $extentions = array('.mp4','.jpg','.png','.mkv','.flv','.3gp','.jif');
            foreach($extentions as $etx)
            {
                unlink($file.$etx);
            }
		}

	}
	public function set_upload_options($upload_path, $file_type){
		// upload image options
		$config = array();
		$config['upload_path'] = $upload_path;
		$config['allowed_types'] = $file_type;
		$config['overwrite']     = FALSE;
		return $config;
	}
	
	public function verify_user($verification_code_id, $verification_code_email){
		$verification_code_id_decode = base64_decode($verification_code_id);
		$where = "id = '$verification_code_id_decode' and verify_code = '$verification_code_email'";
		$action = "status = 1";
		if($this->Generic_model->update_data_using_multiwhere($where, $action, 'condo_admins')){
			$this->data['verify_data'] = 'VERIFIED';
			$row = $this->Generic_model->get_data_row_using_where('condo_admins', $action);
			//second email
				$subject_second = "Your community platform is created - Successful Registration";
				$message_second = "<div style='".$this->config->item('style')."'>Hi ".$row->name."!  <br /><br />
				
                Thank you for signing up with ALIA.<br/><br/>
				
				We are happy to have you on this journey towards building a smarter, safer, and sustainable community.<br/><br/>
				
				Our mission is to help you simplify your property management matters so that you can get things done with less work.<br/><br/>
				
				<h3>GETTING STARTED</h3> <br/><br/>

				Training will be provided to your management team so that they fully understand and utilize the<br/>
				benefits of ALIA. We invite you to complete the following details and confirm your training<br/>
				session with us as soon as possible. Please reply via email to marrcuss.lim@als.com.my or you<br/>
				can call 03-26315655 to confirm your training. <br/><br/>
				
				<h3>System Training (for Residence Managers and Admin)</h3> <br/><br/>

				Date and Time 			: 			<br/>
				(Preferably within 7 days from today)<br/>
				Venue					: 			<br/>
				Number of people attending		:	<br/><br/>
				
				
				<h4>Please prepare the following before the training:</h4><br/>
				1.	You must bring your own laptop or computer.<br/>
				2.	Please make sure you have the following images (jpeg,png format only):<br/>
				•	Residence Profile Picture<br/>
				•	Residence Logo<br/>
				•	Pictures of Residence Facilities<br/>
				•	Residents list (unit, name, email, contact number)<br/><br/>
				
				Kindly ensure all relevant Residence Managers and Admin persons attend this training because<br/>
				this training is only provided ONCE. The training will take approximately 2 hours.<br/><br/>
				
				
				<h3>Training Agenda:</h3> <br/><br/>
				1.	Account Setup <br/>
				2.	Residence Settings – Blocks, Levels, Units<br/>
				3.	We will guide you how to use each service.<br/>
				4.	Run through simulations to make sure you know how to use each function.<br/><br/>
				
				We appreciate all attendees to come on time so that we can provide you with the best training <br/>
				experience and benefit from your community platform.<br/><br/>
				
				Thank you and we look forward to seeing everyone at the training.<br/><br/>
				";
				//Send Email to Condo Admin
				$this->email($condo_admin_email, $condo_admin_name, $subject_second, $message_second);
		} else {
			$this->data['verify_data'] = 'PROBLEM';
		}
		
		
		$this->data['title']='admin | Verify User';
		$this->load->view('admin/verify_user',$this->data);
	}

	public function change_password(){
		if($this->session->userdata('admin_id')==""){
			redirect('admin'.'?next='.urlencode(base_url().'admin/change_password'));
		}
		
		if(isset($_POST['changepasssub'])){
			$id 				= $this->input->post('id');
			$new_password 		= $this->input->post('new_password');
			
		$DbFieldsArray 		= array('password');
		$DataArray = array(md5($new_password));
		$this->Generic_model->updateData($id,'id',$DbFieldsArray,$DataArray,'admin');
		redirect('admin/change_password');
		}
		
		$this->data['title']='admin | Change Password';
		$action = "id = '$this->admin_id'";
		$this->data['admin_info']= $this->Generic_model->get_data_row_using_where('admin', $action);
		$this->data['view']='admin/change_password';
		$this->load->view('admin/template/main',$this->data);
	}
	
	public function forgot_password(){
				$email 		= $this->input->post('email_forgot');
			
			if($email!=""){
				//Grab Condo Admin info
				$action = "email = '$email'";
				$condo_info_admins = $this->Generic_model->get_data_row_using_where('admin',$action);
				$condo_admin_name_id = $condo_info_admins->id;
				$condo_admin_name_admins = $condo_info_admins->full_name;
				
				$DbFieldsArray 		= array('forgot_pass_count');
				$DataArray = array('0');
				$this->Generic_model->updateData($email,'email',$DbFieldsArray,$DataArray,'admin');
				
				$verification_code_id = base64_encode($condo_admin_name_id);
				$verification_code_email = md5($email);
				$verification_link = base_url()."admin/forgot_password_change/".$verification_code_id."/".$verification_code_email;
				
				//Collect Email Data
				$subject = "Reset Password Link";
				$message = "<div style='".$this->config->item('style')."'>Dear ".$condo_admin_name_admins.", <br /><br />
				You have requested to reset your password.<br/><br/>

				Click on the link below to change your password.<br/>
				".$verification_link."<br/><br/>
				
				</div>
				";

				//Send Forgot Password Link
				$this->email($email, $condo_admin_name_admins, $subject, $message);
				echo 'LINKSENT';
				}
		
	}
	
	public function forgot_password_change($verification_code_id, $verification_code_email){
		$verification_code_id_decode = base64_decode($verification_code_id);
		$where = "id = '$verification_code_id_decode' and verify_code = '$verification_code_email'";
		//Grab Condo Admin Forgot Password Link Count info
		$action = "id = '$verification_code_id_decode'";
		$condo_info_admins = $this->Generic_model->get_data_row_using_where('admin',$action);
		$condo_forgot_pass_count = $condo_info_admins->forgot_pass_count;
		
		$condo_forgot_pass_final_count = $condo_forgot_pass_count + 1;
		$action_to_be_filled = "forgot_pass_count = '$condo_forgot_pass_final_count'";
		if($get_key_id = $this->Generic_model->update_data_using_multiwhere_custom($where, $action_to_be_filled, 'admin')){
			$this->data['verify_data'] = $get_key_id;
		} else {
			$this->data['verify_data'] = 'USED';
		}
		
		if(isset($_POST['forgotpasssubbutton'])){
			$id 				= $this->input->post('id');
			$new_password 		= $this->input->post('password');
			
		$DbFieldsArray 		= array('password');
		$DataArray = array(md5($new_password));
		$this->Generic_model->updateData($id,'id',$DbFieldsArray,$DataArray,'admin');
		redirect('admin');
		}
		
		$this->data['title']='admin | Forgot Password Change';
		$this->load->view('admin/forgot_password_change',$this->data);
	}

	public function email($to_email, $to_name, $subject, $message, $attachment=''){
	
		$config['protocol'] = 'sendmail';
		$config['mailpath'] = '/usr/sbin/sendmail';
		$config['charset'] = 'utf-8';
		$config['wordwrap'] = TRUE;
		$config['mailtype'] = 'html';
		$this->email->initialize($config);
		$msg_append = $message;
		$msg_append.=$this->config->item('email_footer');
		$this->data['view_data'] = $msg_append;
		$this->email->from($this->config->item('email_from'), $this->config->item('email_from_name'));
        $this->email->to($to_email); 
		$this->email->subject($subject);
		$msg = $this->load->view('admin/email_template/main',$this->data, TRUE);
		$this->email->message($msg);
		if($attachment!=''){ $this->email->attach($attachment); 
		}	
		$this->email->send();
	}
	


	public function do_logout(){
		$this->session->sess_destroy();
		$this->session->unset_userdata('admin_id');
		redirect(base_url()."admin");
	}
	
	}