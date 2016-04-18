<?php

defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
require_once ('/vendor/autoload.php');
use Abraham\TwitterOAuth\TwitterOAuth;

define('CONSUMER_KEY','WuHJtUO0LrdzIew5wOoFQnWgG');
define('CONSUMER_SECRET','7UIasN2pSAFO8gnTxcNkNGFnq4O9LEEK5Y7Gn3bIeNADC4QgL7');
define('OAUTH_CALLBACK','http://127.0.0.1:80/hint-dev/Login_Twitter/twitterCallback');


class Login extends CI_Controller {
	public $fb;
	public $fbHelper;
	public $fbUser;
	public $twitterConnection;

	public function __construct() {
    parent::__construct();
		$this->fb = new Facebook\Facebook([
		  'app_id' => '1577381945885525',
		  'app_secret' => 'ca59fc1416747a0207b1e1c036334c35',
		  'default_graph_version' => 'v2.3',
	  ]);
		$this->fbHelper = $this->fb->getRedirectLoginHelper();
		$this->load->model('Login_Model');

		$this->twitterConnection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
		$request_token = $this->twitterConnection->oauth('oauth/request_token', array('oauth_callback' => OAUTH_CALLBACK));
  }

  public function index(){
		if($this->session->userdata('twitter')!=null||$this->session->userdata('facebook')!=null || $this->session->userdata('logged_in')['privilage'] == "1"){
			redirect('User');
		}else{
			//fb
			$permissions = ['email'];
			$loginUrl = $this->fbHelper->getLoginUrl('http://127.0.0.1/hint-dev/Login/fbCallBack/',$permissions);
			//tw
			$request_token = $this->twitterConnection->oauth('oauth/request_token', array('oauth_callback' => OAUTH_CALLBACK));
			$twSessionData = array(
				'oauth_token'=>$request_token['oauth_token'],
				'oauth_token_secret'=>$request_token['oauth_token_secret']
			);

			$this->session->set_userdata('twitterToken',$twSessionData);
			$twLoginUrl = $this->twitterConnection->url('oauth/authorize', array('oauth_token' => $request_token['oauth_token']));

			$data['fbLoginUrl'] = $loginUrl;
			$data['twitterLoginUrl']=$twLoginUrl;
			$this->load->view('Login/index.php',$data);
		}
  }

	public function doLogin(){
		$inputEmail = $this->input->post('email');
		$inputPassword = $this->input->post('password');
		$formData = array(
			'email'=>$inputEmail,
			'password'=>md5($inputPassword)
		);
		$loginResult = $this->Login_Model->doLogin($formData,' ');
		if($loginResult==true){
			$userData = $this->Login_Model->doLogin($formData,'userData');
			$loggedUserPrivilage = $userData[0]->id_privilage;
			$sessionData = array(
				'id'=>$userData[0]->id_user,
				'email'=>$userData[0]->id_user,
				'name'=>$userData[0]->name,
				'loginTime' => date('Y-m-d h:i:s', time())
			);
			switch ($loggedUserPrivilage) {
				case '1':
					# User
					$this->setSessionData('loginSession',$sessionData);
					redirect('User');
					break;
				case '2':
					# Admin
					break;
				default:
					# code...
					break;
			}
		}else{
			//fail
			$this->session->set_flashdata('result','Username atau Password Salah');
			redirect('/Login');
		}
	}

	public function doLogout(){
		if($this->session->userdata('facebook')!=null){
			$this->session->unset_userdata('facebook');
			redirect('Login');
		}else if($this->session->userdata('twitter')!=null){
			$this->session->unset_userdata('twitter');
			redirect('Login');
		}else{
			$this->session->unset_userdata('loginSession');
			redirect('Login');
		}
	}

	public function registerUser($fbUser,$registrationType){
		if($registrationType=='facebookRegister'){
			$dataUser = array(
				'name'=>$fbUser['name'],
				'email'=>$fbUser['email'],
	      'password'=>md5($fbUser['id']),
	      'id_privilage'=>'1'
	    );
			$result = $this->Login_Model->registerUser($dataUser);
			return $result;
		}else if($registrationType=='publicRegister'){
			$dataUser = array(
				'name'=>$user['name'],
				'email'=>$user['email'],
	      'password'=>md5($user['password']),
	      'id_privilage'=>'1'
	    );
			$result = $this->Login_Model->registerUser($dataUser);
			return $result;
		}else if($registrationType==md5('jsonRegister')){
			$dataUser=array(
				'name'=>$this->input->post('name'),
				'email'=>$this->input->post('email'),
	      'password'=>$this->input->post('password'),
	      'id_privilage'=>'1'
			);
			$result = $this->Login_Model->registerUser($dataUser);
			$response = array('status'=>$result);
			header("Content-Type: application/json");
			echo json_encode($response);
		}else{
			return false;
		}
	}

	public function checkAlreadyRegisteredUser($key,$value,$requestType){
		if($requestType==md5('jsonRequest')&&$key==md5('email')){
			if($key==md5('email')){
				$key='email';
				$value = $this->input->post('email');
				$result = $this->Login_Model->checkAlreadyRegisteredUser($key,$value);
				$response = array('status'=>$result);
				header("Content-Type: application/json");
				echo json_encode($response);
			}
		}else if($requestType=='generalRequest'){
			$result = $this->Login_Model->checkAlreadyRegisteredUser($key,$value);
			return $result;
		}else{
			return false;
		}
	}

	private function setSessionData($sessionName,$session_data){
		if($this->session->userdata('facebook')!=null){
			$this->session->unset_userdata('facebook');
		}else if($this->session->userdata($sessionName)!=null){
			$this->session->unset_userdata($sessionName);
		}
		$this->session->set_userdata($sessionName,$session_data);
	}

	private function fbGetUser($accessToken){
		try {
			$response = $this->fb->get('/me?fields=id,name,email', $accessToken);
		} catch(Facebook\Exceptions\FacebookResponseException $e) {
		  echo 'Graph returned an error: ' . $e->getMessage();
		  exit;
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
		  echo 'Facebook SDK returned an error: ' . $e->getMessage();
		  exit;
		}
		$fbUser = $response->getGraphUser();
		return $fbUser;
	}

	public function fbCallBack(){
		try {
		  $accessToken = $this->fbHelper->getAccessToken();
		} catch(Facebook\Exceptions\FacebookResponseException $e) {
		  echo 'Graph returned an error: ' . $e->getMessage();
		  exit;
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
		  echo 'Facebook SDK returned an error: ' . $e->getMessage();
		  exit;
		}

		if (isset($accessToken)) {
			$fbUser = $this->fbGetUser($accessToken);
			if(!$this->checkAlreadyRegisteredUser('email',$fbUser['email'],'generalRequest')){
				$this->registerUser($fbUser,'facebookRegister');
			}
			$fbLogoutUrl = $this->fbHelper->getLogoutUrl($accessToken, 'http://localhost/hint-dev/');
			$session_data = array(
				'accessToken' => (string) $accessToken,
				'id'=>$fbUser['id'],
				'name'=>$fbUser['name'],
				'email'=>$fbUser['email'],
				'loginTime' => date('Y-m-d h:i:s', time())
      );
			$this->setSessionData('facebook',$session_data);
			redirect('Login');
		}
	}
}

?>
