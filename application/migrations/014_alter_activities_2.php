<?php
class Migration_Alter_activities_2 extends CI_Migration {

	public function up(){
		$fields = array(
			'date_activity' => array(
        'type' => 'VARCHAR',
				'constraint' => '10',
				'after' => 'activity'
			)
		);
		$this->dbforge->add_column( 'activities', $fields );

		echo 'Up migration 014';
	}

	public function down(){
		//Program
		$this->dbforge->drop_column( 'activities', 'date_activity' );

		echo 'Down migration 014';
	}
}
