<?php
	$flashVarsStr = KalturaHelpers::flashVarsToString($viewData["flashVars"]);
?>
<div class="<?php echo ($viewData["isLibrary"]) ? " wrap" : "kalturaTab"?>">
	<?php if (!@$_POST["update"]): ?>
		<form method="post" class="kalturaForm">
		<table id="kalturaEditTable" class="form-table kalturaFormTable">
			<tr>
				<td valign="top" width="250">
					<div id="divKalturaThumbnail" style="width:250px;height:244px;" class="kalturaHand" onclick="Kaltura.activatePlayer('divKalturaThumbnail','divKalturaPlayer');">
						<div class="playerName"><nobr><?php echo @$kshow["name"]; ?></nobr></div>
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
						<legend><label for="kshowName">Enter Title</label></legend>
						<div><input id="kshowName" name="kshowName" type="text" size="40" value="<?php echo @$kshow["name"]; ?>" /></div>
					</fieldset>
					<fieldset class="kalturaNoBorderFieldSet">
						<legend><label for="kshowDescription">Enter Description</label></legend>
						<div><input id="kshowDescription" name="kshowDescription" type="text" size="40" value="<?php echo @$kshow["description"]; ?>" /></div>
					</fieldset>
					<div id="kalturaEditButtons" class="submit">
						<input type="button" value="Delete" name="delete" class="button-secondary" onclick="window.location = '<?php echo kalturaGenerateTabUrl(array("kaction" => "delete", "kshowid" => $kshowId)); ?>';" style="float: left;"/>
						<?php if ($viewData["isLibrary"]): ?>
						<input type="button" value="Edit Video" name="video_editor" class="button-secondary" onclick="KalturaModal.openModal('simple_editor', '<?php echo kalturaGetPluginUrl() ?>/page_simple_editor_library.php?kshowid=<?php echo $kshowId; ?>', { width: 890, height: 546 } ); jQuery('#simple_editor').addClass('modalSimpleEditor');" style="float: left;"/>
						<?php else: ?>
						<input type="button" value="Edit Video" name="video_editor" class="button-secondary" onclick="window.location = '<?php echo kalturaGetPluginUrl() ?>/page_simple_editor_admin.php?kshowid=<?php echo $kshowId; ?>&backurl=<?php echo urlencode(kalturaGetRequestUrl()); ?>';" style="float: left;"/>
						<?php endif; ?>
						<input type="submit" value="Update" name="update" class="button-secondary" style="font-weight: bold;"/>
					</div>
				</td>
			</tr>
		</table>
		</form>
	<?php endif; ?>
	<br class="clear" />
</div>