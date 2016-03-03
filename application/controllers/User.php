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
    $this->load->view('User/index.php');
  }

}
?>
