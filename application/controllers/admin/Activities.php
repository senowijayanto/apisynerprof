<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Activities extends CI_Controller {

  public function __construct() {
    parent::__construct();
  }

  public function index() {
    $data['content']  = 'admin/activities';
    $data['title']    = 'Activities Data';
    $this->load->view('admin/template', $data);
  }
}
