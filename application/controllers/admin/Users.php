<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

  public function __construct() {
    parent::__construct();
  }

  public function index() {
    $this->load->model('users_model');
    $data['users_model']  = $this->users_model;
    $data['users']        = $this->users_model->get();
    $data['content']      = 'admin/users';
    $data['title']        = 'Users Data';
    $this->load->view('admin/template', $data);
  }
}
