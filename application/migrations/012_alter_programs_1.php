<?php
class Migration_Alter_programs_1 extends CI_Migration {

	public function up(){
		$fields = array(
			'updated_at' => array(
        'type' => 'DATETIME',
        'null' => TRUE,
        'default' => NULL
			),
			'deleted' => array(
				'type' => 'TINYINT',
        'constraint' => 1,
        'default' => 0
			),
			'thumbnail' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
				'after' => 'image'
			)
		);
		$this->dbforge->add_column( 'programs', $fields );

		echo 'Up migration 012';
	}

	public function down(){
		//Program
		$this->dbforge->drop_column( 'products', 'updated_at' );
		$this->dbforge->drop_column( 'products', 'deleted' );
		$this->dbforge->drop_column( 'products', 'thumbnail' );

		echo 'Down migration 012';
	}
}
