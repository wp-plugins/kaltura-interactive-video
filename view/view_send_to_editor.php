<?php if ($viewData["widgetId"]): ?>
<script type="text/javascript">
	var playerWidth = "<?php echo $viewData["playerWidth"]; ?>";
	var playerHeight = "<?php echo $viewData["playerHeight"]; ?>";
	var playerType = "<?php echo $viewData["playerType"]; ?>";
	
	var html = '[kaltura-widget wid="<?php echo $viewData["widgetId"]; ?>" width="'+playerWidth+'" height="'+playerHeight+'" type="'+playerType+'" /]';

	// lets make it safe
	try
	{
		var topWindow = Kaltura.getTopWindow();
	
		if (topWindow.tinyMCE && topWindow.tinyMCE.get('content') && !topWindow.tinyMCE.get('content').isHidden()) 
		{
			topWindow.tinyMCE.execCommand('mceInsertRawHTML', false, html);
		}
		else 
		{
			topWindow.edInsertContent(topWindow.document.getElementById('content'), html);
		}
		setTimeout('topWindow.tb_remove()', 0);
	}
	catch(e) 
	{
		jQuery(function () {
			jQuery("#kalturaEditTable").show();
			jQuery("#txtCode").val(html);
		});
	}
</script>
<div class="kalturaTab">
	<form method="post" class="kalturaForm">
		<table id="kalturaEditTable" class="form-table kalturaFormTable" style="display: none;">
			<tr>
				<td>
					<b>We were unable to insert the player code into the editor. Please copy and paste the code as it appears below.</b>
					<br />
					<br />
					<textarea id="txtCode" rows="1" style="width: 90%" readonly="readonly"></textarea>
					<br />
					<br />
					<center>
						<input type="button" value="<?php echo attribute_escape( __( 'Close' ) ); ?>" name="close" class="button-secondary" />
					</center>
				</td>
			</tr>
		</table>
	</form>
</div>
<?php else: ?>
<?php
	$flashVarsStr = KalturaHelpers::flashVarsToString($viewData["flashVars"]);
?>

<div class="kalturaTab">
	<form method="post" class="kalturaForm">
		<table id="kalturaEditTable" class="form-table kalturaFormTable">
			<tr>
				<td valign="top" width="180">
					<div id="divKalturaThumbnail" style="width:250px;height:244px;" class="kalturaHand" onclick="Kaltura.activatePlayer('divKalturaThumbnail','divKalturaPlayer');">
						<div class="playerName"><nobr><?php echo @$kshow["name"]; ?></nobr></div>
						<img id="thumbnailPreview" src=""  />
					</div>
					<div id="divKalturaPlayer" style="display: none"></div>
					<script type="text/javascript">
						function embedPreviewPlayer(swfUrl, playerType, previewHeaderColor) {
							jQuery("#thumbnailPreview").attr('src', '<?php echo $viewData["thumbnailPlaceHolderUrl"]; ?>&player_type='+playerType);
							jQuery("#divKalturaThumbnail .playerName").css('color', previewHeaderColor);
							var kalturaSwf = new SWFObject(swfUrl, "swfKalturaPlayer", "250", "244", "9", "#000000");
							kalturaSwf.addParam("flashVars", "<?php echo $flashVarsStr; ?>");
							kalturaSwf.addParam("wmode", "opaque");
							kalturaSwf.addParam("allowScriptAccess", "always");
							kalturaSwf.addParam("allowFullScreen", "true");
							kalturaSwf.addParam("allowNetworking", "all");
							kalturaSwf.write("divKalturaPlayer");
						};
					</script>
				</td>
				<td id="kalturaEditRight" valign="top">
					<?php if (@$_GET["firstedit"] != "true"): ?>
					<div class="backDiv">
						<a href="<?php echo kalturaGenerateTabUrl(array()); ?>"><img src="<?php echo kalturaGetPluginUrl(); ?>/images/back.gif" alt="Back"/></a>
					</div>
					<?php endif; ?>
					<table>
						<tr>
							<td valign="top">
								<fieldset class="kalturaNoBorderFieldSet">
									<legend><label for="kshowName">Select player design:</label></legend>
									<?php $players = KalturaHelpers::getPlayers(); ?>
									<?php foreach($players as $name => $details): ?>
									<fieldset class="kalturaNoBorderFieldSet" onclick="jQuery(this).find('input').attr('checked', true); embedPreviewPlayer('<?php echo KalturaHelpers::getSwfUrlForBaseWidget($name); ?>', '<?php echo $name; ?>', '<?php echo @$details["previewHeaderColor"]; ?>');">
										<input type="radio" name="playerType" id="playerType_<?php echo $name; ?>" value="<?php echo $name; ?>" <?php echo @get_option("kaltura_default_player_type") == $name ? "checked=\"checked\"" : ""; ?>/>&nbsp;&nbsp;<label for="playerType_<?php echo $name; ?>"><?php echo $details["name"]; ?></label><br />
										<?php if (@get_option("kaltura_default_player_type") == $name): ?>
											<script type="text/javascript">
												embedPreviewPlayer('<?php echo KalturaHelpers::getSwfUrlForBaseWidget($name); ?>', '<?php echo $name; ?>', '<?php echo @$details["previewHeaderColor"]; ?>');
											</script>
										<?php endif; ?>
									</fieldset>	
									<?php endforeach; ?>
								</fieldset>
							</td>
							<td valign="top">
								<fieldset class="kalturaNoBorderFieldSet">
									<legend><label for="kshowName">Select player size:</label></legend>
								</fieldset>
								<fieldset class="kalturaNoBorderFieldSet">
									<input type="radio" name="playerWidth" id="playerWidthLarge" value="410" checked="checked" />&nbsp;&nbsp;<label for="playerWidthLarge">Large (410x364)</label><br />
								</fieldset>
								<fieldset class="kalturaNoBorderFieldSet">
									<input type="radio" name="playerWidth" id="playerWidthMedium" value="250" />&nbsp;&nbsp;<label for="playerWidthMedium">Small (250x244)</label>
								</fieldset>
								<fieldset class="kalturaNoBorderFieldSet">
									<input type="radio" name="playerWidth" id="playerWidthCustom" value="" />&nbsp;&nbsp;<label for="playerCustomWidth">Custom width</label>
									<input type="text" name="playerCustomWidth" id="playerCustomWidth" maxlength="3" size="3" />
								</fieldset>
								<p id="kalturaEditButtons" class="submit">
									<input type="submit" value="<?php echo attribute_escape( __( 'Insert into Post' ) ); ?>" name="sendToEditorButton" class="button-secondary" />
								</p>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</form>			
</div>
<script type="text/javascript">
	jQuery("#playerCustomWidth").click(function(){
		jQuery(this).siblings("[type=radio]").attr("checked", "checked");
	});
	
	jQuery("#kalturaEditButtons input[type=submit]").click(function () {
			jQuery("#playerWidthCustom").val(jQuery("#playerCustomWidth").val());
			if (jQuery("#playerWidthCustom").attr("checked")) 
			{
				customWidth = jQuery("#playerCustomWidth").val();
				if (!customWidth.match(/^[0-9]+$/)) 
				{
					jQuery("#playerCustomWidth").css("background-color", "red");
					return false;
				}
			}
			return true;
	});
</script>
<?php endif; ?>