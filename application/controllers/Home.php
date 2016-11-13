<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Generic_model');
	}
	public  function make_jpg($input, $output, $fromdurasec="01") {
		$ffmpegpath = "ffmpeg.exe";
		$input = "uploads/uploaded_videos/".$input;

		$output = 'uploads/uploaded_videos/'.$output;
		//if(!file_exists($input)) return false;

		$command = "$ffmpegpath -i $input -ss 00:00:01 -vframes 1  $output";
		@exec( $command, $ret ) ;


		//below code is for getting duration of video
		 if (file_exists($input)) {

			 $finfo = finfo_open(FILEINFO_MIME_TYPE);
			 $mime_type = finfo_file($finfo, $input); // check mime type
			 finfo_close($finfo);

			 if (preg_match('/video\/*/', $mime_type)) {

				 $video_attributes = $this->_get_video_attributes($input, $ffmpegpath);

				 //print_r('Codec: ' . $video_attributes['codec'] . '<br/>');
				 //print_r('Dimension: ' . $video_attributes['width'] . ' x ' . $video_attributes['height'] . ' <br/>');
				 //print_r('Size:  ' . $this->_human_filesize(filesize($vid)));

				 $Duration = $video_attributes['hours'] . ':' . $video_attributes['mins'] . ':'
					 . $video_attributes['secs'] ;//. '.' . $video_attributes['ms'] ;

			 } else {
				 $Duration = 'File is not a video.';
			 }
		 } else {
			 $Duration = 'File does not exist.';
		 }
		return $Duration;
	}
	function _get_video_attributes($video, $ffmpeg) {

		$command = $ffmpeg . ' -i ' . $video . ' -vstats 2>&1';
		$output = shell_exec($command);

		$regex_sizes = "/Video: ([^,]*), ([^,]*), ([0-9]{1,4})x([0-9]{1,4})/";
		if (preg_match($regex_sizes, $output, $regs)) {
			$codec = $regs [1] ? $regs [1] : null;
			$width = $regs [3] ? $regs [3] : null;
			$height = $regs [4] ? $regs [4] : null;
		}

		$regex_duration = "/Duration: ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2}).([0-9]{1,2})/";
		if (preg_match($regex_duration, $output, $regs)) {
			$hours = $regs [1] ? $regs [1] : null;
			$mins = $regs [2] ? $regs [2] : null;
			$secs = $regs [3] ? $regs [3] : null;
			$ms = $regs [4] ? $regs [4] : null;
		}

		return array('codec' => $codec,
			'width' => $width,
			'height' => $height,
			'hours' => $hours,
			'mins' => $mins,
			'secs' => $secs,
			'ms' => $ms
		);
	}

	function _human_filesize($bytes, $decimals = 2) {
		$sz = 'BKMGTP';
		$factor = floor((strlen($bytes) - 1) / 3);
		return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$sz[$factor];
	}

    public  function make_mp4($input, $output, $fromdurasec="01") {
        $ffmpegpath = "ffmpeg.exe";
        $input = "uploads/uploaded_videos/".$input;
        $output = 'uploads/uploaded_videos/'.$output;

        //$command = "$ffmpegpath -i $input -vcodec copy -acodec copy $output";
        $command = "$ffmpegpath -i $input -strict -2 -c:v h264 -c:a aac $output";

        //$command = "$ffmpegpath -i $input -c:v libx264 -crf 23 -preset medium -c:a libfdk_aac -vbr 4 \ -movflags +faststart -vf scale=-2:720,format=yuv420p $output";

        @exec( $command, $ret ) ;
        //echo "success";exit;
        return true;
    }

    public function video_uploads2()
	{
		$data = file_get_contents("php://input");
		$objData = json_decode($data);
		//print_r($objData);
		$title = $objData->data->title;
		$description = $objData->data->description;
		$category_id = $objData->data->category_id;
		$videofile = $objData->videofile;

		$data = array(
			'category_id' => $category_id,
			'title' => $title,
			'description' => $description,
			'path' => $videofile,
			'poster' => pathinfo($videofile, PATHINFO_FILENAME) . ".jpg",
			'created_at' => date('Y-m-d H:i:s'),
			'user_id' => $this->session->userdata('id'),
		);
		//$duration = $this->make_jpg($videofile, pathinfo($videofile,PATHINFO_FILENAME).".jpg");
		$duration = '13:47';
		$data['duration'] = $duration;
		$insert = $this->Generic_model->insert($data, 'videos');
		/* $video_extention =  pathinfo($videofile,PATHINFO_EXTENSION);

         if($video_extention!="mp4")
         {
             $data=array(
                 'path'        	  =>	pathinfo($videofile,PATHINFO_FILENAME).".mp4"
             );
             $this->Generic_model->update($data, 'videos',"id=".$insert);
             set_time_limit(1200000);
             $this->make_mp4($videofile, pathinfo($videofile,PATHINFO_FILENAME).".mp4");
         }*/
		$server = $this->Generic_model->get_data_value_using_where('settings', "name = 'server'", 'value');
		if ($server == 'remoteserver')
		{
			$uploadDir = 'uploads/uploaded_videos/';
			$uploadFile = $uploadDir . basename($objData->videofile);
			$uploadRequest = array(
				'fileName' => basename($uploadFile),
				'fileData' => base64_encode(file_get_contents($uploadFile))
			);
			// Execute remote upload
			$curl = curl_init();
			curl_setopt($curl, CURLOPT_URL, 'http://peeksport.com/demo/videos_anemi_junkies/');
			curl_setopt($curl, CURLOPT_TIMEOUT, 30);
			curl_setopt($curl, CURLOPT_POST, 1);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $uploadRequest);
			$response = curl_exec($curl);
			curl_close($curl);
			//echo $response;
			// Now delete local temp file
			//unlink($uploadFile);
		}
        echo $insert;
    }

	public function video_uploads()
	{
	    $original_filename = '';
		//upload video
		if(isset($_FILES['video']['name']) && !isset($_POST['upload_submit_btn'])) {
			$this->load->library('upload');
			$files = $_FILES;
			$cpt = $_FILES['video']['name'];
			if ($_FILES['video']['name'] != '') {

				$upload_path = "uploads/uploaded_videos/";
				$file_type = "3gp|flv|mkv|mp4";
				$this->upload->initialize(array('upload_path' => $upload_path,
					'allowed_types' => $file_type,
					'overwrite' => FALSE));
				if ($this->upload->do_upload('video')) {
					$uploaddata = $this->upload->data();
					$result['filename'] = $uploaddata['file_name'];
					$original_filename = $result['filename'];
                    //echo '<input type="hidden" name="videofile" ng-model="fields.videofile" value="' . $original_filename . '">';
                    echo  $original_filename;
					exit;
				}else {
                    echo   $this->upload->display_errors();
                }
			}
		}
		if(isset($_POST['upload_submit_btn'])){
			$data=array(
				'category_id'     =>	$this->input->post('category_id'),
				'title'      	  =>	$this->input->post('title'),
				'description'     =>	$this->input->post('description'),
				'path'        	  =>	$this->input->post('videofile'),
				'poster'          =>	pathinfo($this->input->post('videofile'),PATHINFO_FILENAME).".jpg",
				'created_at'      =>	date('Y-m-d H:i:s'),
				'user_id'         =>	$this->session->userdata('id'),
			);
			$insert = $this->Generic_model->insert($data, 'videos');
			$this->make_jpg($this->input->post('videofile'), pathinfo($this->input->post('videofile'),PATHINFO_FILENAME).".jpg");
            $video_extention =  pathinfo($this->input->post('videofile'),PATHINFO_EXTENSION);

            if($video_extention!="mp4")
            {
                $data=array(
                    'path'        	  =>	pathinfo($this->input->post('videofile'),PATHINFO_FILENAME).".mp4"
                );
                $this->Generic_model->update($data, 'videos',"id=".$insert);
                $this->make_mp4($this->input->post('videofile'), pathinfo($this->input->post('videofile'),PATHINFO_FILENAME).".mp4");
            }
			redirect(base_url());

		}
	}

	public function index()
	{
		//Account
		if(isset($_POST['account_submit_btn'])){
			$data=array(	  
					  'email'     =>	$this->input->post('email'),
					  );
					  $update = $this->Generic_model->update($data, 'users', "id=".$this->session->userdata('id'));
			    //delete account
				if(isset($_POST['delete_account'])){ $this->Generic_model->update('users', "id=".$this->session->userdata('id')); }
				redirect(base_url());
		}
		//Register
		if(isset($_POST['register_submit_btn'])){
			$data=array(
					  'name'      =>	$this->input->post('name'),	
					  'user_name'  =>	$this->createslug($_POST['name'], 'users','user_name'),
					  'email'     =>	$this->input->post('email'),
					  'password'  =>	md5($this->input->post('password')),
					  );
					  $insert = $this->Generic_model->addData_array($data, 'users');

			//login him after registration.
			$this->Generic_model->user_authentication_login($this->input->post('email'), $this->input->post('password'));
			//than redirect
			redirect(base_url()."#welcome");
		
		}

		$this->load->view('index');
		
	}
    public function createslug($keyword, $table,$slugfield='slug', $increment=1){
        $keyword = trim($keyword);
        $keyword = str_replace (" ","", $keyword);
        $keyword = str_replace ("/","", $keyword);
        $rows = $this->Generic_model->select($table,$slugfield, "$slugfield='$keyword'");
        if ($rows!=false) {
            $int = intval(preg_replace('/[^0-9]+/', '', $keyword), 10);
            $char = preg_replace('/[^A-Za-z]+/', '', $keyword);
            $int+=1;
            $keyword=$char.$int;
            return  $this->createslug($keyword, $table, $slugfield,$increment);
        }
        else{
            //echo $keyword;
            return $keyword;
        }
    }
	public function home_test(){
		echo 'Home Test';
		echo $this->uri->segment(2);
	}

	public function template($page){

		if(!empty($page)){
			if(($page=='uploadvideos' || $page=='meinevideos') && $this->session->userdata('id')=='')
			{
				$this->load->view('partials/notlogin');
			}
			else {
				$this->load->view('partials/' . $page);
			}
		}
	}


	public function get_categories(){
		$result['categories'] = $this->db->get('categories')->result_array();
		//print_r($result['categories']);
		echo json_encode($result);
	}
	
	
	public function get_videos($slug='',$hot=''){
		$video_query =" id>0 ";
		if(!empty($slug)) {
			$video_query = "category_id IN(select id from categories where slug='" . $slug . "') ";
		}
		if(!empty($hot))
		{
			$video_query .= " AND (created_at BETWEEN '".date('Y-m-d', strtotime('-7 days'))." 00:00:00' AND '".date('Y-m-d')." 23:59:59') ";
		}
		$result['videos'] = $this->Generic_model->select('videos','*',$video_query);
		//echo json_encode($result);
		foreach ($result['videos'] as $key => $field) {
			$target_dir = dirname(dirname(dirname(__FILE__))) . "/uploads/uploaded_videos/";
			$target_file = $target_dir . basename($field['poster']);
			if ($field['poster']=='' || !file_exists($target_file)) {
				//echo $field['poster'];exit;
				$result['videos'][$key]['poster'] = base_url()."assets/images/no-image-icon-6.jpg";
			}
			else{
				$result['videos'][$key]['poster'] = base_url()."uploads/uploaded_videos/".$field['poster'];
			}
		}
		echo json_encode($result);
	}
	public function get_single_videos($video_id=1){
		$result['videos'] = $this->Generic_model->select_one('videos','*',"id=".$video_id);
		$this->Generic_model->update(array('views'=>$result['videos']['views']+1),'videos',"id=".$video_id);
		//print_r($result['videos']);exit;


			$condition1 = "id=".$result['videos']['category_id'];
			$result['videos']['category'] = $this->Generic_model->get_data_value_using_where('categories',$condition1,"title");
			$condition2 = "id=".$result['videos']['user_id'];
			$result['videos']['user'] = $this->Generic_model->get_data_value_using_where('users',$condition2,"name");

            $target_dir = dirname(dirname(dirname(__FILE__))) . "/uploads/uploaded_videos/";
            $target_file = $target_dir . basename($result['videos']['poster']);
            if ($result['videos']['poster']=='' || !file_exists($target_file)) {
                $result['videos']['poster'] = base_url()."assets/images/no-image-icon-6.jpg";
            }
            else{
                $result['videos']['poster'] = base_url()."uploads/uploaded_videos/".$result['videos']['poster'];
            }


			$video_dir = dirname(dirname(dirname(__FILE__))) . "/uploads/uploaded_videos/";
			$video_file = $video_dir . basename($result['videos']['path']);
			if ($result['videos']['path']=='' || !file_exists($video_file)) {
				$result['videos']['path'] = "demo.mp4";
			}
			else{
				$result['videos']['path'] = /*base_url().*/"uploads/uploaded_videos/".$result['videos']['path'];
			}



		echo json_encode($result);
	}
	public function get_video_comments($slug=1){
		
		$comment_query = "select video_comments.*, users.name  from video_comments
		LEFT  JOIN users
		ON video_comments.user_id=users.id 
		 where video_comments.video_id='".$slug."'";// AND parent_id= 0
		$query = $this->db->query($comment_query);
		$result['comments'] = $query->result_array();

		echo json_encode($result);
	}
	public function search_videos(){

		$data = file_get_contents("php://input");
		$objData = json_decode($data);
		$video_query = "select * from videos where title like '%".$objData->data."%' OR description like '%".$objData->data."%'";
		$query = $this->db->query($video_query);
		$result['videos'] = $query->result_array();
		echo json_encode($result);
	}
	public function search_emails(){

		$data = file_get_contents("php://input");
		$objData = json_decode($data);
		$result = $this->Generic_model->select('users','*',"email = '".$objData->data."'");

		if($result!=false)
		{
			echo json_encode(false);
		}
		else{
			echo json_encode(true);
		}

	}
	
	public function post_comments(){
		
		$data = file_get_contents("php://input");
		$objData = json_decode($data);
		$dataarray = array('user_id'=> $this->session->userdata('id'),
							'video_id'=> $objData->data->video_id,
							'parent_id'=> $objData->data->parent_id,
							'created_at'=> date('Y-m-d H:i:s'),
							'comment' => $objData->data->comment_text);
		$last_insert_id = $this->Generic_model->insert($dataarray,'video_comments');


		//echo $last_insert_id;exit;
																  
		$comment_query = "select video_comments.*, users.name  from video_comments
		LEFT  JOIN users
		ON video_comments.user_id=users.id
		where video_comments.id = $last_insert_id";
		$query = $this->db->query($comment_query);
		$result['comments'] = $query->result_array();
		//$result = $query->result_array();
		echo json_encode($result);
	}
	public function get_video_likes_count($slug=1,$field='like'){

		$result = $this->Generic_model->select('video_feedback','video_id',"video_id = '".$slug."'  AND `$field`=1");
		$size =0; if($result!=false){ $size= sizeof($result);}
		if($field=='like')
		{
			$result['video_likes_count'] = $size;
		}
		else
		{
			$result['video_unlikes_count'] = $size;
		}
		echo json_encode($result);
	}
	public function like_video(){
		
		$data = file_get_contents("php://input");
		$objData = json_decode($data);

		$resultq = $this->Generic_model->select('video_feedback','*',"user_id = '".$this->session->userdata('id')."'  AND `video_id`=".$objData->data->video_id);
		$size =0; if($resultq!=false){ $size= sizeof($resultq);}

		if($objData->data->like=='0')
		{
			$unlike = 1;
		}
		else
		{
			$unlike = 0;
		}
		if($size>0)
		{
			$dataarray = array('like'=> $objData->data->like,
								'unlike'=> $unlike,
								'updated_at'=> date('Y-m-d H:i:s'));
			$this->Generic_model->update($dataarray,'video_feedback', "`user_id`= '".$this->session->userdata('id')."' AND
																  `video_id`	= '".$objData->data->video_id."'");

		}
		else
		{
			$dataarray = array('user_id'	=> $this->session->userdata('id'),
								'video_id'	=> $objData->data->video_id,
								'like'=> $objData->data->like,
								'unlike'=> $unlike,
								'updated_at'=> date('Y-m-d H:i:s'));
			$last_insert_id = $this->Generic_model->insert($dataarray,'video_feedback');

		}
		$resultq = $this->Generic_model->select('video_feedback','video_id',"video_id = '".$objData->data->video_id."' AND `like`=1");
		$size =0; if($resultq!=false){ $size= sizeof($resultq);}
		$result['video_likes_count'] = $size;


		$resultq = $this->Generic_model->select('video_feedback','video_id',"video_id = '".$objData->data->video_id."' AND `unlike`=1");
		$size =0; if($resultq!=false){ $size= sizeof($resultq);}
		$result['video_unlikes_count'] = $size;

		echo json_encode($result);
	}
	public function forgot_password(){
		$email 		= $this->input->post('email_forgot');
		if($email!=""){
			//Grab Condo Admin info
			$action = "email = '$email'";
			$condo_info_admins = $this->Generic_model->select_one('users','email,id,name',$action);
			$condo_alpha_name_id = $condo_info_admins['id'];
			$condo_alpha_name_admins = $condo_info_admins['name'];

			$DbFieldsArray 		= array('forgot_pass_count'=>0);
			$this->Generic_model->update($DbFieldsArray,'users',"email='".$email."'");

			$verification_code_id = base64_encode($condo_alpha_name_id);
			$verification_code_email = md5($email);
			$verification_link = base_url()."home/forgot_password_change/".$verification_code_id."/".$verification_code_email;

			//Collect Email Data
			$subject = "Reset Password Link";
			$message = "Dear ".$condo_alpha_name_admins.", <br />
				You have requested to reset your password.<br/><br/>

				Click on the link below to change your password.<br/>
				".$verification_link."<br/><br/>
				";

			$this->email($email, $condo_alpha_name_admins, $subject, $message);
			echo 'LINKSENT';
		}

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
		$msg = $this->load->view('include/email_template/main',$this->data, TRUE);
		$this->email->message($msg);
		if($attachment!=''){ $this->email->attach($attachment);
		}
		$this->email->send();
	}
	public function forgot_password_change($verification_code_id, $verification_code_email){
		$verification_code_id_decode = base64_decode($verification_code_id);
		$where = "id = '$verification_code_id_decode' and verify_code = '$verification_code_email'";
		//Grab Condo Admin Forgot Password Link Count info
		$action = "id = '$verification_code_id_decode'";
		$condo_info_admins = $this->Generic_model->select_one('condo_admins','*',$action);
		$condo_forgot_pass_count = $condo_info_admins['forgot_pass_count'];

		$condo_forgot_pass_final_count = $condo_forgot_pass_count + 1;
		$action_to_be_filled = "forgot_pass_count = '$condo_forgot_pass_final_count'";




		$sql="UPDATE $table SET $action where $where";
		$query = $this->db->query($sql);
		$sql_fetch="SELECT * from users where $where and forgot_pass_count <=1";
		$query_fetch = $this->db->query($sql_fetch);
		$row_fetch = $query_fetch->row();
		if($query_fetch->num_rows()>0){
			$this->data['verify_data'] = $get_key_id;
		}else {
			$this->data['verify_data'] = 'USED';
		}



		if(isset($_POST['forgotpasssubbutton'])){
			$id 				= $this->input->post('id');
			$new_password 		= $this->input->post('password');

			$DbFieldsArray 		= array('password'=>md5($new_password));
			$this->Generic_model->update($DbFieldsArray,'users',"id='".id."'");
			redirect('home');
		}

		$this->data['title']='Anemi Junkies | Forgot Password Change';
		$this->load->view('home/forgot_password_change',$this->data);
	}

	//Check email existance for forgot password
	public function check_data_exists_forgot_pass($field, $table){
		if (array_key_exists($field,$_POST)) {
			$this->db->where('email', $this->input->post('email_forgot'));
			$query = $this->db->get($table);
			if( $query->num_rows() > 0 ){
				echo json_encode(TRUE);
			} else {
				echo json_encode(FALSE);
			}
		}
	}

	//Check Email existance
	public function check_data_exists($field, $table){
		if(isset($_POST['current_name']) && $_POST['current_name']==$_POST[$field])
		{
			echo json_encode(TRUE);
		}
		elseif (array_key_exists($field,$_POST)) {
			if ( $this->Generic_model->data_exists($field, $this->input->post($field), $table) == FALSE ) {
				echo json_encode(FALSE);
			} else {
				echo json_encode(TRUE);
			}
		}
	}
	
	public function check_login(){
		//echo 'success';
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		 if($this->Generic_model->user_authentication_login($email, $password)==true){
			// echo $this->Generic_model->user_authentication_login($email, $password);
				echo 'active';
		} else {
			echo 'fail';
		}
	}
	
	public function do_logout(){
        $this->session->sess_destroy();
		$this->session->unset_userdata('id');    
		redirect('home');
    }
	
	public function facebook_login(){
        require 'facebook/facebook.php';

		$config = array();
		$config['appId'] = '1632619727051344'; //YOUR_APP_ID
		$config['secret'] = '618628f87d4d560eaed5c2af9b28fdd2'; //YOUR_APP_SECRET
		$scope = 'email,publish_actions,user_likes,public_profile,user_birthday';
		$facebook = new Facebook($config);
		// Get User ID
		$user = $facebook->getUser();
		// Get User Basic Info
		if ($user) {
		  try {
			// Proceed knowing you have a logged in user who's authenticated.
			$user_profile = $facebook->api('/me');
		  } catch (FacebookApiException $e) {
			error_log($e);
			$user = null;
		  }
		}
		// Get Login or logout url will be needed depending on current user state.
		if ($user) {
		  $logoutUrl = $facebook->getLogoutUrl();
		} else {
		  $loginUrl = $facebook->getLoginUrl(array(
				'scope' => $scope,
				));
		}
		 if (!$user): ?>
				<script language="javascript">
				window.location='<?php echo $loginUrl;?>';
				</script>
			 
			<?php endif; 
		//echo '<pre>';print_r($user_profile);echo '</pre>';
		
		if($user)
		{
		    $rows = $this->Generic_model->select('users', "id,fb_id,name", "fb_id='".$user_profile['id']."'");
			if(!empty($rows) && sizeof($rows)>0)
			{
				$InsertID = $rows[0]['fb_id'];
				$data = array(
					'id'     	  => $rows[0]['id'],
					'email'       => "fb_id_".$rows[0]['name'],
					'name'   	  => $rows[0]['name']
				);
			}
			else
			{
				$DbFieldsArray=array('user_name', 'name','fb_id' );
				$DataArray=array( $user_profile['name'].$user_profile['id'], $user_profile['name'], $user_profile['id']);
				$InsertID = $this->Generic_model->addData_InsertID($DbFieldsArray, $DataArray, 'users');
				$data = array(
					'id'     	  => $InsertID,
					'email'       => "fb_id_".$user_profile['id'],
					'name'   	  => $user_profile['name']
				);
			}

		   $this->session->set_userdata($data);
				
		}
		 redirect('home');
    }
}
