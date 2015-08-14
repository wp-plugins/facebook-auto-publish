<?php
function wp_fbap_admin_notice()
{
	add_thickbox();
	$sharelink_text_array_fb = array
						(
						"I Use Facebook Auto Publish  wordpress plugin from @xyzscriptsdotcom and you should too",
						"Facebook Auto Publish  wordpress Plugin from @xyzscriptsdotcom is Awesome",
						"Actually i am looking for a social media Plugin like this. Thanks @xyzscriptsdotcom",
						"Its very nice to use Facebook Auto Publish  wordpress Plugin from @xyzscriptsdotcom",
						"I installed Facebook Auto Publish .. from @xyzscriptsdotcom,  It works wonderful",
						"The Facebook Auto Publish  icon wordpress plugin looks soo nice.. thanks @xyzscriptsdotcom", 
						"It awesome to use Facebook Auto Publish  wordpress plugin from @xyzscriptsdotcom -",
						"Facebook Auto Publish  wordpress Plugin that i use Looks awesome and works terrific",
						"I am using Facebook Auto Publish  Icon wordpress Plugin from @xyzscriptsdotcom I like it!",
						"Facebook Auto Publish  Icon wordpress plugin is Fantastic Plugin",
						"Facebook Auto Publish  Icon wordpress plugin was easy to use and works great. thank you!",
						"Good and flexible wp socialmedia plugin especially for beginners.",
						"Easily the best socialmedia wordpress plugin of the type I have used ! THANKS! @xyzscriptsdotcom",
						);
$sharelink_text_fb = array_rand($sharelink_text_array_fb, 1);
$sharelink_text_fb = $sharelink_text_array_fb[$sharelink_text_fb];

	
	echo '<div id="fb_notice_td" class="error" style="color: #c1c1c1;margin-left: 2px;background: none repeat scroll 0pt 0pt infobackground; border: 1px solid inactivecaption; padding: 5px;line-height:16px;">
	<p>It looks like you have been enjoying using <a href="https://wordpress.org/plugins/facebook-auto-publish/" target="_blank"> Facebook Auto Publish  </a> plugin from Xyzscripts for atleast 30 days.Would you consider supporting us with the continued development of the plugin using any of the below methods?</p>
	<p>
	<a href="https://wordpress.org/support/view/plugin-reviews/facebook-auto-publish" class="button" style="color:black;text-decoration:none;padding:5px;margin-right:4px;" target="_blank">Rate it 5★\'s on wordpress</a>
	<a href="http://xyzscripts.com/wordpress-plugins/social-media-auto-publish/purchase" class="button" style="color:black;text-decoration:none;padding:5px;margin-right:4px;" target="_blank">Purchase premium version</a>';
	if(get_option('xyz_credit_link')=="0")
		echo '<a class="button xyz_fbap_backlink" style="color:black;text-decoration:none;padding:5px;margin-right:4px;" target="_blank">Enable Backlink</a>';
	
	echo '<a href="#TB_inline?width=250&height=75&inlineId=show_share_icons_fb" class="button thickbox" style="color:black;text-decoration:none;padding:5px;margin-right:4px;" target="_blank">Share on</a>
	
	<a href="admin.php?page=facebook-auto-publish-settings&fbap_notice=hide" class="button" style="color:black;text-decoration:none;padding:5px;margin-right:4px;">Don\'t Show This Again</a>
	</p>
	
	<div id="show_share_icons_fb" style="display: none;">
	<a class="button" style="background-color:#3b5998;color:white;margin-right:4px;margin-left:100px;margin-top: 25px;" href="http://www.facebook.com/sharer/sharer.php?u=https://wordpress.org/plugins/facebook-auto-publish/&text='.$sharelink_text_fb.'" target="_blank">Facebook</a>
	<a class="button" style="background-color:#00aced;color:white;margin-right:4px;margin-left:20px;margin-top: 25px;" href="http://twitter.com/share?url=https://wordpress.org/plugins/facebook-auto-publish/&text='.$sharelink_text_fb.'" target="_blank">Twitter</a>
	<a class="button" style="background-color:#007bb6;color:white;margin-right:4px;margin-left:20px;margin-top: 25px;" href="http://www.linkedin.com/shareArticle?mini=true&url=https://wordpress.org/plugins/facebook-auto-publish/" target="_blank">LinkedIn</a>
	<a class="button" style="background-color:#dd4b39;color:white;margin-right:4px;margin-left:20px;margin-top: 25px;" href="https://plus.google.com/share?&hl=en&url=https://wordpress.org/plugins/facebook-auto-publish/" target="_blank">google+</a>
	</div>
	
	
	
	</div>';
	
	
}
$fbap_installed_date = get_option('fbap_installed_date');
if ($fbap_installed_date=="") {
	$fbap_installed_date = time();
}
if($fbap_installed_date < ( time() - 2952000 ))
{
	if (get_option('xyz_fbap_dnt_shw_notice') != "hide")
	{
		add_action('admin_notices', 'wp_fbap_admin_notice');
	}
}
?>