<?php

class ReplicaModel extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	function Insert_Replica($data){
		$this->db->insert("Replica", $data);
		return $this->db->insert_id();
	}

	function Insert_ReplicaDoc($data){
		$this->db->insert("ReplicaDocs", $data);
		return $this->db->insert_id();
	}

	function atualizar($texto, $id){
		$this->db->set('Texto', $texto);
		$this->db->where('Id', $id);
		$this->db->update('Replica');
	}

	function GetByPedido($id){
		$this->db->select('c.*, cd.TipoDocumento, cd.Arquivo, cd.Observacao');
		$this->db->from('Replica c');
		$this->db->join('ReplicaDocs cd', 'c.Id = cd.ReplicaId', 'left');
		$this->db->where('c.PedidoId',$id);
		$query = $this->db->get();

		if($query->num_rows() > 0)
			return $query->result_array();
		else
			return null;
	}

	function getDocsByPedido($idPedido){
		$this->db->where('Replica.PedidoId', $idPedido);
		$this->db->join('Replica', 'ReplicaDocs.ReplicaId = Replica.Id');
		return $this->db->get('ReplicaDocs')->result_array();
	}

	function getReplicasPendentes($autorId){
		$this->db->select("pa.Id as PedidoId, pa.Data, autor.Nome as Autor, reu.Nome as Reu, paa.Status, Left(pa.Razoes, 200) as Razoes");

		$this->db->from('PedidoAbertura pa');

		$this->db->join("PedidoAberturaAnalise paa", "pa.Id = paa.PedidoId");
		
		$this->db->join("Pessoa autor", "pa.PessoaId = autor.Id");
        $this->db->join("Pessoa reu", "pa.ReuId = reu.Id");

        $this->db->join('Contestacao c', 'c.PedidoId = pa.Id');

		$this->db->join('Replica r', 'r.PedidoId = pa.Id', 'left');
		$this->db->where('r.Id', null);
		$this->db->where("pa.PessoaId = {$autorId} OR pa.PromotorId = {$autorId}");

		$t = $this->db->get()->result();
		return $t;
	}
}