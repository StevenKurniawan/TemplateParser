<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
    }
    
    public function index() {
		$config = [
			'title' => 'Web Title',
			'main' => $this->load->view("main", null, true),
		];
		$this->template_parser->load($config, "page/page2");
	}
}
// sdfsdf