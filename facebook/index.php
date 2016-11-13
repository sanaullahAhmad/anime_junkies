<?php
//echo "sanaullah";exit;
session_start();
//echo "sanaullah";exit;
require 'facebook.php';

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
echo '<pre>';print_r($user_profile);echo '</pre>';
if($user)
{/*
	$check = "select * from tbl_user where user_email = '".$user_profile['email']."'";
	$res = mysql_query($check);
	$num_rows = mysql_num_rows($res);
	if ($num_rows > 0) {
		$user_data = mysql_fetch_array($res);
		$_SESSION['user']['uid'] = $user_data['pk_user_id'];
		$_SESSION['user']['user_email'] = $user_profile['email'];
		$_SESSION['user']['user_password'] = $user_data['user_password'];;
	}
	else
	{
		$user_password = rand(0,100);
		mysql_query("INSERT INTO tbl_user SET first_name = '".$user_profile['first_name']."', last_name = '".$user_profile['last_name']."', city = '".$user_profile['location']['name']."', user_email='".$user_profile['email']."', user_password='".$user_password."' ");
		 $insert_id = mysql_insert_id();
		$_SESSION['user']['uid'] = $insert_id;
		$_SESSION['user']['user_email'] = $user_profile['email'];
		$_SESSION['user']['user_password'] = $user_password;
	}
*/}
	//header("location:http://neotjanster.com/managefoodold/mylist");
//exit;
?>