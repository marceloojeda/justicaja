<?php

class ContestacaoModel extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	function Insert_Contestacao($data){
		$this->db->insert("Contestacao", $data);
		return $this->db->insert_id();
	}

	function Insert_ContestacaoDoc($data){
		$this->db->insert("ContestacaoDocs", $data);
		return $this->db->insert_id();
	}

	function atualizar($texto, $id){
		$this->db->set('Texto', $texto);
		$this->db->where('Id', $id);
		$this->db->update('Contestacao');
	}

	function GetByPedido($id){
		$this->db->select('c.*, cd.TipoDocumento, cd.Arquivo, cd.Observacao');
		$this->db->from('Contestacao c');
		$this->db->join('ContestacaoDocs cd', 'c.Id = cd.ContestacaoId', 'left');
		$this->db->where('c.PedidoId',$id);
		$query = $this->db->get();

		if($query->num_rows() > 0)
			return $query->result_array();
		else
			return null;
	}

	function getDocumentos($idContestacao){
		$this->db->where('ContestacaoId', $idContestacao);
		return $this->db->get('ContestacaoDocs')->result();
	}


	function getContestacoesPendentes($reuId){
		$this->db->select("pa.Id as PedidoId, pa.Data, autor.Nome as Autor, reu.Nome as Reu, paa.Status, Left(pa.Razoes, 200) as Razoes");

		$this->db->from('PedidoAbertura pa');

		$this->db->join("PedidoAberturaAnalise paa", "pa.Id = paa.PedidoId");
		
		$this->db->join("Pessoa autor", "pa.PessoaId = autor.Id");
        $this->db->join("Pessoa reu", "pa.ReuId = reu.Id");

		$this->db->join('Contestacao c', 'c.PedidoId = pa.Id', 'left');
		$this->db->where('pa.ReuId', $reuId);
		$this->db->where('c.Id', null);

		return $this->db->get()->result();
	}

	function getDocsByContestacaoId($id){
		$this->db->where('ContestacaoId', $id);
		return $this->db->get('ContestacaoDocs')->result_array();
	}
}