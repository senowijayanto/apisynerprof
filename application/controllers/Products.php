<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Products extends REST_Controller {

  function __construct() {
    parent::__construct();
  }

  public function index_get() {

    $products = $this->db->get('products')->result();

    $id = $this->get('id');
    // If the id parameter doesn't exist return all the products

    if ($id === NULL)
    {
        // Check if the users data store contains users (in case the database result returns NULL)
        if ($products)
        {
            // Set the response and exit
            $this->response($products, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        }
        else
        {
            // Set the response and exit
            $this->response([
                'status' => FALSE,
                'message' => 'No users were found'
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

    $product = NULL;

    if (!empty($products))
    {
      $this->db->where('id', $id);
      $product = $this->db->get('products')->result();
    }

    if (!empty($product))
    {
        $this->set_response($product, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
    }
    else
    {
        $this->set_response([
            'status' => FALSE,
            'message' => 'User could not be found'
        ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
    }
  }

  public function index_post() {
    $data = array(
      'member_id' => $this->post('member_id'),
      'name'      => $this->post('name'),
      'email'     => $this->post('email'),
      'phone'     => $this->post('phone'),
      'password'  => sha1($this->post('password'))
    );

    // Check existing member ID
    $this->db->where('member_id', trim($this->post('member_id')));
    $check_ID = $this->db->get('users')->result();

    if ($check_ID) {
      $this->set_response([
        'status'  => FALSE,
        'message' => 'Member ID '.$this->post('member_id').' sudah ada.'
      ], REST_Controller::HTTP_BAD_REQUEST);
    } else {
      $insert = $this->db->insert('users', $data);
      if ($insert) {
        $this->response([
          'data'    => $data,
          'status'  => TRUE,
          'message' => 'Insert Success'
        ], REST_Controller::HTTP_OK);
      } else {
        $this->response(array('status' => 'fail', 502));
      }
    }
  }

  public function index_put() {
    $member_id = $this->put('member_id');
    $data = array(
      // 'name'      => $this->put('name'),
      // 'email'     => $this->put('email'),
      // 'password'  => sha1($this->put('password')),
      'status'    => $this->put('status')
    );

    // Check existing email
    $this->db->where('member_id', trim($member_id));
    $check_ID = $this->db->get('users')->result();

    if (!$check_ID) {
      $this->set_response([
        'status'  => FALSE,
        'message' => 'Member ID is not exist'
      ], REST_Controller::HTTP_BAD_REQUEST);
    } else {
      $this->db->where('member_id', trim($member_id));
      $update = $this->db->update('users', $data);
      if ($update) {
        $this->response([
          'status'  => TRUE,
          'message' => 'Update Success'
        ], REST_Controller::HTTP_OK);
      } else {
        $this->response(array('status' => 'fail', 502));
      }
    }
  }

  public function index_delete() {
    $member_id = $this->delete('member_id');
    $this->response(array('status' => $member_id, 201));
  }
}
