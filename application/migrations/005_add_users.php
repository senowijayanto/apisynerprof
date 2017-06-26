<?php

class Migration_Add_Users extends CI_Migration {

  public function up() {
    $this->dbforge->add_field(array(
      'id' => array(
        'type' => 'INT',
        'constraint' => 11,
        'unsigned' => TRUE,
        'auto_increment' => TRUE
      ),
      'sponsor_id' => array(
        'type' => 'INT',
        'constraint' => 11
      ),
      'member_id' => array(
        'type' => 'VARCHAR',
        'constraint' => '20'
      ),
      'name' => array(
        'type' => 'VARCHAR',
        'constraint' => '255'
      ),
      'email' => array(
        'type' => 'VARCHAR',
        'constraint' => '255'
      ),
      'phone' => array(
        'type' => 'VARCHAR',
        'constraint' => '100'
      ),
      'password' => array(
        'type' => 'VARCHAR',
        'constraint' => '255'
      ),
      'status' => array(
        'type' => 'TINYINT',
        'constraint' => 1,
        'default' => 0
      ),
      'created_at' => array(
        'type' => 'DATETIME',
        'null' => TRUE,
        'default' => NULL
      )
    ));
    $this->dbforge->add_key('id', TRUE);
    $this->dbforge->create_table('users');

    echo 'Up migration 005';
  }

  public function down() {
    $this->dbforge->drop_table('users');

    echo 'Down migration 005';
  }
}
