<?php
if (!defined("BASEPATH")) {
    exit("No direct script access allowed");
}

/* Template parser for passing dynamic data to a single page
Author: Steven Kurniawan
©2019
*/ 

class Template_Parser {
    protected $instance;

    function __construct() {
        $this->instance =& get_instance();
        $this->instance->load->helper("array");
        $this->instance->load->helper("url");
        $this->instance->load->library("parser");
    }

    function load($config = [], $view = "page/page") {
        $data = [];
        $loaded_view = $this->instance->load->view($view, null, true);
        preg_match_all("/\\{(.*?)\\}/", $loaded_view, $match);
        $match[0] = preg_replace('/\{|\}/','',$match[0]);
        $config = is_array($config) ? $config : [];
        foreach ($match[0] as $key => $value) {
            if (array_key_exists($value, $config)) {
                $data[$value] = $config[$value];
            } else {
                $data[$value] = null;
            }

            if ($value == "base_url") {
                $data["base_url"] = base_url();
            }
        }
        $this->instance->parser->parse($view, $data);
    }
}
?>
