<?php

class Migration_Add_Logs extends CI_Migration {

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
      'method' => array(
        'type' => 'VARCHAR',
        'constraint' => '6'
      ),
      'params' => array(
        'type' => 'TEXT',
        'null' => TRUE,
      ),
      'api_key' => array(
        'type' => 'VARCHAR',
        'constraint' => '40'
      ),
      'ip_address' => array(
        'type' => 'VARCHAR',
        'constraint' => '45'
      ),
      'time' => array(
        'type' => 'INT',
        'constraint' => 11
      ),
      'rtime' => array(
        'type' => 'FLOAT',
        'null' => TRUE
      ),
      'authorized' => array(
        'type' => 'VARCHAR',
        'constraint' => '1'
      ),
      'response_code' => array(
        'type' => 'SMALLINT',
        'constraint' => 3,
        'default' => 0
      )
    ));
    $this->dbforge->add_key('id', TRUE);
    $this->dbforge->create_table('logs');

    echo 'Up migration 002';
  }

  public function down() {
    $this->dbforge->drop_table('logs');

    echo 'Down migration 002';
  }
}
