<?php
class Migration_Alter_products_1 extends CI_Migration {

	public function up(){
		$fields = array(
			'updated_at' => array(
        'type' => 'DATETIME',
        'null' => TRUE,
        'default' => NULL
			)
		);
		$this->dbforge->add_column( 'products', $fields );

		echo 'Up migration 011';
	}

	public function down(){
		//Program
		$this->dbforge->drop_column( 'products', 'updated_at' );

		echo 'Down migration 011';
	}
}
