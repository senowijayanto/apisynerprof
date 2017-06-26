<?php

class Migration_Add_Limits extends CI_Migration {

  public function up() {
    $this->dbforge->add_field(array(
      'id' => array(
        'type' => 'INT',
        'constraint' => 11,
        'unsigned' => TRUE,
        'auto_increment' => TRUE
      ),
      'uri' => array(
        'type' => 'VARCHAR',
        'constraint' => '255'
      ),
      'count' => array(
        'type' => 'INT',
        'constraint' => 10
      ),
      'hour_started' => array(
        'type' => 'INT',
        'constraint' => 11
      ),
      'api_key' => array(
        'type' => 'VARCHAR',
        'constraint' => '40'
      )
    ));
    $this->dbforge->add_key('id', TRUE);
    $this->dbforge->create_table('limits');

    echo 'Up migration 004';
  }

  public function down() {
    $this->dbforge->drop_table('limits');

    echo 'Down migration 004';
  }
}
