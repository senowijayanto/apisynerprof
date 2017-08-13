<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Activities extends REST_Controller {

  function __construct() {
    parent::__construct();
  }

  public function index_get() {

    $activities = $this->db->get('activities')->result();

    $id = $this->get('id');
    // If the id parameter doesn't exist return all the activities

    if ($id === NULL)
    {
        // Check if the users data store contains activities (in case the database result returns NULL)
        if ($activities)
        {
            // Set the response and exit
            $this->response($activities, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        }
        else
        {
            // Set the response and exit
            $this->response([
                'status' => FALSE,
                'message' => 'No activities were found'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    // Find and return a single record for a particular user.

    $id = (int) $id;

    // Validate the id.
    if ($id <= 0)
    {
        // Invalid id, set the response and exit.
        $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
    }

    $activity = NULL;

    if (!empty($activities))
    {
      $this->db->where('id', $id);
      $activity = $this->db->get('activities')->result();
    }

    if (!empty($activity))
    {
        $this->set_response($activity, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
    }
    else
    {
        $this->set_response([
            'status' => FALSE,
            'message' => 'Activity could not be found'
        ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
    }
  }

  public function index_post() {
    $data = array(
      'user_id'       => $this->post('user_id'),
      'activity'      => $this->post('activity'),
      'date_activity' => $this->post('date_activity'),
      'created_at'    => date('Y-m-d H:i:s')
    );

    $insert = $this->db->insert('activities', $data);
    if ($insert) {
      $this->response([
        'data'    => $data,
        'status'  => TRUE,
        'message' => 'Insert Success'
      ], REST_Controller::HTTP_OK);
    } else {
      $this->response(array('status' => FALSE, 502));
    }
  }

  public function index_put() {
    $id = (int) $this->put('id');
    $data = array(
      'activity'      => $this->put('activity'),
      'date_activity' => $this->put('date_activity'),
      'updated_at'    => date('Y-m-d H:i:s')
    );

    $this->db->where('id', $id);
    $update = $this->db->update('activities', $data);
    if ($update) {
      $this->response([
        'status'  => TRUE,
        'message' => 'Update Success'
      ], REST_Controller::HTTP_OK);
    } else {
      $this->response(array('status' => FALSE, 502));
    }
  }

  public function index_delete($id) {
    $id = (int) $id;
    $delete = $this->db->delete('activities', array('id' => $id));
    if ($delete) {
      $this->response([
        'status'  => TRUE,
        'message' => 'Delete Success'
      ], REST_Controller::HTTP_OK);
    } else {
      $this->response(array('status' => FALSE, 502));
    }
  }
}
