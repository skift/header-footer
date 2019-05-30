<?php
require_once 'resources/utility.php';
require_once 'resources/podcasts.php';
require_once 'resources/twitter.php';

global $url_paths;

$footer_class = isset($footerClass) ? $footerClass : null;
?>

<footer id="footer" <?php if(!empty($footer_class)) echo 'class="'.$footer_class.'"'; ?> >
	<div id="footer-content">
			<?php 
			ob_start();
			?>
			<div class="footer-column first">
				<div class="footer-item" id="footer-nav">
					<?php 
					do_action('sk_footer_before_column_content', 'footer-nav');
					?>
					<div class="footer-title">Skift Corporate</div>

                    <ul>
						<?php 
						if (has_nav_menu('footer_links')) {
							wp_nav_menu([
								'theme_location' => 'footer_links',
								'container' => false,
								'items_wrap' => '%3$s'
							]);
						} else {
							?>
							<li class="menu-item"><a href="<?php echo $url_paths['main']; ?>/about/">About Skift</a></li>
							<li class="menu-item"><a href="<?php echo $url_paths['skiftx']; ?>/">Advertise With Us</a></li>
							<li class="menu-item"><a href="<?php echo $url_paths['main']; ?>/news-staff/">News Staff</a></li>
							<li class="menu-item"><a href="<?php echo $url_paths['main']; ?>/terms/">Terms of Use</a></li>
							<li class="menu-item"><a href="<?php echo $url_paths['main']; ?>/privacy/">Privacy Policy</a></li>
							<?php
						}
						?>
					</ul>

					<div class="copyright">&copy; <?php echo date('Y'); ?> Skift Inc. All Rights Reserved</div>
				</div>
			</div>
			<!-- first -->
			<?php 
			$first_column = ob_get_clean();

			echo apply_filters('sk_footer_column_content', 'first', $first_column);
			
			ob_start();
			?>
			<div class="footer-column middle">
				<div class="footer-item" id="social">
					<?php 
					do_action('sk_footer_before_column_content', 'social');
					?>
					<div class="footer-title">Follow Us</div>
					<ul>
						<li>
							<a href="<?php echo apply_filters('sk_facebook_link', 'https://facebook.com/skiftnews'); ?>" class="icon" target="_blank" rel="nofollow noopener noreferrer">
								<i class="fa fa-facebook" aria-hidden="true"></i>
							</a>
						</li>
						<li>
							<a href="<?php echo apply_filters('sk_twitter_link', 'https://twitter.com/skift'); ?>" class="icon selected" target="_blank" rel="nofollow noopener noreferrer">
								<i class="fa fa-twitter twitter-icon" aria-hidden="true"></i>
							</a>
						</li>
						<li>
							<a href="<?php echo apply_filters('sk_linkedin_link', 'https://linkedin.com/company/skift');?>" class="icon" target="_blank" rel="nofollow noopener noreferrer">
								<i class="fa fa-linkedin" aria-hidden="true"></i>
							</a>
						</li>
						<li>
							<a href="<?php echo apply_filters('sk_instagram_link', 'https://www.instagram.com/skiftnews/');?>" class="icon" target="_blank" rel="nofollow noopener noreferrer">
								<i class="fa fa-instagram" aria-hidden="true"></i>
							</a>
						</li>
						<li>
							<a href="<?php echo apply_filters('sk_newsletters_link', $url_paths['main'] . '/newsletters/');?>" class="icon">
								<i class="fa fa-envelope" aria-hidden="true"></i>
							</a>
						</li>
					</ul>
					<div id="footer-tweet-box">
						<div id="footer-tweet">
							<?php
                            $tweet = new \HeaderFooter\Tweet;
    				        ?>
							<p id="tweet-content">
								<?php echo $tweet->text;?>
							</p>
							<p id="tweet-meta">
								Twitter | <?php echo $tweet->time; ?>
							</p>
						</div>
					</div>
				</div><!-- social -->
			</div><!-- middle -->
			<?php 
			$middle_column = ob_get_clean();

			echo apply_filters('sk_footer_column_markup', 'middle', $middle_column);
			
			ob_start();
			?>

			<div class="footer-column last">
				<div class="footer-item" id="podcast">
					<?php 
					do_action('sk_footer_before_column_content', 'podcast');
					?>
					<div class="footer-title">Latest Podcast Episodes</div>
					<ul>
						<?php
						$podcasts = \HeaderFooter\Podcast::latest(3);

						foreach ($podcasts as $podcast) { ?>
							<li><a href="<?php echo $podcast->link; ?>">
								<?php echo $podcast->title; ?>&nbsp;<i class="fa fa-chevron-right"></i>
								</a>
							</li>
						<?php } ?>
					</ul>
				</div><!-- #footer-podcast -->
			</div><!-- last -->
			<?php 
			$last_column = ob_get_clean();
			
			echo apply_filters('sk_footer_column_content', 'last', $last_column);
			?>

			<div class="clearfix"></div>

	</div><!-- #footer-content -->

</footer>
