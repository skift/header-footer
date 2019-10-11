<?php
namespace Skift\Header_Footer;

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
        $client = new Podcast_Client($num);
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
