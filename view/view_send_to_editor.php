<?php if ($viewData["widgetId"]): ?>
<script type="text/javascript">
	var playerWidth = "<?php echo $viewData["playerWidth"]; ?>";
	var playerHeight = "<?php echo $viewData["playerHeight"]; ?>";
	var playerType = "<?php echo $viewData["playerType"]; ?>";
	var addPermission = "<?php echo $viewData["addPermission"]; ?>";
	var editPermission = "<?php echo $viewData["editPermission"]; ?>";
	
	var html = '[kaltura-widget wid="<?php echo $viewData["widgetId"]; ?>" width="'+playerWidth+'" height="'+playerHeight+'" type="'+playerType+'" addPermission="'+addPermission+'" editPermission="'+editPermission+'" /]';

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
		var displayEditTable = true;
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
					<textarea id="txtCode" rows="3" style="width: 90%" readonly="readonly"></textarea>
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
<script>
	if (displayEditTable)
	{
		jQuery("#kalturaEditTable").show();
		jQuery("#txtCode").val(html);
	}
</script>
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
					<?php $players = KalturaHelpers::getPlayers(); ?>
					
					<script type="text/javascript">
						function embedPreviewPlayer(name) {
							<?php foreach($players as $name => $details): ?>
								var player_<?php echo $name; ?>_settings = {
										url: "<?php echo KalturaHelpers::getSwfUrlForBaseWidget($name); ?>",
										name: "<?php echo $details["name"]; ?>",
										previewHeaderColor: "<?php echo $details["previewHeaderColor"]; ?>"
								};
							<?php endforeach; ?>

							var playerSettings = eval("player_" + name + "_settings");
							var swfUrl = playerSettings.url;
							jQuery("#thumbnailPreview").attr('src', '<?php echo $viewData["thumbnailPlaceHolderUrl"]; ?>&player_type='+name);
							jQuery("#divKalturaThumbnail .playerName").css('color', playerSettings.previewHeaderColor);
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
									<legend><label for="playerType">Select player design:</label></legend>
									<select name="playerType" id="playerType" onchange="embedPreviewPlayer(this.options[this.selectedIndex].value);">
									<?php $players = KalturaHelpers::getPlayers(); ?>
									<?php foreach($players as $name => $details): ?>
										<option id="playerType_<?php echo $name; ?>" value="<?php echo $name; ?>" <?php echo @get_option("kaltura_default_player_type") == $name ? "selected=\"selected\"" : ""; ?>><?php echo $details["name"]; ?></option>
										<?php if (@get_option("kaltura_default_player_type") == $name): ?>
											<?php $selectedPlayerName = $name; ?>
										<?php endif; ?>
									<?php endforeach; ?>
									</select>
									<?php if ($selectedPlayerName): ?>
									<script type="text/javascript">
										embedPreviewPlayer('<?php echo $selectedPlayerName; ?>');
									</script>
									<?php endif; ?>
								</fieldset>	
								<fieldset class="kalturaNoBorderFieldSet">
									<legend><label for="addPermission">Who can add to video:</label></legend>
									<select name="addPermission" id="addPermission">
										<option value="3" <?php echo @get_option("kaltura_permissions_add") == "3" ? "selected=\"selected\"" : ""; ?>>Blog Administrators</option>
										<option value="2" <?php echo @get_option("kaltura_permissions_add") == "2" ? "selected=\"selected\"" : ""; ?>>Blog Editors/Contributors & Authors</option>
										<option value="1" <?php echo @get_option("kaltura_permissions_add") == "1" ? "selected=\"selected\"" : ""; ?>>Blog Subscribers</option>										
										<option value="0" <?php echo @get_option("kaltura_permissions_add") == "0" ? "selected=\"selected\"" : ""; ?>>Everybody</option>
									</select>
								</fieldset>
								<fieldset class="kalturaNoBorderFieldSet">	
									<legend><label for="editPermission">Who can edit to video:</label></legend>
									<select name="editPermission" id="editPermission">
										<option value="3" <?php echo @get_option("kaltura_permissions_edit") == "3" ? "selected=\"selected\"" : ""; ?>>Blog Administrators</option>
										<option value="2" <?php echo @get_option("kaltura_permissions_edit") == "2" ? "selected=\"selected\"" : ""; ?>>Blog Editors/Contributors & Authors</option>
										<option value="1" <?php echo @get_option("kaltura_permissions_edit") == "1" ? "selected=\"selected\"" : ""; ?>>Blog Subscribers</option>										
										<option value="0" <?php echo @get_option("kaltura_permissions_edit") == "0" ? "selected=\"selected\"" : ""; ?>>Everybody</option>
									</select>
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
									<input type="radio" name="playerWidth" id="playerWidthMedium" value="260" />&nbsp;&nbsp;<label for="playerWidthMedium">Small (260x252)</label>
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