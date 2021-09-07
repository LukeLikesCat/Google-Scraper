<?php

class Search {
    public static $data_array = array();
    protected $web_mods;
    protected $xpath_query;
    protected $curl;
    protected $str_mods;
    protected $page;
    protected $pc;

    public function __construct($web_mods, $xpath_query, $curl, $str_mods, $page, $pc) {
        $this->web_mods = $web_mods;
        $this->xpath_query = $xpath_query;
        $this->curl = $curl;
        $this->str_mods = $str_mods;
        $this->page = $page;
        $this->pc = $pc;

    }
}

?>