<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
    }
    
    public function index() {
		$html = '
		<table>
			{row}
					<tr>
						{column}
							<td>{value}</td>
						{/column}
					</tr>
				
			{/row}
		</table>';
		$data = [
			"row" => [
				[
					"column" => [
						["value" => "1st"],
						["value" => "2nd"],
						["value" => "3rd"],
					],
				],
				[
					"column" => [
						["value" => "4th"],
						["value" => "5th"],
						["value" => "6th"],
					],
				]
			],
		];
		$result = $this->template_parser->load_with_string($html, $data);

		$config = [
			'title' => 'Web Title',
			'main' => $this->template_parser->load_data([
				"data" => $result
			], "main"),
			"data" => $this->template_parser->load_with_string($html, $data)
		];
		$this->template_parser->load($config, "page/page");
	}
}