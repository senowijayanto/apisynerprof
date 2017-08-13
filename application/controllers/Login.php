<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Login extends REST_Controller {

  function __construct() {
    parent::__construct();
  }

  public function index_get() {
    $member_id  = $this->get('member_id');
    $password   = $this->get('password');

    if (empty($member_id) && empty($password)) {
      $this->set_response([
        'status'  => FALSE,
        'message' => 'Member ID dan Password tidak boleh kosong.'
      ], REST_Controller::HTTP_BAD_REQUEST);
    }

    $this->db->where('member_id', $member_id);
    $this->db->where('password', sha1($password));
    $user = $this->db->get('users')->result();

    if (!$user) {
      $this->response([
        'status'  => FALSE,
        'message' => 'Member ID dan Password Salah.'
      ], REST_Controller::HTTP_BAD_REQUEST);
    }

    $data = [];
    foreach ($user as $value) {
      $data['id']         = $value->id;
      $data['member_id']  = $value->member_id;
      $data['name']       = $value->name;
      $data['email']      = $value->email;
      $data['phone']      = $value->phone;
      $data['status']     = $value->status;
    }

    $this->response([
      'data'    => $data,
      'status'  => TRUE,
      'message' => 'Login Sukses'
    ], REST_Controller::HTTP_OK);
  }
}
