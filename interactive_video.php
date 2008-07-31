<?php
/*
Plugin Name: Interactive Video
Plugin URI: http://kaltura.org/community/viewtopic.php?f=4&t=3
Description: Add interactive video capabilities to your blog! Enhance your WordPress blog with a full video experience. Enable playing and editing of video remixes.
Version: 0.9.5
Author: Kaltura
Author URI: http://corp.kaltura.com
*/

require_once('settings.php');
require_once('lib/kaltura_client.php');
require_once('lib/kaltura_helpers.php');
require_once('lib/common.php');
 
// content filter

if (KalturaHelpers::compareWPVersion("2.5", "="))
{
	// in wp 2.5 there was a bug in wptexturize which corrupted our tag with unicode html entities
	// thats why we run our filter before (using lower priority)
	add_filter('the_content', 'kaltura_the_content', -1); 
	add_filter('comment_text', 'kaltura_the_comment', -1);
}
else
{
	// in wp 2.5.1 and higher we can use the default priority
	add_filter('the_content', 'kaltura_the_content'); 
	add_filter('comment_text', 'kaltura_the_comment');
}

if (KalturaHelpers::videoCommentsEnabled()) {
	add_action('comment_form', 'kaltura_comment_form');
}

// js
add_filter('print_scripts_array', 'kaltura_print_js'); // print js files
add_action('wp_print_scripts', 'kaltura_register_js'); // register js files

// css
add_action('wp_head', 'kaltura_head'); // print css

// admin css
add_filter('admin_head', 'kaltura_add_admin_css'); // print admin css

// admin menu & tabs
add_action('admin_menu', 'kaltura_add_admin_menu'); // add kaltura admin menu

add_filter("media_buttons_context", "kaltura_add_media_button"); // will add button over the rich text editor
add_filter("media_upload_tabs", "kaltura_add_upload_tab"); // will add tab to the modal media box

add_action("media_upload_kaltura", "kaltura_tab");
add_action("media_upload_kaltura_browse", "kaltura_browse_tab");

if (KalturaHelpers::compareWPVersion("2.6", "<")) {
	add_action("admin_head_kaltura_tab_content", "media_admin_css");
	add_action("admin_head_kaltura_tab_browse_content", "media_admin_css");
}

register_deactivation_hook('kaltura-interactive-video/kaltura-interactive-video.php', kaltura_deactivate);


// tiny mce
add_filter('mce_external_plugins', 'kaltura_add_mce_plugin'); // add the kaltura mce plugin



function kaltura_admin_page()
{
	require_once("lib/kaltura_model.php");
	require_once('admin/kaltura_admin_controller.php');
}

function kaltura_library_page()
{
	require_once("lib/kaltura_library_controller.php");
}

function kaltura_add_mce_plugin($content) {
	$pluginUrl = kalturaGetPluginUrl();
	$content["kaltura"] = $pluginUrl . "/tinymce/kaltura_tinymce.js";
	return $content;
}
  
function kaltura_add_admin_menu() {
	add_options_page('Interactive Video', 'Interactive Video', 8, 'interactive_video', 'kaltura_admin_page');
	add_management_page('Interactive Video Library', 'Interactive Video Library', 8, 'interactive_video_library', 'kaltura_library_page');
}

function kaltura_deactivate() {
	update_option('kaltura_partner_id', null);
}

function kaltura_the_content($content) {
	return _kaltura_replace_tags($content, false);
}

function kaltura_the_comment($content) {
	return _kaltura_replace_tags($content, true);
}

function kaltura_print_js($content) {
	$content[] = 'kaltura';
	$content[] = 'jquery';
	$content[] = 'swfobject';
	
	KalturaHelpers::addWPVersionJS();
	
	return $content;
}

function kaltura_register_js() {
	$plugin_url = kalturaGetPluginUrl();
	wp_register_script('kaltura', $plugin_url . '/js/kaltura.js');
	wp_register_script('swfobject', $plugin_url . '/js/swfobject.js');
}

function kaltura_head() {
	$plugin_url = kalturaGetPluginUrl();
	echo('<link rel="stylesheet" href="' . $plugin_url . '/css/kaltura.css" type="text/css" />');
}

function kaltura_add_admin_css($content) {
	$plugin_url = kalturaGetPluginUrl();
	$content .= '<link rel="stylesheet" href="' . $plugin_url . '/css/kaltura.css" type="text/css" />' . "\n";
	echo $content;
}

function kaltura_create_tab() 
{
	require_once('tab_create.php');
}

function kaltura_add_media_button($content)
{
	global $post_ID, $temp_ID;
	$uploading_iframe_ID = (int) (0 == $post_ID ? $temp_ID : $post_ID);
	$media_upload_iframe_src = "media-upload.php?post_id=$uploading_iframe_ID";
	$kaltura_iframe_src = apply_filters('kaltura_iframe_src', "$media_upload_iframe_src&amp;tab=kaltura");
	$kaltura_browse_iframe_src = apply_filters('kaltura_iframe_src', "$media_upload_iframe_src&amp;tab=kaltura_browse");
	$kaltura_title = __('Add Interactive Video');
	$kaltura_button_src = kalturaGetPluginUrl() . '/images/interactive_video_button.gif';
	$content .= <<<EOF
		<a href="{$kaltura_iframe_src}&amp;TB_iframe=true&amp;height=500&amp;width=640" class="thickbox" title='$kaltura_title'><img src='$kaltura_button_src' alt='$kaltura_title' /></a>
EOF;

	return $content;
}

function kaltura_add_upload_tab($content)
{
	$content["kaltura"] = __("Add Interactive Video");
	$content["kaltura_browse"] = __("Browse Interactive Videos");
	return $content;
}

function kaltura_tab()
{
	// only for 2.6 and higher
	if (KalturaHelpers::compareWPVersion("2.6", ">="))
	{
		wp_enqueue_style('media');
	}
	wp_iframe('kaltura_tab_content');
}

function kaltura_tab_content()
{
	media_upload_header(); // will add the tabs menu
	if (!get_option('kaltura_partner_id'))
	{
		?>
			<div class="kalturaTab">
				To get started, you need to get a Partner ID. <a href="options-general.php?page=interactive_video" target="_parent">Click here</a> to get one
			</div>
		<?php
	}
	else
	{
		require_once("lib/kaltura_model.php");
		require_once("lib/kaltura_helpers.php");
	
		$kalturaClient = getKalturaClient();
		if (!$kalturaClient)
		{
			wp_die(__('Failed to start new session.'));
		}
		$ks = $kalturaClient->getKs();
		
		$kshowId = "-2";
		
		$viewData["flashVars"] 	= KalturaHelpers::getContributionWizardFlashVars($ks, $kshowId);
		$viewData["flashVars"]["showCloseButton"] 	= "false";
		$viewData["swfUrl"]    	= KalturaHelpers::getContributionWizardUrl(KalturaWPSettings::KCW_UICONF);
		$viewData["kshowId"] 	= $kshowId;
		
		require_once("view/view_contribution_wizard_admin.php");
	}
}

function kaltura_browse_tab()
{
	// only for 2.6 and higher
	if (KalturaHelpers::compareWPVersion("2.6", ">="))
	{
		wp_enqueue_style('media');
	}
	wp_iframe('kaltura_tab_browse_content');
}

function kaltura_tab_browse_content()
{
	media_upload_header(); // will add the tabs menu
	
	require_once("lib/kaltura_library_controller.php");
}

function kaltura_comment_form($post_id) {
	$user = wp_get_current_user();
	if (!$user->ID)
	{
		echo "You must be <a href=" . get_option('siteurl') . "/wp-login.php?redirect_to=" . urlencode(get_permalink()) . ">logged in</a> to post an <br /> interactive video comment.";
	}
	else
	{
		$plugin_url = kalturaGetPluginUrl();
		$js_click_code = "Kaltura.openCommentCW('".$plugin_url."'); ";
		echo "<input type=\"button\" id=\"kaltura_video_comment\" name=\"kaltura_video_comment\" tabindex=\"6\" value=\"Add Video Comment\" onclick=\"" . $js_click_code . "\" />";
	}
}

function _kaltura_replace_tags($content, $isComment) {
	$length = strlen($content);
	
	$tagStartPos = 0;
	$found = false;

	while(($tagStartPos = strpos($content, "[kaltura-widget", $tagStartPos)) !== false) {
		$found = true;
		$tagEndPos = strpos($content, "/]", $tagStartPos); 
		$kalturaTag = substr($content, $tagStartPos, $tagEndPos - $tagStartPos + 2);
		
		// parse the parameters from the tag
		$params = _kaltura_get_params_from_tag($kalturaTag);

		// get the embed options from the params
		$embedOptions = _kaltura_get_embed_options($params, $isComment);
		
		if (!is_feed()) { 
			$wid 			= $embedOptions["wid"];
			$width 			= $embedOptions["width"];
			$height 		= $embedOptions["height"];
			$divId 			= "kaltura_wrapper_" . $wid;
			$thumbnailDivId = "kaltura_thumbnail_" . $wid;
			$playerId 		= "kaltura_player_" . $wid;
			
			if ($isComment)
			{
				$thumbnailPlaceHolderUrl = KalturaHelpers::getCommentPlaceholderThumbnailUrl($wid);

				$embedOptions["flashVars"] .= "&autoPlay=true";
				$html = '
						<div id="' . $thumbnailDivId . '" style="width:'.$width.'px;height:'.$height.'px;" class="kalturaHand" onclick="Kaltura.activatePlayer(\''.$thumbnailDivId.'\',\''.$divId.'\');">
							<img src="' . $thumbnailPlaceHolderUrl . '" style="" />
						</div>
						<div id="' . $divId . '" style="text-align:' . $embedOptions["align"] . '; height: '.$height.'px""><a href="http://corp.kaltura.com">open-source video, player, editor</a></div>
						<script type="text/javascript">
							jQuery("#'.$divId.'").hide();
							var kaltura_swf = new SWFObject("' . $embedOptions["swfUrl"] . '", "' . $playerId . '", "' . $width . '", "' . $height . '", "9", "#000000");
							kaltura_swf.addParam("wmode", "opaque");
							kaltura_swf.addParam("flashVars", "' . $embedOptions["flashVars"] . '");
							kaltura_swf.addParam("allowScriptAccess", "always");
							kaltura_swf.addParam("allowFullScreen", "true");
							kaltura_swf.addParam("allowNetworking", "all");
							kaltura_swf.write("' . $divId . '");
						</script>
				';
			}
			else
			{
				$divId = "kaltura_wrapper_" . $embedOptions["wid"];
				$playerId = "kaltura_player_" . $embedOptions["wid"];
				$html = '
						<div id="' . $divId . '" style="text-align:' . $embedOptions["align"] . ';"><a href="http://corp.kaltura.com">open-source video, player, editor</a></div>
						<script type="text/javascript">
							var kaltura_swf = new SWFObject("' . $embedOptions["swfUrl"] . '", "' . $playerId . '", "' . $embedOptions["width"] . '", "' . $embedOptions["height"] . '", "9", "#000000");
							kaltura_swf.addParam("wmode", "opaque");
							kaltura_swf.addParam("flashVars", "' . $embedOptions["flashVars"] . '");
							kaltura_swf.addParam("allowScriptAccess", "always");
							kaltura_swf.addParam("allowFullScreen", "true");
							kaltura_swf.addParam("allowNetworking", "all");
							kaltura_swf.write("' . $divId . '");
						</script>
				';
			}
		}
		
		// remove new line so wordpress core filters won't try to replace new lines with <br />'s or <p>'s
		$html = str_replace(array("\r\n", "\r", "\n", "\n\r"), "", $html);
		
		// split the html into 2 part (before the tag, and after the tag)
		$content_part_1 = substr($content, 0, $tagStartPos);
		$content_part_2 = substr($content, $tagEndPos + 2);
		
		// rebuild the html with our new code tag 
		$content = $content_part_1 . $html . $content_part_2; 

		$tagStartPos++;
	}
	
	if ($found && !is_feed()) {
		$plugin_url = kalturaGetPluginUrl();
		$js = '
			<script type="text/javascript">
				function handleGotoContribWizard (kshowId, pd_extraData) {
					KalturaModal.openModal("contribution_wizard", "' . $plugin_url . '/page_contribution_wizard_front_end.php?kshowid=" + kshowId, { width: 680, height: 360 } );
					jQuery("#contribution_wizard").addClass("modalContributionWizard");
				}
			
				function handleGotoEditorWindow (kshowId, pd_extraData) {
					KalturaModal.openModal("simple_editor", "' . $plugin_url . '/page_simple_editor_front_end.php?kshowid=" + kshowId, { width: 890, height: 546 } );
					jQuery("#simple_editor").addClass("modalSimpleEditor");
				}
			</script>';
		// remove new line so wordpress core filters won't try to replace new lines with <br />'s or <p>'s
		$js = str_replace(array("\r\n", "\r", "\n", "\n\r"), "", $js);

		$content .= $js;
	}

	return $content;
}

function _kaltura_get_params_from_tag($tag) {
	$params = array();
	$attributes_array = explode(' ', $tag);
	for ($i = 1, $len = count($attributes_array); $i < $len; $i++) {
		$attr = $attributes_array[$i];
		if (!strpos($attr, "=")) {
			continue;
		}
		$attr = str_replace('"', "", $attr);
		$attr = str_replace("'", "", $attr);
		$keyvalue = explode('=', $attr);
		$key = $keyvalue[0];
		$value = $keyvalue[1];
		$params[$key] = $value;
	}
	return $params;
}

function _kaltura_get_embed_options($params, $isComment) {

	if ($isComment) // comments player
	{
		$playerSize = _katlura_calculate_player_size("comments");
		$layoutId = "tinyPlayer";
	}
	elseif ($params["size"] == "large") { // large size

		
		if (KalturaHelpers::userCanEdit()) {
			$playerSize = _katlura_calculate_player_size("large");
			$layoutId = "fullLarge";
		}
		else if(KalturaHelpers::userCanAdd()) {
			$playerSize = _katlura_calculate_player_size("large");
			$layoutId = "addOnlyLarge";
		}
		else {
			$playerSize = _katlura_calculate_player_size("large");
			$layoutId = "playerOnlyLarge";
		}
	}
	elseif (($params["size"] == "large_wide_screen"))
	{
		$playerSize = _katlura_calculate_player_size("large_wide_screen");
		$layoutId = "playerOnlyLarge&wideScreen=1"; // FIXME: temp hack
	}
    else { // small size
    	if (KalturaHelpers::userCanEdit()) {
			$playerSize = _katlura_calculate_player_size("small");
			$layoutId = "fullSmall";
		}
		else if(KalturaHelpers::userCanAdd()) {
			$playerSize = _katlura_calculate_player_size("small");
			$layoutId = "addOnlySmall";
		}
		else {
			$playerSize = _katlura_calculate_player_size("small");
			$layoutId = "playerOnlySmall";
		}
	}
	
	if ($params["align"] == "r")
		$align = "right";
	else if ($params["align"] == "m")
		$align = "center";
	else {
		$align = "left";			
	}
	
	if ($_SERVER["SERVER_PORT"] == 443)
		$protocol = "https://";
	else
		$protocol = "http://"; 

	$flashVarsStr =  "layoutId=" . $layoutId . "&pd_original_url=" . urlencode($protocol . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
	
	$wid = $params["wid"];
	$swfUrl = KalturaHelpers::getSwfUrlForWidget($wid);

	return array(
		"flashVars" => $flashVarsStr,
		"height" => $playerSize["height"],
		"width" => $playerSize["width"],
		"align" => $align,
		"wid" => $wid,
		"swfUrl" => $swfUrl
	);
}

function _katlura_calculate_player_size($size)
{
	switch($size)
	{
		case "large":
			return array(
				"width" => (400 + 10),
				"height" => (300 + 30 + 34)  
			);
			break;
		case "large_wide_screen":
			return array(
				"width" => (400 + 10),
				"height" => (225 + 30 + 34)  
			);
			break;
		case "comments":
			return array(
				"width" => (240 + 10),
				"height" => (180 + 30 + 34)
			);
			break;
		case "small":
			return array(
				"width" => (240 + 10),
				"height" => (180 + 30 + 34)
			);
			break;
	}
}

if ( !get_option('kaltura_partner_id') && !isset($_POST['submit']) && !strpos($_SERVER["REQUEST_URI"], "page=interactive_video")) {
	function kaltura_warning() {
		echo "
		<div class='updated fade'><p><strong>".__('To complete the Interactive Video installation, <a href="'.get_settings('siteurl').'/wp-admin/options-general.php?page=interactive_video">you must get a Partner ID.</a>')."</strong></p></div>
		";
	}
	add_action('admin_notices', 'kaltura_warning');
}

?>
