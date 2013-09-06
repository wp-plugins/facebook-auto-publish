<?php 
add_action( 'add_meta_boxes', 'xyz_fbap_add_custom_box' );
function xyz_fbap_add_custom_box()
{
	$posttype="";
	if(isset($_GET['post_type']))
	$posttype=$_GET['post_type'];
	
if(isset($_GET['action']) && $_GET['action']=="edit")
	{
		$postid=$_GET['post'];
		$get_post_meta=get_post_meta($postid,"xyz_fbap",true);
		if($get_post_meta==1)
			return ;
		global $wpdb;
		$table='posts';
		$accountCount = $wpdb->query( 'SELECT * FROM '.$wpdb->prefix.$table.' WHERE id="'.$postid.'" and post_status!="draft" LIMIT 0,1' ) ;
		if($accountCount>0)
		return ;
	}

	if($posttype=="")
		$posttype="post";

	if ($posttype=="page")
	{

		$xyz_fbap_include_pages=get_option('xyz_fbap_include_pages');
		if($xyz_fbap_include_pages==0)
			return;
	}
	else if($posttype!="post")
	{

		$xyz_fbap_include_customposttypes=get_option('xyz_fbap_include_customposttypes');


		$carr=explode(',', $xyz_fbap_include_customposttypes);
		if(!in_array($posttype,$carr))
			return;

	}
	
	
	
	
	if(get_option('xyz_fbap_af')==0 && get_option('xyz_fbap_fb_token')!="")
	add_meta_box( "xyz_fbap", '<strong>Facebook Auto Publish - Post Options</strong>', 'xyz_fbap_addpostmetatags') ;
}

function xyz_fbap_addpostmetatags()
{
	$imgpath= plugins_url()."/facebook-auto-publish/admin/images/";
	$heimg=$imgpath."support.png";
	?>
<script>

function displaycheck_fbap()
{
	
var fcheckid=document.getElementById("xyz_fbap_post_permission").value;
if(fcheckid==1)
{
	document.getElementById("fpabpmd").style.display='';	
	document.getElementById("fpabpmf").style.display='';	
}
else
{
	document.getElementById("fpabpmd").style.display='none';	
	document.getElementById("fpabpmf").style.display='none';	
}


}


</script>
<script type="text/javascript">
function detdisplay_fbap(id)
{
	document.getElementById(id).style.display='';
}
function dethide_fbap(id)
{
	document.getElementById(id).style.display='none';
}


</script>
<table>

	<tr valign="top">
		<td>Enable auto publish post to my facebook account
		</td>
		<td><select id="xyz_fbap_post_permission" name="xyz_fbap_post_permission"
			onchange="displaycheck_fbap()"><option value="0"
			<?php  if(get_option('xyz_fbap_post_prmission')==0) echo 'selected';?>>
					No</option>
				<option value="1"
				<?php  if(get_option('xyz_fbap_post_permission')==1) echo 'selected';?>>Yes</option>
		</select>
		</td>
	</tr>
	<tr valign="top" id="fpabpmd">
		<td>Posting method
		</td>
		<td><select id="xyz_fbap_po_method" name="xyz_fbap_po_method">
				<option value="3"
				<?php  if(get_option('xyz_fbap_po_method')==3) echo 'selected';?>>Simple text message</option>
				
				<optgroup label="Text message with image">
					<option value="4"
					<?php  if(get_option('xyz_fbap_po_method')==4) echo 'selected';?>>Upload image to app album</option>
					<option value="5"
					<?php  if(get_option('xyz_fbap_po_method')==5) echo 'selected';?>>Upload image to timeline album</option>
				</optgroup>
				
				<optgroup label="Text message with attached link">
					<option value="1"
					<?php  if(get_option('xyz_fbap_po_method')==1) echo 'selected';?>>Attach
						your blog post</option>
					<option value="2"
					<?php  if(get_option('xyz_fbap_po_method')==2) echo 'selected';?>>
						Share a link to your blog post</option>
					</optgroup>
		</select>
		</td>
	</tr>
	<tr valign="top" id="fpabpmf">
		<td>Message format for posting <img src="<?php echo $heimg?>"
						onmouseover="detdisplay_fbap('xyz_fbap')" onmouseout="dethide_fbap('xyz_fbap')">
						<div id="xyz_fbap" class="informationdiv" style="display: none;">
							{POST_TITLE} - Insert the title of your post.<br />{PERMALINK} -
							Insert the URL where your post is displayed.<br />{POST_EXCERPT}
							- Insert the excerpt of your post.<br />{POST_CONTENT} - Insert
							the description of your post.<br />{BLOG_TITLE} - Insert the name
							of your blog.<br />{USER_NICENAME} - Insert the nicename
							of the author.
						</div>
		</td>
		<td>
		<textarea id="xyz_fbap_message" name="xyz_fbap_message"><?php echo esc_textarea(get_option('xyz_fbap_message'));?></textarea>
		</td>
	</tr>
		
</table>
<script type="text/javascript">
	displaycheck_fbap();
	</script>
<?php 
}
?>