<?php
namespace Skift\Header_Footer;

class Tweet {
    public function __construct() {
        $client = new Twitter_Client;
        $latest_tweet = $client->latest_tweet;
        if ($latest_tweet) {
            $this->tweet = (object)$client->latest_tweet;
            $this->text = $this->tweet->text;
            $this->parse_urls();
            $this->time = $this->set_time();
        } else {
            $this->tweet = false;
            $this->text = false;
            $this->time = false;
        }
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
