<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Programs extends CI_Controller {

  public function __construct() {
    parent::__construct();
  }

  public function index() {
    $data['content']  = 'admin/programs';
    $data['title']    = 'Programs Data';
    $this->load->view('admin/template', $data);
  }
}
