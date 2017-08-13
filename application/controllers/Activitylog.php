<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Activitylog extends REST_Controller {

  function __construct() {
    parent::__construct();
  }

  public function index_get() {
    $user_id    = $this->get('user_id');
    $monthyear  = $this->get('monthyear');
    $month      = substr($monthyear, 5, 2);
    $year       = substr($monthyear, 0, 4);

    if (empty($user_id) && empty($monthyear)) {
      $this->set_response([
        'status'  => FALSE,
        'message' => 'User ID dan Bulan Tahun tidak boleh kosong.'
      ], REST_Controller::HTTP_BAD_REQUEST);
    }

    $this->db->where('user_id', $user_id);
    $this->db->where('MONTH(date_activity)', $month);
    $this->db->where('YEAR(date_activity)', $year);
    $activities = $this->db->get('activities')->result();

    if (!$activities) {
      $this->response([
        'status'  => FALSE,
        'message' => 'Data tidak ditemukan.'
      ], REST_Controller::HTTP_NOT_FOUND);
    }

    $this->response($activities, REST_Controller::HTTP_OK);
  }

  public function index_put() {

  }

  public function index_delete() {

  }
}
