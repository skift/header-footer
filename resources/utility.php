<?php

namespace HeaderFooter;

class CacheUtility {
    public function __construct($cache) {
        $this->cache = get_template_directory() . '/inc/resource-cache/' . $cache;
        $this->check_for_cached_contents();
    }
    public function check_for_cached_contents() {
        if ($this->use_cache()) {
            $cached_contents = file_get_contents($this->cache);
            if (!empty($cached_contents)) {
                $this->cached_contents = json_decode($cached_contents);
                return;
            }
        }
        $this->cached_contents = false;
    }

    public function use_cache() {
        $cached_time = filemtime($this->cache);

        return time() - $cached_time < (60 * 60);
    }

    public function write_to_cache($response) {
        file_put_contents($this->cache, $response);
    }
}
?>