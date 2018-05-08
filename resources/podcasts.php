<?php
namespace HeaderFooter;

class PodcastClient extends \Curl {
    public function __construct($resource = null) {
        isset($resource) or $resource = 'posts?per_page=3';
        parent::__construct($resource, array(), null, null, 'http://podcast.skift.com/wp-json/wp/v2');
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
        $response = $this->get();
        $this->utility->write_to_cache($response);
        return json_decode($response, true);
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
        $client = new PodcastClient();
        $podcasts = $client->latest_podcasts;
        return array_map(function($p){
            return new Podcast($p);
        }, $podcasts);
    }
}

?>
