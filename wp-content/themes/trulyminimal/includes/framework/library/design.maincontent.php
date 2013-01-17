
			<div id="fpMainContent">
				<noscript>
					<div class="updated"><p><strong>Error:</strong> For a properly functioning, you must have javascript enabled!</p></div>
				</noscript>

				<?php global $panel_options; ?>
				<?php foreach( $panel_options as $tab ) : ?>

				<div id="_<?php echo $tab['id']; ?>" class="<?php echo $tab['id']; ?>">
					<div class="tab-title"><div class="tab-image"></div><?php echo $tab['name']; ?></div>

					<?php framework_build_options_list( $tab['type'], $tab['options'] ); ?>

				</div>

				<?php endforeach; ?>
			</div>