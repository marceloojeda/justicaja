<?php

class ArbitroModel extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	function getById($idArbitro){
		$this->db->where('Id', $idArbitro);
		return $this->db->get('Arbitro')->row();
	}

	function cadastrar($dados){
		$this->db->insert('Arbitro', $dados);
		return $this->db->insert_id();
	}
}