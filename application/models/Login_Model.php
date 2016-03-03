<?php

class Login_Model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function doLogin($data,$requestType){

      $query = $this->db->get_where('tb_user', array('email' => $data['email'],'password'=>$data['password']),1);

      if ($query->num_rows() == 1) {
        if($requestType!='userData'){
          return true;
        }else{
          return $query->result();
        }
      } else {
          return false;
      }
    }

    function registerUser($data){
      $this->db->set($data);
      $this->db->insert($this->db->dbprefix . 'tb_user');
      if ($this->db->affected_rows() > 0) {
          return true;
      } else {
          return false;
      }
    }

    function checkAlreadyRegisteredUser($key,$value){
      $this->db->get_where('tb_user', array($key => $value));
      if ($this->db->affected_rows() > 0) {
          return true;
      } else {
          return false;
      }
    }

  }
?>
