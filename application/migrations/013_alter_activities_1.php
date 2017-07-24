<?php
class Migration_Alter_activities_1 extends CI_Migration {

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
			)
		);
		$this->dbforge->add_column( 'activities', $fields );

		echo 'Up migration 013';
	}

	public function down(){
		//Program
		$this->dbforge->drop_column( 'activities', 'updated_at' );
		$this->dbforge->drop_column( 'activities', 'deleted' );

		echo 'Down migration 013';
	}
}
