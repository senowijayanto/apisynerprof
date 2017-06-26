<?php

class Migration_Add_Products extends CI_Migration {

  public function up() {
    $this->dbforge->add_field(array(
      'id' => array(
        'type' => 'INT',
        'constraint' => 11,
        'unsigned' => TRUE,
        'auto_increment' => TRUE
      ),
      'category' => array(
        'type' => 'TINYINT',
        'constraint' => 1,
        'default' => 1
      ),
      'name' => array(
        'type' => 'VARCHAR',
        'constraint' => '255'
      ),
      'description' => array(
        'type' => 'TEXT'
      ),
      'benefits' => array(
        'type' => 'TEXT'
      ),
      'recomended' => array(
        'type' => 'TEXT'
      ),
      'ingredients' => array(
        'type' => 'TEXT'
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
    $this->dbforge->create_table('products');

    echo 'Up migration 007';
  }

  public function down() {
    $this->dbforge->drop_table('products');

    echo 'Down migration 007';
  }
}
