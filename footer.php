<footer id="footer" <?php if(!empty($footerClass)) echo 'class="'.$footerClass.'"'; ?> >
	<div id="footer-content">
			<div class="footer-column first">
				<div class="footer-item" id="footer-nav">
					<div class="footer-title">Skift Corporate</div>
						<?php
/*
							wp_nav_menu(array(
								'theme_location' => 'footer-menu',
								'container' => false,
								'items_wrap' => '%3$s',
							));
*/
                        ?>
                    <ul>
						<li class="menu-item"><a href="<?php echo home_url(); ?>/about">About Skift</a></li>
						<li class="menu-item"><a href="<?php echo home_url(); ?>/advertise">Advertise</a></li>
                        <li class="menu-item"><a href="<?php echo home_url(); ?>/terms">Terms of Use</a></li>
                        <li class="menu-item"><a href="<?php echo home_url(); ?>/privacy">Privacy Policy</a></li>
					</ul>
				</div>
			</div><!-- first -->

			<div class="footer-column middle">
				<div class="footer-item" id="social">
					<div class="footer-title">Follow Us</div>
					<ul>
						<li>
							<a href="https://facebook.com/skiftnews" class="icon">
								<i class="fa fa-facebook" aria-hidden="true"></i>
							</a>
						</li>
						<li>
							<a href="https://twitter.com/skift" class="icon selected">
								<i class="fa fa-twitter twitter-icon" aria-hidden="true"></i>
							</a>
						</li>
						<li>
							<a href="https://linkedin.com/company/skift" class="icon">
								<i class="fa fa-linkedin" aria-hidden="true"></i>
							</a>
						</li>
						<li>
							<a href="<?php echo home_url(); ?>/newsletters/" class="icon">
								<i class="fa fa-envelope" aria-hidden="true"></i>
							</a>
						</li>
					</ul>
					<div id="footer-tweet-box">
						<div id="footer-tweet">
							<?php
                            $tweet = getLatestTweet();
                            
                            $tweetText = $tweet['text'];
                            $tweetTime = human_time_diff(time(), strtotime($tweet['created_at']));

                            $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
                            
                            // Check if there is a url in the text
                            if (preg_match_all($reg_exUrl, $tweetText, $url)) {
                               // make the urls links
                               $urls = $url[0];
                               
                               foreach ($urls as $link) {
                                   $tweetText = str_replace($link, "<a href=\"$link\">$link</a>", $tweetText);
                               }
                            }
    				        ?>
							<p id="tweet-content">
								<?php echo $tweetText;?>
							</p>
							<p id="tweet-meta">
								Twitter | <?php echo $tweetTime; ?> ago
							</p>
						</div>
					</div>
				</div><!-- social -->
			</div><!-- middle -->

			<div class="footer-column last">
				<div class="footer-item" id="podcast">
					<div class="footer-title">Listen to us</div>
					<ul>
						<?php
						$rss_items = get_recent_podcasts(3);
						foreach ($rss_items as $item) : ?>
							<li><a target="_blank" href="<?php echo esc_url( $item->get_permalink() ); ?>">
								<?php echo esc_html( $item->get_title() ); ?>&nbsp;<i class="fa fa-chevron-right"></i>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
				</div><!-- #footer-podcast -->
			</div><!-- last -->
			<div class="clearfix"></div>

		<!--<div id="footer-info">


			<p class="copyright">&copy;<?php echo date('Y'); ?> <a href="<?php echo home_url(); ?>">Skift</a> All Rights Reserved</p>
		</div><!-- #footer-info -->

	</div><!-- #footer-content -->

</footer>