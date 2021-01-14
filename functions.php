<?php
// Arbitrary commit
function check_for_cached_tweet($cache_file_path) {
    $cached_time = filemtime($cache_file_path);

    $use_cache = time() - $cached_time < (60 * 60);

    if ($use_cache) $cached_contents = file_get_contents($cache_file_path);

    return $cached_contents;
}

function get_latest_tweet() {
    $latest_tweet = get_tweets(1);
    return $latest_tweet[0];
}

function get_tweets($num) {
    $cache_file_path = get_template_directory() . "/inc/resource-cache/latest-tweet.json";

    $cached_resource = check_for_cached_tweet($cache_file_path);

    if (empty($cached_resource)) {
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


        $json = file_get_contents($data_url.'?count='.$data_count.'&screen_name='.urlencode($data_username), 0, $data_context);
        $tweets = json_decode($json, true);

         //save response to the cache file
        $cache_file = fopen($cache_file_path, "w") or die("Unable to open cache file!");
        fwrite($cache_file, $json);
        fclose($cache_file);

        return $tweets;
    } else {
        return json_decode($cached_resource, true);
    }
}

function get_recent_podcasts_footer( $num ){
    $url = "http://podcast.skift.com/feed/";
    $rss = fetch_feed($url);

    if (!is_wp_error($rss)) {
        $first_group = $rss->get_item_quantity($num);
        $podcasts = $rss->get_items(0, $first_group);

        $return = array();

        foreach ($podcasts as $podcast) {
            $link = esc_url($podcast->get_permalink());
            $title = esc_html($podcast->get_title());

            $thisPodcast = array(
                "link" => $link,
                "title" => $title
            );

            array_push($return, $thisPodcast);
        }

        return $return;
    } else {
        $rss = file_get_contents($url);
        $rss = simplexml_load_string($rss);

        $podcasts = $rss->channel;

        $return = array();

        for ($i = 0; $i < 3; $i++) {
            $link = esc_url($podcasts->item[$i]->link);
            $title = esc_html($podcasts->item[$i]->title);

            $thisPodcast = array(
                "link" => $link,
                "title" => $title
            );

            array_push($return, $thisPodcast);
        }

        return $return;
    }

}


?>