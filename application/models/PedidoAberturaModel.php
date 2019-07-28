<?php

class PedidoAberturaModel extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	function Insert_PedidoAbertura($data){
		$this->db->insert("PedidoAbertura", $data);
		return $this->db->insert_id();
	}

	function Insert_PedidoDoc($data){
		$this->db->insert("PedidoAberturaDocs", $data);
		return $this->db->insert_id();
	}

	function Insert_PedidoProva($data){
		$this->db->insert("PedidoAberturaProvas", $data);
		return $this->db->insert_id();
	}


    function Insert_PedidoAnalise($data){
        $this->db->insert("PedidoAberturaAnalise", $data);
        return $this->db->insert_id();
    }


    function Insert_PedidoNotificacao($data){
        $this->db->insert("PedidoAberturaNotificacao", $data);
        return $this->db->insert_id();
    }


    function SaveCodigoAceite($data){
        $this->db->where('Id', $data['Id']);
        $this->db->update('PedidoAbertura', $data);
    }

    function Update_Analise($data){
        $this->db->where('Id', $data['Id']);
        $this->db->update('PedidoAberturaAnalise', $data);
    }


    function GetAll(){
        $this->db->select("pa.Id, pa.Data,p.Nome as Autor, t.Codigo, paa.Status");
        $this->db->from('PedidoAbertura pa');
        $this->db->join('TabelaPreco t', 'pa.TabelaPrecoId = t.Id', 'left');
        $this->db->join("Pessoa p", "pa.PessoaId = p.Id");
        $this->db->join("PedidoAberturaAnalise paa", "pa.Id = paa.PedidoId", "left");
        $this->db->where("paa.Id", null);
        $query = $this->db->get();

        if($query->num_rows() > 0)
            return $query->result_array();
        else
            return null;
    }

    function getByReuId($id, $soAceitos = false){
        $this->db->select("pa.Id, pa.PessoaId as AutorId, pa.ReuId, pa.PromotorId, pa.Data,autor.Nome as Autor, reu.Nome as Reu, paa.Status, Left(pa.Razoes, 200) as Razoes");
        $this->db->from('PedidoAbertura pa');
        $this->db->join("PedidoAberturaAnalise paa", "pa.Id = paa.PedidoId", "left");
        $this->db->join("Pessoa autor", "pa.PessoaId = autor.Id");
        $this->db->join("Pessoa reu", "pa.ReuId = reu.Id");
        $this->db->where("pa.ReuId", $id);
        if($soAceitos){
            $this->db->where("pa.Aceito", 1);
        }
        $this->db->order_by("pa.Data", 'desc');

        $query = $this->db->get();

        if($query->num_rows() > 0)
            return $query->result_array();
        else
            return null;
    }

    function getByAutorId($id, $soAceitos = false){
        $this->db->select("pa.Id, pa.PessoaId as AutorId, pa.ReuId, pa.PromotorId, pa.Data,autor.Nome as Autor, reu.Nome as Reu, paa.Status, Left(pa.Razoes, 200) as Razoes");
        $this->db->from('PedidoAbertura pa');
        $this->db->join("PedidoAberturaAnalise paa", "pa.Id = paa.PedidoId", "left");
        $this->db->join("Pessoa autor", "pa.PessoaId = autor.Id");
        $this->db->join("Pessoa reu", "pa.ReuId = reu.Id");
        $this->db->where("pa.PessoaId", $id);
        if($soAceitos){
            $this->db->where("pa.Aceito", 1);
        }
        $this->db->order_by("pa.Data", 'desc');

        $query = $this->db->get();

        if($query->num_rows() > 0)
            return $query->result_array();
        else
            return null;
    }

    function getByPromotorId($id, $soAceitos = false){
        $this->db->select("pa.Id, pa.PessoaId as AutorId, pa.ReuId, pa.PromotorId, pa.Data,autor.Nome as Autor, reu.Nome as Reu, promotor.Nome as Promotor, paa.Status, Left(pa.Razoes, 200) as Razoes");
        $this->db->from('PedidoAbertura pa');
        $this->db->join("PedidoAberturaAnalise paa", "pa.Id = paa.PedidoId", "left");
        $this->db->join("Pessoa autor", "pa.PessoaId = autor.Id");
        $this->db->join("Pessoa reu", "pa.ReuId = reu.Id");
        $this->db->join("Pessoa promotor", "pa.PromotorId = promotor.Id");
        $this->db->where("pa.PromotorId", $id);
        if($soAceitos){
            $this->db->where("pa.Aceito", 1);
        }
        $this->db->order_by("pa.Data", 'desc');

        $query = $this->db->get();

        if($query->num_rows() > 0)
            return $query->result_array();
        else
            return null;
    }

    function GetByFiltro($filtro){
        $total_rows = $this->TotalRowsByFiltro($filtro);

        $this->db->select("pa.Id, pa.Data,autor.Nome as Autor, reu.Nome as Reu, paa.Status, paa.Id as AnaliseId, co.Id as ContestacaoId, re.Id as ReplicaId, tre.Id as TreplicaId,");
        $this->db->from('PedidoAbertura pa');
        $this->db->join("PedidoAberturaAnalise paa", "pa.Id = paa.PedidoId", "left");

        $this->db->join("Contestacao co", "pa.Id = co.PedidoId", "left");
        $this->db->join("Replica re", "pa.Id = re.PedidoId", "left");
        $this->db->join("Treplica tre", "pa.Id = tre.PedidoId", "left");

        $this->db->join("Pessoa autor", "pa.PessoaId = autor.Id");
        $this->db->join("Pessoa reu", "pa.ReuId = reu.Id");
        $this->db->where("pa.ReuId Is Not Null", null, false);
        if($filtro['Autor'] != null)
            $this->db->like("autor.Nome", $filtro['Autor']);
        if($filtro['Reu'] != null)
            $this->db->like("reu.Nome", $filtro['Reu']);
        if($filtro['Cidade'] != null){
            $this->db->like("autor.Cidade", $filtro['Cidade']);
            $this->db->or_like("reu.Cidade", $filtro['Cidade']);
        }
        if($filtro['UF'] != "All"){
            $this->db->where("autor.UF", $filtro['UF']);
            $this->db->or_where("reu.UF", $filtro['UF']);
        }
        if($filtro['Status'] == "0")
            $this->db->where("paa.Id", null);
        else if($filtro['Status'] != "All")
            $this->db->where("paa.Status", $filtro['Status']);

        if(isset($filtro['ManifestacaoReu']) && $filtro['ManifestacaoReu']){
            $this->db->where("paa.ManifestacaoReu Is Not Null", null, false);
        }

        $this->db->order_by('pa.Id', 'desc');
        $this->db->limit($filtro['PerPage'], $filtro['Page']);

        $query = $this->db->get();

        $dataRet = array(
            "numRows" => $total_rows,
            "results" => null
        );

        if($query->num_rows() > 0)
            $dataRet["results"] = $query->result_array();
        
        return $dataRet;
    }


    function TotalRowsByFiltro($filtro){
        $this->db->select("count(pa.Id) as total");
        $this->db->from('PedidoAbertura pa');
        $this->db->join("PedidoAberturaAnalise paa", "pa.Id = paa.PedidoId", "left");
        $this->db->join("Pessoa autor", "pa.PessoaId = autor.Id");
        $this->db->join("Pessoa reu", "pa.ReuId = reu.Id");
        $this->db->where("pa.ReuId Is Not Null", null, false);
        if($filtro['Autor'] != null)
            $this->db->like("autor.Nome", $filtro['Autor']);
        if($filtro['Reu'] != null)
            $this->db->like("reu.Nome", $filtro['Reu']);
        if($filtro['Cidade'] != null){
            $this->db->like("autor.Cidade", $filtro['Cidade']);
            $this->db->or_like("reu.Cidade", $filtro['Cidade']);
        }
        if($filtro['UF'] != "All"){
            $this->db->where("autor.UF", $filtro['UF']);
            $this->db->or_where("reu.UF", $filtro['UF']);
        }
        if($filtro['Status'] == "0")
            $this->db->where("paa.Id", null);
        else if($filtro['Status'] != "All")
            $this->db->where("paa.Status", $filtro['Status']);

         if(isset($filtro['ManifestacaoReu']) && $filtro['ManifestacaoReu']){
            $this->db->where("paa.ManifestacaoReu Is Not Null", null, false);
        }

        $query = $this->db->get();

        $row = $query->row_array();

        return $row['total'];
    }

	function GetAllTabelaPreco(){
    	$this->db->from('TabelaPreco');
        $query = $this->db->get();

        if($query->num_rows() > 0)
        	return $query->result_array();
        else
        	return null;
    }

    function GetProvasByPedido($id){
    	$this->db->from('PedidoAberturaProvas');
    	$this->db->where('PedidoId',$id);
        $query = $this->db->get();

        if($query->num_rows() > 0)
        	return $query->result_array();
        else
        	return null;
    }

    function GetDocsByPedido($id){
    	$this->db->from('PedidoAberturaDocs');
    	$this->db->where('PedidoId',$id);
        $query = $this->db->get();

        if($query->num_rows() > 0)
        	return $query->result_array();
        else
        	return null;
    }

    function DocumentExistByPedidoTipo($id, $tipo){
        $this->db->from('PedidoAberturaDocs');
        $this->db->where('PedidoId',$id);
        $this->db->where('TipoDocumento',$tipo);
        $query = $this->db->get();

        if($query->num_rows() > 0)
            return true;
        else
            return false;
    }

    function GetById($id){
        $this->db->select('p.*,t.Codigo,t.Descricao');
        $this->db->from('PedidoAbertura p');
        $this->db->join('TabelaPreco t', 'p.TabelaPrecoId = t.Id', "left");
        $this->db->where('p.Id', $id);
        $query = $this->db->get();

        if($query->num_rows() > 0)
            return $query->result_array();
        else
            return null;
    }

    function GetByCodigoAceite($hashTag){
        $this->db->select('p.*');
        $this->db->from('PedidoAbertura p');
        $this->db->where('p.CodigoAceite', $hashTag);
        $query = $this->db->get();

        if($query->num_rows() > 0)
            return $query->result_array();
        else
            return null;
    }


    function GetAnaliseByPedidoId($pedidoId){
        $this->db->from("PedidoAberturaAnalise paa");
        //$this->db->join("PedidoAbertura pa", "paa.PedidoId = pa.Id");
        $this->db->where("paa.PedidoId", $pedidoId);

        $query = $this->db->get();

        if($query->num_rows() > 0)
            return $query->result_array();
        else
            return null;
    }

    function getAnaliseById($id){
        $this->db->from("PedidoAberturaAnalise paa");
        $this->db->where("paa.Id", $id);

        $query = $this->db->get();

        if($query->num_rows() > 0)
            return $query->row();
        else
            return null;
    }

    function GetNotificacoesByPedido($id){
        $this->db->from('PedidoAberturaNotificacao');
        $this->db->where('PedidoId',$id);
        $query = $this->db->get();

        if($query->num_rows() > 0)
            return $query->result_array();
        else
            return null;
    }

    function atualizarReuPedido($idPedido, $idReu){
        $this->db->where('Id', $idPedido);
        $this->db->update('PedidoAbertura', array('ReuId' => $idReu));
    }

    function excluirAnexo($idDocumento, $tipo){
        $this->db->where('Id', $idDocumento);
        if($tipo == "documento"){
            $this->db->delete('PedidoAberturaDocs');
        }elseif($tipo == "prova"){
            $this->db->delete('PedidoAberturaProvas');
        }
    }
}