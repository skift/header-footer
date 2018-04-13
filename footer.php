<?php
global $url_paths;
?>

<footer id="footer" <?php if(!empty($footerClass)) echo 'class="'.$footerClass.'"'; ?> >
	<div id="footer-content">
			<div class="footer-column first">
				<div class="footer-item" id="footer-nav">
					<div class="footer-title">Skift Corporate</div>

                    <ul>
						<li class="menu-item"><a href="<?php echo $url_paths['main']; ?>/about/">About Skift</a></li>
						<li class="menu-item"><a href="<?php echo $url_paths['skiftx']; ?>">Advertise With Us</a></li>
						<li class="menu-item"><a href="<?php echo $url_paths['main']; ?>/news-staff">News Staff</a></li>
                        <li class="menu-item"><a href="<?php echo $url_paths['main']; ?>/terms/">Terms of Use</a></li>
                        <li class="menu-item"><a href="<?php echo $url_paths['main']; ?>/privacy/">Privacy Policy</a></li>
					</ul>

					<div class="copyright">&copy; <?php echo date('Y'); ?> Skift Inc. All Rights Reserved</div>
				</div>
			</div>
            <!-- first -->

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
							<a href="https://www.instagram.com/skiftnews/" class="icon">
								<i class="fa fa-instagram" aria-hidden="true"></i>
							</a>
						</li>
						<li>
							<a href="<?php echo $url_paths['main']; ?>/newsletters/" class="icon">
								<i class="fa fa-envelope" aria-hidden="true"></i>
							</a>
						</li>
					</ul>
					<div id="footer-tweet-box">
						<div id="footer-tweet">
							<?php
                            $tweet = get_latest_tweet();

                            $tweet_text = $tweet['text'];
                            $tweet_time = human_time_diff(time(), strtotime($tweet['created_at']));

                            $regex_url = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

                            // Check if there is a url in the text
                            if (preg_match_all($regex_url, $tweet_text, $url)) {
                               // make the urls links
                               $urls = $url[0];

                               foreach ($urls as $link) {
                                   $tweet_text = str_replace($link, "<a href=\"$link\">$link</a>", $tweet_text);
                               }
                            }
    				        ?>
							<p id="tweet-content">
								<?php echo $tweet_text;?>
							</p>
							<p id="tweet-meta">
								Twitter | <?php echo $tweet_time; ?> ago
							</p>
						</div>
					</div>
				</div><!-- social -->
			</div><!-- middle -->

			<div class="footer-column last">
				<div class="footer-item" id="podcast">
					<div class="footer-title">Latest Podcast Episodes</div>
					<ul>
						<?php
						$podcasts = get_recent_podcasts_footer(3);

						foreach ($podcasts as $podcast) { ?>
							<li><a target="_blank" href="<?php echo $podcast["link"]; ?>">
								<?php echo $podcast["title"]; ?>&nbsp;<i class="fa fa-chevron-right"></i>
								</a>
							</li>
						<?php } ?>
					</ul>
				</div><!-- #footer-podcast -->
			</div><!-- last -->
			<div class="clearfix"></div>

	</div><!-- #footer-content -->

</footer>
