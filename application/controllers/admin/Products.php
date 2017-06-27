<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {

  public function __construct() {
    parent::__construct();
  }

  public function index() {
    $data['content']  = 'admin/products';
    $data['title']    = 'Products Data';
    $this->load->view('admin/template', $data);
  }
}
