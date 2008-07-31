<div class="<?php echo ($viewData["isLibrary"]) ? "wrap" : "kalturaTab"?>">
	<?php if (!count(@$viewData["result"]["kshows"])): ?>
		<div class="updated kalturaUpdated">No interactive videos created yet</div>
	<?php else: ?>
		<ul id="kalturaBrowse" class="<?php echo ($viewData["isLibrary"]) ? " library" : ""?>">
		<?php foreach($viewData["result"]["kshows"] as $kshow): ?>
			<li>
				<?php 
					$desc = $kshow["showEntry"];
					$editUrl = kalturaGenerateTabUrl(array("kaction" => "edit", "kshowid" => $kshow["id"]));
					$sendToEditorUrl =  kalturaGenerateTabUrl(array("kaction" => "sendtoeditor", "kshowid" => $kshow["id"]));
				?>
				
				<div class="showName">
					<?php echo $kshow["name"] ?><br />
				</div>
				<div style="height: 100px;">
					<a href="<?php echo $editUrl; ?>" style="border: none;">
						<img src="<?php echo $desc["thumbnailUrl"]; ?>" alt="<?php $kshow["name"] ?>" />
					</a>
				</div>
				<div class="submit">
					<input type="button" class="button-secondary editButton" onclick="window.location = '<?php echo $editUrl; ?>';" value="<?php echo attribute_escape( __( 'Edit' ) ); ?>" />
					<?php if (!$viewData["isLibrary"]): ?>
					<input type="button" class="button-secondary sendButton" onclick="window.location = '<?php echo $sendToEditorUrl; ?>';" value="<?php echo attribute_escape( __( 'Insert into Post' ) ); ?>" />
					<?php endif; ?>
				</div>
			</li>
		<?php endforeach; ?>
		</ul>
		<br class="clear" />
		
		<?php
			$page_links = paginate_links( 
				array(
					'base' => add_query_arg( 'paged', '%#%' ),
					'format' => '',
					'total' => $viewData["totalPages"],
					'current' => $viewData["page"]
				)
			);

			if ($page_links)
				echo "<div class=\"kalturaPager\">$page_links</div>";
		?>
	<?php endif; ?>
	<br class="clear" />
</div>
