<?php

class Migration_Add_Programs extends CI_Migration {

  public function up() {
    $this->dbforge->add_field(array(
      'id' => array(
        'type' => 'INT',
        'constraint' => 11,
        'unsigned' => TRUE,
        'auto_increment' => TRUE
      ),
      'name' => array(
        'type' => 'VARCHAR',
        'constraint' => '255'
      ),
      'description' => array(
        'type' => 'TEXT'
      ),
      'items' => array(
        'type' => 'TEXT'
      ),
      'price' => array(
        'type' => 'DOUBLE'
      ),
      'image' => array(
        'type' => 'VARCHAR',
        'constraint' => '255'
      ),
      'created_at' => array(
        'type' => 'DATETIME',
        'null' => TRUE,
        'default' => NULL
      )
    ));
    $this->dbforge->add_key('id', TRUE);
    $this->dbforge->create_table('programs');

    echo 'Up migration 008';
  }

  public function down() {
    $this->dbforge->drop_table('programs');

    echo 'Down migration 008';
  }
}
