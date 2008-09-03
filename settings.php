<?php
	define("KALTURA_SERVER_URL", "http://www.kaltura.com");
	define("KALTURA_ANONYMOUS_USER_ID", "Anonymous");
	define("KALTURA_KSE_UICONF", 502);
	define("KALTURA_KCW_UICONF", 501);
	define("KALTURA_KCW_UICONF_COMMENTS", 503);
	define("KALTURA_KCW_UICONF_FOR_SE", 504);
	
	$KALTURA_GLOBAL_PLAYERS = array (
		"white" => 
			array(
				"name" => "White", 
				"uiConfId" => 510,
				"previewWidgetId" => 511,
				"horizontalSpacer" => 10,
				"verticalSpacer" => 64,
				"videoAspectRatio" => "4:3"
			),
		"dark" => 
			array(
				"name" => "Dark", 
				"uiConfId" => 512,
				"previewWidgetId" => 513,
				"horizontalSpacer" => 10,
				"verticalSpacer" => 64,
				"videoAspectRatio" => "4:3"
			),
		"romantic" => 
			array(
				"name" => "Romantic", 
				"uiConfId" => 514,
				"previewWidgetId" => 515,
				"horizontalSpacer" => 10,
				"verticalSpacer" => 64,
				"videoAspectRatio" => "4:3"
			)
	);
?>