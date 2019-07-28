<?php

class Migration_pessoa extends CI_Migration {

public function up() {

	if (!$this->db->table_exists('pessoa'))
	{
	 
		// Criando o campo.
		$this->load->dbforge(); // DB Forge, para manipular o banco

		$this->dbforge->create_table('pessoa');

		$fields = array(
	        'id' => array(
	            'type' => 'INT',
	            'constraint' => 5,
	            'unsigned' => TRUE,
	            'auto_increment' => TRUE
	        ),
	        'nome' => array(
	            'type' => 'VARCHAR',
	            'constraint' => 200,
	            'null' => FALSE
	        ),
	        'tipo' => array(
	    		'type' => 'INT',
	    		'constraint' => 1,
	    		'null' => FALSE
			),
	        'cpf_cnpj' => array(
	            'type' =>'VARCHAR',
	            'constraint' => 20,
	            'null' => FALSE
	        ),
	        'documento_tipo' => array(
	            'type' => 'varchar',
	            'constraint' => 50
	            'null' => TRUE
	        ),
	        'documento' => array(
	            'type' => 'varchar',
	            'constraint' => 50
	            'null' => TRUE
	        )
		);

		$this->dbforge->add_column('pessoa', $fields);
	}
}