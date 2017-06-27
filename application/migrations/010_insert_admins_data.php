<?php

class Migration_Insert_admins_data extends CI_Migration {

  public function up() {
    $sql_check    = "SELECT * FROM `admins`";
    $query_check  = $this->db->query( $sql_check );

    if ( $query_check->num_rows() > 0 ) {
      return false;
    }

    $created_at = date("Y-m-d H:i:s");

    $sql    = "INSERT INTO `admins` (`full_name`, `username`, `password`, `created_at`) VALUES ( 'Administrator', 'admin', '9a4ee9c4779b0d4ca5c444bc4f4dcb830a9c902f', '$created_at')";
    $query  = $this->db->query( $sql );

    if ( $query ) {
      echo 'Up migration 10';
    } else {
      echo 'Failed Up migration 10';
    }

  }

  public function down() {
    $sql    = "DELETE FROM `admins` WHERE username = 'admin'";
    $query  = $this->db->query( $sql );

    if ( $query ) {
      echo 'Down migration 10';
    } else {
      echo 'Failed migration 10';
    }
  }
}
