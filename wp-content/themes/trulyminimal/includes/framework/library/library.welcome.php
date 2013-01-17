
					<div class="wWelcome">
						<div class="wScreenshot">
							<img src="<?php bloginfo('stylesheet_directory'); ?>/screenshot.png" alt="Screenshot" />
						</div>

						<div class="wContent">
							<h3>Thanks for purchasing <?php echo THEMENAME; ?>!</h3>
							<div class="wDescription">
								<p>Our easy to use theme panel will allow you to setup, configure and customize your theme.</p>
								<p>Your theme's main features are listed below.</p>
							</div>
						</div>
						
						<div class="clear"></div>
					</div>

					<?php foreach( $tab_options as $feature ) : ?>

					<div class="wFeature feature-<?php echo $feature['id']; ?>">
						<div class="feature-icon"></div>

						<h3><?php echo $feature['name']; ?></h3>
						<?php echo $feature['text']; ?>

					</div>

					<?php endforeach; ?>