<?php
namespace HeaderFooter;

class TwitterClient {
    public $latest_tweet;
    private static $api_key = 'yaa6xQpwIrIAFhJgsTgpQfqcm'; // Consumer Key (API Key)
    private static $api_secret = 'uHCaJ3bQmIMARlbOjsmoMn90siO2le90ltQ9zrZTEQ63dk4oUO'; // Consumer Secret (API Secret)
    private static $twitter_base = 'https://api.twitter.com';
    public static $screen_name = 'skift'; // username


    public function __construct($tweet_count = 1) {
        $this->tweet_count = $tweet_count;
        $this->utility = new CacheUtility('latest-tweet.json');
        $this->read_or_fetch_tweets();
        $this->latest_tweet = $this->latest_tweets[0];
    }

    protected function read_or_fetch_tweets() {
        if ($this->utility->cached_contents) {
            $this->latest_tweets = $this->utility->cached_contents;
        } else {
            $this->fetch_tweets();
        }
    }

    private function fetch_tweets() {
        $auth_token = self::api_access_token();
        $query_url = '1.1/statuses/user_timeline.json?count=' . $this->tweet_count . '&screen_name=' . self::$screen_name;
        $request = new \Curl(
            $query_url,
            array(),
            "Authorization: Bearer $auth_token",
            'application/json',
            self::$twitter_base
        );
        $response = $request->get();
        $this->utility->write_to_cache($response);
        $this->latest_tweets = json_decode($response, true);
    }

    private static function api_access_token() {
        $api_key = urlencode(self::$api_key);
        $api_secret = urlencode(self::$api_secret);
        $api_credentials = base64_encode("$api_key:$api_secret");
        $payload = array(
            'grant_type' => 'client_credentials'
        );

        $request = new \Curl(
            'oauth2/token',
            http_build_query($payload),
            "Authorization: Basic $api_credentials",
            'application/x-www-form-urlencoded;charset=UTF-8',
            self::$twitter_base
        );
        $response = $request->post();
        try {
            $auth_response = json_decode($response, true);
        } catch (\Exception $e) {
            error_log('Twitter Error: ' . $e);
        }

        if (is_array($auth_response) && array_key_exists('access_token', $auth_response)) {
            return $auth_response['access_token'];
        } else {
            return false;
        }
    }
}

class Tweet {
    public function __construct() {
        $client = new TwitterClient();
        $this->tweet = (object)$client->latest_tweet;
        $this->text = $this->tweet->text;
        $this->parse_urls();
        $this->time = $this->set_time();
    }

    private function set_time() {
        $time = human_time_diff(time(), strtotime($this->tweet->created_at));
        return $time . ' ago';
    }

    private function parse_urls() {
        $url_regex = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
        $text = $this->text;
        if (preg_match_all($url_regex, $text, $url)) {

            // make the urls links
            $urls = $url[0];

            foreach ($urls as $link) {
               $text = str_replace($link, "<a href=\"$link\">$link</a>", $text);
            }
        }
        $this->text = $text;
    }
}

?>
