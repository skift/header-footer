<?php
function getLatestTweet() {
    $latestTweet = getTweets(1);
    return $latestTweet[0];
}
function getTweets($num) {
    $api_key = urlencode('yaa6xQpwIrIAFhJgsTgpQfqcm'); // Consumer Key (API Key)
    $api_secret = urlencode('uHCaJ3bQmIMARlbOjsmoMn90siO2le90ltQ9zrZTEQ63dk4oUO'); // Consumer Secret (API Secret)
    $auth_url = 'https://api.twitter.com/oauth2/token';

    // what we want?
    $data_username = 'skift'; // username
    $data_count = $num; // number of tweets
    $data_url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';

    // get api access token
    $api_credentials = base64_encode($api_key.':'.$api_secret);

    $auth_headers = 'Authorization: Basic '.$api_credentials."\r\n".
                    'Content-Type: application/x-www-form-urlencoded;charset=UTF-8'."\r\n";

    $auth_context = stream_context_create(
        array(
            'http' => array(
                'header' => $auth_headers,
                'method' => 'POST',
                'content'=> http_build_query(array('grant_type' => 'client_credentials', )),
            )
        )
    );

    $auth_response = json_decode(file_get_contents($auth_url, 0, $auth_context), true);
    $auth_token = $auth_response['access_token'];

    // get tweets
    $data_context = stream_context_create( array( 'http' => array( 'header' => 'Authorization: Bearer '.$auth_token."\r\n", ) ) );

    $tweets = json_decode(file_get_contents($data_url.'?count='.$data_count.'&screen_name='.urlencode($data_username), 0, $data_context), true);

    return $tweets;
}   
?>

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
						<li class="menu-item"><a href="http://www.skiftx.com">Advertising</a></li>
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
                        function get_recent_podcasts_footer( $num ){
                            $url = "http://podcast.skift.com/feed/";
                            $rss = fetch_feed ($url);
                        
                            $first_group = $rss->get_item_quantity($num);
                            return $rss->get_items(0, $first_group);
                        }
                        
						$rss_items = get_recent_podcasts_footer(3);
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