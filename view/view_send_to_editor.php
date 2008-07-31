<?php if ($viewData["widgetId"]): ?>
<script type="text/javascript">
	var size = "<?php echo $viewData["playerSize"]; ?>";
	var html = '[kaltura-widget wid="<?php echo $viewData["widgetId"]; ?>" size="'+size+'" /]';
	window.top.tinyMCE.execCommand('mceInsertRawHTML', false, html);
	//window.top.tinyMCE.execCommand("mceCleanup");
	
	setTimeout('window.top.tb_remove()', 0);
</script>
<?php else: ?>
<?php
	$flashVarsStr = $flashVarsStr = KalturaHelpers::flashVarsToString($viewData["flashVars"]);
?>
<div class="kalturaTab">
	<form method="post" class="kalturaForm">
		<table id="kalturaEditTable" class="form-table kalturaFormTable">
			<tr>
				<td valign="top" width="180">
					<div id="divKalturaThumbnail" style="width:250px;height:244px;" class="kalturaHand" onclick="Kaltura.activatePlayer('divKalturaThumbnail','divKalturaPlayer');">
						<img src="<?php echo $viewData["thumbnailPlaceHolderUrl"]; ?>"  />
					</div>
					<div id="divKalturaPlayer" style="display: none"></div>
					<script type="text/javascript">
						var kalturaSwf = new SWFObject("<?php echo $viewData["swfUrl"]; ?>", "swfKalturaPlayer", "250", "244", "9", "#000000");
						kalturaSwf.addParam("flashVars", "<?php echo $flashVarsStr; ?>");
						kalturaSwf.addParam("wmode", "opaque");
						kalturaSwf.addParam("allowScriptAccess", "always");
						kalturaSwf.addParam("allowFullScreen", "true");
						kalturaSwf.addParam("allowNetworking", "all");
						kalturaSwf.write("divKalturaPlayer");
					</script>
				</td>
				<td id="kalturaEditRight" valign="top">
					<?php if (@$_GET["firstedit"] != "true"): ?>
					<div class="backDiv">
						<a href="<?php echo kalturaGenerateTabUrl(array()); ?>"><img src="<?php echo kalturaGetPluginUrl(); ?>/images/back.gif" alt="Back"/></a>
					</div>
					<?php endif; ?>
					<fieldset class="kalturaNoBorderFieldSet">
						<legend><label for="kshowName">Select player size:</label></legend>
					</fieldset>
					<fieldset class="kalturaNoBorderFieldSet">
						<input type="radio" name="playerSize" id="playerSizeLarge" value="large" checked="checked" />&nbsp;&nbsp;<label for="playerSizeLarge">Large (400x426)</label><br />
					</fieldset>
					<fieldset class="kalturaNoBorderFieldSet">
						<input type="radio" name="playerSize" id="playerSizeMedium" value="small" />&nbsp;&nbsp;<label for="playerSizeMedium">Small (268x308)</label>
					</fieldset>
					<p id="kalturaEditButtons" class="submit">
						<input type="submit" value="<?php echo attribute_escape( __( 'Insert into Post' ) ); ?>" name="sendToEditorButton" class="button-secondary" />
					</p>
				</td>
			</tr>
		</table>
	</form>			
</div>
<?php endif; ?>