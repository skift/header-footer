<?php
namespace HeaderFooter;

class PodcastClient {
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

class Podcast {
    public $title;
    public $link;

    public function __construct($podcast) {
        $podcast = (object)$podcast;
        $podcast_title = (object)$podcast->title; //May be in array format if not cached
        $this->title = $podcast_title->rendered;
        $this->link = $podcast->link;
    }

    public static function latest($num = 3) {
        $client = new PodcastClient($num);
        $podcasts = $client->latest_podcasts;
        if (!is_iterable($podcasts)) {
            return;
        } else {
            return array_map(function($p){
                return new Podcast($p);
            }, $podcasts);
        }
    }
}

?>
