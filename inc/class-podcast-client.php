<?php

namespace Skift\Header_Footer;

class Podcast_Client {
    const API_URL = 'https://podcast.skift.com/wp-json/wp/v2/posts';

    public function __construct($num = 3) {
        $this->num = $num;
        $this->utility = new CacheUtility('podcasts.json');
        $this->read_or_fetch_podcasts();
    }

    public function read_or_fetch_podcasts() {
        if ($this->utility->cached_contents) {
            $this->latest_podcasts = $this->utility->cached_contents;
        } else {
            $this->latest_podcasts = $this->fetch_podcasts();
        }
    }

    private function fetch_podcasts() {
        $response = wp_remote_get(self::API_URL . '?per_page=' . $this->num);
        if (is_wp_error($response)) {
            return false;
        }

        $body = $response['body'];
        $this->utility->write_to_cache($body);
        return json_decode($body, true);
    }

}