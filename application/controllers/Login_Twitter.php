<?php
require_once ('/vendor/autoload.php');
use Abraham\TwitterOAuth\TwitterOAuth;

define('CONSUMER_KEY','WuHJtUO0LrdzIew5wOoFQnWgG');
define('CONSUMER_SECRET','7UIasN2pSAFO8gnTxcNkNGFnq4O9LEEK5Y7Gn3bIeNADC4QgL7');
define('OAUTH_CALLBACK','http://127.0.0.1:80/hint-dev/Login_Twitter/twitterCallback');

class Login_Twitter extends CI_Controller{
  public function __construct() {
    parent::__construct();
  }
  public function index(){

  }
  public function twitterCallback(){
    $request_token = [];
    $request_token['oauth_token'] = $this->session->userdata('twitterToken')['oauth_token'];
    $request_token['oauth_token_secret'] = $this->session->userdata('twitterToken')['oauth_token'];

    if (isset($_REQUEST['oauth_token']) && $request_token['oauth_token'] !== $_REQUEST['oauth_token']) {
        redirect('Login');
    }else{
      $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $request_token['oauth_token'], $request_token['oauth_token_secret']);
      $access_token = $connection->oauth("oauth/access_token", ["oauth_verifier" => $_REQUEST['oauth_verifier']]);
      $twSessionData = array(
				'oauth_token'=>$request_token['oauth_token'],
				'oauth_token_secret'=>$request_token['oauth_token_secret'],
        'access_token'=>$access_token
			);
			$this->session->set_userdata('twitterToken',$twSessionData);
      $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
      $user = $connection->get("account/verify_credentials");
      $twUserSessionData = array(
				'id'=>$user->id_str,
				'name'=>$user->name,
        'profile_picture'=>$user->profile_image_url_https,
        'loginTime' => date('Y-m-d h:i:s', time())
			);
      $this->session->set_userdata('twitter',$twUserSessionData);
      redirect('Login');
    }
  }
}

?>
