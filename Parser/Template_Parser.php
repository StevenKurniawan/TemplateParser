<?php
if (!defined("BASEPATH")) {
    exit("No direct script access allowed");
}

/* Template parser for passing dynamic data to view file
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

    private function check_matching_bracket($view, $config) {
        $data = [];
        preg_match_all("/\\{(.*?)\\}/", $view, $match);
        $match[0] = preg_replace('/\{|\}/','',$match[0]);
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
        return $data;
    }

    function load($config = [], $view = "page/page") {
        $loaded_view = $this->instance->load->view($view, null, true);
        $data = $this->check_matching_bracket($loaded_view, $config);
        $this->instance->parser->parse($view, $data);
    }

    function load_data($config = [], $view) {
        $loaded_view = $this->instance->load->view($view, null, true);
        $data = $this->check_matching_bracket($loaded_view, $config);
        return $this->instance->parser->parse($view, $data, true);
    }

    function load_with_string($html, $config = []) {
        if ($html == "") return false;
        if (!is_array($config)) return false;
        $data = $this->check_matching_bracket($html, $config);

        return $this->instance->parser->parse_string($html, $data, true);
    }
}
?>
