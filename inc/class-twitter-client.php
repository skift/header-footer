<?php 
namespace Skift\Header_Footer;

class Twitter_Client {
    public $latest_tweet;
    private static $api_key = 'yaa6xQpwIrIAFhJgsTgpQfqcm'; // Consumer Key (API Key)
    private static $api_secret = 'uHCaJ3bQmIMARlbOjsmoMn90siO2le90ltQ9zrZTEQ63dk4oUO'; // Consumer Secret (API Secret)
    private static $twitter_base = 'https://api.twitter.com/';
    public static $screen_name = 'skift'; // username


    public function __construct($tweet_count = 1) {
        $this->tweet_count = $tweet_count;
        $this->utility = new Cache_Utility('latest-tweet.json');
        $this->read_or_fetch_tweets();
        $tweets = $this->latest_tweets;
        if (is_array($tweets)) {
            $this->latest_tweet = $this->latest_tweets[0];
        } else {
            $this->latest_tweet = '';
        }
        
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
        $query_url = self::$twitter_base . '1.1/statuses/user_timeline.json?count=' . $this->tweet_count . '&screen_name=' . self::$screen_name;
        $response = wp_remote_get($query_url, [
            'headers' => [
                'Authorization' => 'Bearer ' . $auth_token,
                'Content-type' => 'application/json'
            ]
        ]);        
        
        if (is_wp_error($response) || !array_key_exists('body', $response)) {
            return false;
        } 
        $body_response = json_decode($response['body']);
        if (array_key_exists('errors', $body_response)) {
            error_log('Twitter API Error: ' . print_r($body_response['errors']));
            return;
        }

        $this->utility->write_to_cache($response['body']);
        $this->latest_tweets = json_decode($response['body'], true);
    }

    private static function api_access_token() {
        $api_key = urlencode(self::$api_key);
        $api_secret = urlencode(self::$api_secret);
        $api_credentials = base64_encode("$api_key:$api_secret");
        $payload = [
            'grant_type' => 'client_credentials'
        ];

        $response = wp_remote_post(self::$twitter_base . 'oauth2/token', [
            'body' => $payload,
            'headers' => [
                'Authorization' => 'Basic ' . $api_credentials,
                'Content-type' => 'application/x-www-form-urlencoded;charset=UTF-8'
            ]
        ]);

        if (is_wp_error($response)) {
            return false;
        } 
        
        $auth_response = json_decode($response['body'], true);
        if (array_key_exists('errors', $auth_response) || !is_array($auth_response)) {
            error_log('Twitter API error: ' . print_r($auth_response['errors']));
            return false;
        } else {
            return $auth_response['access_token'];
        }
    }
}
