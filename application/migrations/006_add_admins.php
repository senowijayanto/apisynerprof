<?php

class Migration_Add_Admins extends CI_Migration {

  public function up() {
    $this->dbforge->add_field(array(
      'id' => array(
        'type' => 'INT',
        'constraint' => 11,
        'unsigned' => TRUE,
        'auto_increment' => TRUE
      ),
      'full_name' => array(
        'type' => 'VARCHAR',
        'constraint' => '150'
      ),
      'username' => array(
        'type' => 'VARCHAR',
        'constraint' => '150'
      ),
      'password' => array(
        'type' => 'VARCHAR',
        'constraint' => '255'
      ),
      'created_at' => array(
        'type' => 'DATETIME',
        'null' => TRUE,
        'default' => NULL
      ),
      'last_login_at' => array(
        'type' => 'DATETIME',
        'null' => TRUE,
        'default' => NULL
      ),
      'last_login_ip' => array(
        'type' => 'VARCHAR',
        'constraint' => '60'
      )
    ));
    $this->dbforge->add_key('id', TRUE);
    $this->dbforge->create_table('admins');

    echo 'Up migration 006';
  }

  public function down() {
    $this->dbforge->drop_table('admins');

    echo 'Down migration 006';
  }
}
