<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model(['user']);
		$this->load->helper('string');
    }
    
    public function index(){
        $username = $this->input->post("username");
        $password = $this->input->post("password");
        if ($userData = $this->user->getUser($username, $password)){
            $this->session->set_userdata("username", $username);
            $this->session->set_userdata("logged", TRUE);
            echo json_encode([
                "status" => TRUE
            ]);
        } else {
            echo json_encode([
                "username" => $username, 
                "password" => $password,
                "status" => FALSE
            ]);
        }
    }

    public function register(){
        $username = $this->input->post("username");
        $password = $this->input->post("password");
        if ($this->user->pushUser($username, $password)){
            echo json_encode([
                "status" => TRUE
            ]);
        } else {
            echo json_encode([
                "status" => FALSE
            ]);
        }
    }

    public function logout(){
        $this->session->sess_destroy();
    }
}