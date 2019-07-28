<?php

class TreplicaModel extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	function Insert_Treplica($data){
		$this->db->insert("Treplica", $data);
		return $this->db->insert_id();
	}

	function Insert_TreplicaDoc($data){
		$this->db->insert("TreplicaDocs", $data);
		return $this->db->insert_id();
	}

	function atualizar($texto, $id){
		$this->db->set('Texto', $texto);
		$this->db->where('Id', $id);
		$this->db->update('Treplica');
	}

	function GetByPedido($id){
		$this->db->select('c.*, cd.TipoDocumento, cd.Arquivo, cd.Observacao');
		$this->db->from('Treplica c');
		$this->db->join('TreplicaDocs cd', 'c.Id = cd.TreplicaId', 'left');
		$this->db->where('c.PedidoId',$id);
		
		return $this->db->get()->result_array();
	}

	function getTreplicasPendentes($reuId){
		$this->db->select("pa.Id as PedidoId, pa.Data, autor.Nome as Autor, reu.Nome as Reu, paa.Status, Left(pa.Razoes, 200) as Razoes");

		$this->db->from('PedidoAbertura pa');

		$this->db->join("PedidoAberturaAnalise paa", "pa.Id = paa.PedidoId");
		
		$this->db->join("Pessoa autor", "pa.PessoaId = autor.Id");
        $this->db->join("Pessoa reu", "pa.ReuId = reu.Id");

        $this->db->join('Replica r', 'r.PedidoId = pa.Id');

		$this->db->join('Treplica c', 'c.PedidoId = pa.Id', 'left');
		$this->db->where('pa.ReuId', $reuId);
		$this->db->where('c.Id', null);

		return $this->db->get()->result();
	}
}