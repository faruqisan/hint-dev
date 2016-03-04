<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
require_once ('/vendor/autoload.php');

class User extends CI_Controller {
	public $fb;
	public $helper;
	public $user;

	public function __construct() {
    parent::__construct();
		$this->fb = new Facebook\Facebook([
		  'app_id' => '1577381945885525',
		  'app_secret' => 'ca59fc1416747a0207b1e1c036334c35',
		  'default_graph_version' => 'v2.3',
	  ]);
		$this->helper = $this->fb->getRedirectLoginHelper();
  }

  public function index(){
		$data['dataTravel'] = $this->getJSONData('http://128.199.254.147/hint/data-travel.json');
    $this->load->view('User/index.php',$data);
  }

	public function getJSONData($url){
		$json = file_get_contents($url);
		$obj = json_decode($json);
		return $obj;
	}

}
?>
