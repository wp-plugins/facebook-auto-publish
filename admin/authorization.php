<?php

$app_id = get_option('xyz_fbap_application_id');
$app_secret = get_option('xyz_fbap_application_secret');
$redirecturl=admin_url('admin.php?page=facebook-auto-publish-settings&auth=1');
$lnredirecturl=admin_url('admin.php?page=facebook-auto-publish-settings&auth=3');

$my_url=urlencode($redirecturl);

session_start();
$code="";
if(isset($_REQUEST['code']))
$code = $_REQUEST["code"];

if(isset($_POST['fb_auth']))
{

		$xyz_fbap_session_state = md5(uniqid(rand(), TRUE));
		setcookie("xyz_fbap_session_state",$xyz_fbap_session_state,"0","/");
		
		$dialog_url = "https://www.facebook.com/dialog/oauth?client_id="
		. $app_id . "&redirect_uri=" . $my_url . "&state="
		. $xyz_fbap_session_state . "&scope=read_stream,publish_stream,offline_access,manage_pages";

		header("Location: " . $dialog_url);
}


if(isset($_COOKIE['xyz_fbap_session_state']) && isset($_REQUEST['state']) && ($_COOKIE['xyz_fbap_session_state'] === $_REQUEST['state']) && get_option("xyz_fbap_af")==1) {
	
	$token_url = "https://graph.facebook.com/oauth/access_token?"
	. "client_id=" . $app_id . "&redirect_uri=" . $my_url
	. "&client_secret=" . $app_secret . "&code=" . $code;

	$params = null;$access_token="";
	$response = wp_remote_get($token_url);
	
	if(is_array($response))
	{
		if(isset($response['body']))
		{
			parse_str($response['body'], $params);
			if(isset($params['access_token']))
			$access_token = $params['access_token'];
		}
	}
	if($access_token!="")
	{
		update_option('xyz_fbap_fb_token',$access_token);
		update_option('xyz_fbap_af',0);
	}
}
else {
	//echo("The state does not match. You may be a victim of CSRF.");
}


?>