<?php

class Migration_Add_Activities extends CI_Migration {

  public function up() {
    $this->dbforge->add_field(array(
      'id' => array(
        'type' => 'INT',
        'constraint' => 11,
        'unsigned' => TRUE,
        'auto_increment' => TRUE
      ),
      'user_id' => array(
        'type' => 'INT',
        'constraint' => 11
      ),
      'activity' => array(
        'type' => 'TEXT'
      ),
      'created_at' => array(
        'type' => 'DATETIME',
        'null' => TRUE,
        'default' => NULL
      )
    ));
    $this->dbforge->add_key('id', TRUE);
    $this->dbforge->create_table('activities');

    echo 'Up migration 009';
  }

  public function down() {
    $this->dbforge->drop_table('activities');

    echo 'Down migration 009';
  }
}
