
			<div id="fpNavigation">
			<ul>
				<?php global $panel_options; ?>
				<?php foreach( $panel_options as $nav ) : ?>
				<li class="fp-nav icon-<?php echo $nav['id']; ?>"><div class="fp-nav-image"></div><a href="#_<?php echo $nav['id']; ?>" class="fp-nav-link"><?php echo $nav['name']; ?></a></li>
				<?php endforeach; ?>
			</ul>

			<noscript>
				<div class="updated"><p><strong>Error:</strong> For a properly functioning, you must have javascript enabled!</p></div>
			</noscript>

			<?php if (FRAMEWORK_HAS_UPDATE) : ?>
				<div class="updated"><p><strong>Warning!</strong> There is a new version for this theme. Please update soon.</p></div>
			<?php endif; ?>
			</div>