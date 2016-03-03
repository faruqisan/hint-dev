<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
require_once ('/vendor/autoload.php');

class Login extends CI_Controller {
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
		$this->load->model('Login_Model');
  }

  public function index(){
		if($this->session->userdata('facebook')!=null || $this->session->userdata('logged_in')['privilage'] == "1"){
			redirect('User');
		}else{
			$permissions = ['email'];
			$loginUrl = $this->helper->getLoginUrl('http://localhost/hint-dev/Login/fbCallBack/',$permissions);
			$data['fbLoginUrl'] = $loginUrl;
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
		}else{
			$this->session->unset_userdata('loginSession');
			redirect('Login');
		}
	}

	public function registerUser($user,$registrationType){
		if($registrationType=='facebookRegister'){
			$dataUser = array(
				'name'=>$user['name'],
				'email'=>$user['email'],
	      'password'=>md5($user['id']),
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
		$user = $response->getGraphUser();
		return $user;
	}

	public function fbCallBack(){
		try {
		  $accessToken = $this->helper->getAccessToken();
		} catch(Facebook\Exceptions\FacebookResponseException $e) {
		  echo 'Graph returned an error: ' . $e->getMessage();
		  exit;
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
		  echo 'Facebook SDK returned an error: ' . $e->getMessage();
		  exit;
		}

		if (isset($accessToken)) {
			$user = $this->fbGetUser($accessToken);
			if(!$this->checkAlreadyRegisteredUser('email',$user['email'],'generalRequest')){
				$this->registerUser($user,'facebookRegister');
			}
			$fbLogoutUrl = $this->helper->getLogoutUrl($accessToken, 'http://localhost/hint-dev/');
			$session_data = array(
				'accessToken' => (string) $accessToken,
				'id'=>$user['id'],
				'name'=>$user['name'],
				'email'=>$user['email'],
				'loginTime' => date('Y-m-d h:i:s', time())
      );
			$this->setSessionData('facebook',$session_data);
			redirect('Login');
		}
	}

}

?>
