<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admins_model extends MY_Model {

  public function __construct() {
    parent::__construct();
    $this->table_name = 'admins';
  }
}