<?php

class Migration_Add_Access extends CI_Migration {

  public function up() {
    $this->dbforge->add_field(array(
      'id' => array(
        'type' => 'INT',
        'constraint' => 11,
        'unsigned' => TRUE,
        'auto_increment' => TRUE
      ),
      'key' => array(
        'type' => 'VARCHAR',
        'constraint' => '40',
        'default' => ''
      ),
      'all_access' => array(
        'type' => 'TINYINT',
        'constraint' => 1,
        'default' => 0
      ),
      'controller' => array(
        'type' => 'VARCHAR',
        'constraint' => '50',
        'default' => ''
      ),
      'date_created' => array(
        'type' => 'DATETIME',
        'null' => TRUE,
        'default' => NULL
      ),
      'date_modified' => array(
        'type' => 'TIMESTAMP'
      )
    ));
    $this->dbforge->add_key('id', TRUE);
    $this->dbforge->create_table('access');

    echo 'Up migration 003';
  }

  public function down() {
    $this->dbforge->drop_table('access');

    echo 'Down migration 003';
  }
}
