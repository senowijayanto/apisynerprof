<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

  public function __construct() {
    parent::__construct();
  }

  public function index() {
    if ($this->input->post()) {
      $this->load->model('admins_model');
      $username = $this->input->post('username');
      $password = sha1($this->input->post('password'));
      echo $password;
      exit;
      // Check username and password
      $check = $this->admins_model->get(NULL, array('username' => $username, 'password' => $password));

    }
    $this->load->view('admin/login');
  }

}
