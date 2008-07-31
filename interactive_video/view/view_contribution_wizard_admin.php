<script type="text/javascript">

	var kshowId = null;
	var topWindow = Kaltura.getTopWindow();
	function onContributionWizardAfterAddEntry(obj)
	{
		if (obj && obj.length > 0 && obj[0].kshowId)
			kshowId = obj[0].kshowId;
			
		jQuery.ajax(
			{
				url: "<?php echo kalturaGetPluginUrl(); ?>/ajax_update_kshow_name.php",
				dataType: "html",
				method: "GET",
				data: { kshowId: kshowId }
			}
		);
	}
	
	function onContributionWizardClose(modified)
	{
		setTimeout("onContributionWizardCloseTimeouted("+modified+");");
	}
	
	function onContributionWizardCloseTimeouted(modified)
	{
		jQuery("#kaltura_contribution_wizard_wrapper").empty();
		
		if (modified && kshowId)
		{
			jQuery.ajax(
				{
					url: "<?php echo kalturaGetPluginUrl(); ?>/ajax_update_kshow_name.php",
					success: updateKShowCompleteHandler,
					error: updateKShowCompleteHandler,
					dataType: "html",
					method: "GET",
					data: { kshowId: kshowId }
				}
			);
		}
		else
		{
			// timeout needed because we are removing an iframe that is the current caller (this iframe) 
			setTimeout("topWindow.tb_remove()", 0);
		}
	}
	
	function updateKShowCompleteHandler() {
		// go to edit mode
		var url = "<?php echo kalturaGenerateTabUrl(array("tab" => "kaltura_browse", "kaction" => "edit", "firstedit" => "true")); ?>&kshowid="+kshowId;
		
		topWindow.Kaltura.restoreModalSize(
			function () {
				window.location.href = url
			}
		);
	}
	
	// fix mac firefox opacity bug
	if (Kaltura.isMacFF())
		Kaltura.hideTinyMCEToolbar();
	
	// fix the height of the tabs so the contribution wizard would be in full window height
	jQuery("#media-upload-header").css("height", "33px");

	// add event for the tabs menu link to restore the original modal dimensions
	jQuery('#media-upload-header li a').click(function () {
		if (jQuery(this).parent().get(0).id == "tab-kaltura")
			return;
			
		topWindow.jQuery("#TB_iframeContent").stop();
		topWindow.jQuery("#TB_window").stop();
		
		jQuery("#kaltura_contribution_wizard_wrapper").empty();
		
		// restore the mac firefox opacity bug workaround
		if (Kaltura.isMacFF())
			Kaltura.showTinyMCEToolbar();
			
		jQuery("#tab-kaltura a").removeClass("current");
		jQuery(this).addClass("current");
		
		var tabHref = this.href;
		topWindow.Kaltura.restoreModalSize(
			function () {
	      		window.location.href = tabHref
      		}
      	); 
		
		return false;
	});
	
	jQuery(window).unload(function () {
		// restore the mac firefox opacity bug workaround
		if (Kaltura.isMacFF())
			Kaltura.showTinyMCEToolbar();
	})

	// kaltura page shouldn't refresh the tab
	jQuery("#tab-kaltura a").get(0).href = "#";

	if (Kaltura.compareWPVersion("2.6", ">=")) {
		topWindow.Kaltura.hackModalBoxWp26();
	}
</script>

<?php
$viewData["extraCWHeight"] = 34;
require_once("view_contribution_wizard.php");
?>