<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Synerprof_migrate extends CI_Controller {

  public function __construct() {
    parent::__construct();
  }

  public function migrate(){
    $this->load->library('migration');
    if ( ! $this->migration->current()){
      show_error($this->migration->error_string());
    }else{
      show_error("Current version");
    }
  }

  public function latest(){
    $this->load->library('migration');
    $this->migration->latest();
  }

  public function version( $version ){
    $this->load->library('migration');
    $this->migration->version($version);
  }
  public function show_version(){
    $this->load->database();
    $sql = "SELECT * FROM migrations";
    $query = $this->db->query($sql);
    $result = $query->row();
    echo "Current Version Migration : ".$result->version;
  }
}
