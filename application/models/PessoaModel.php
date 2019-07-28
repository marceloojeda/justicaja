<?php

class PessoaModel extends CI_Model {
	function __construct() {
        parent::__construct();
    }

    function GetDataUser($key){
        return $this->session->userdata($key);
    }

    function SetDataUser($newdata){
        $this->session->set_userdata($newdata);
    }

    function UnsetDataUser($dataUser){
        $this->session->unset_userdata($dataUser);
    }

    function GetAll(){
    	$this->db->select("p.Id as PessoaId, p.Nome, p.CpfCnpj, a.Id as ArbitroId");
    	$this->db->from('Pessoa p');
        $this->db->join('Arbitro a','p.Id = a.PessoaId');
        $this->db->not_like('p.Nome', 'Testes');
        
        $query = $this->db->get();

        if($query->num_rows() > 0)
        	return $query->result_array();
        else
        	return null;
    }


    function GetById($id){
        $this->db->from('Pessoa');
        $this->db->where('Id', $id);
        $query = $this->db->get();

        if($query->num_rows() > 0)
            return $query->result_array();
        else
            return null;
    }

    function GetByLogin($login){
        $this->db->select('p.Nome, u.Username, p.Id as PessoaId, u.Id as AccountId, u.UserType, p.CpfCnpj, ar.Id as ArbitroId');
        $this->db->from('Account u');
        $this->db->join('Pessoa p', 'u.PessoaId = p.Id');
        $this->db->join('Arbitro ar', 'p.Id = ar.PessoaId', 'left');
        $this->db->where('u.Username', $login);
        $query = $this->db->get();

        if($query->num_rows() > 0)
            return $query->result_array();
        else
            return null;
    }


    function GetByArbitro($id){
        $this->db->select("p.Id as PessoaId, p.Nome, p.CpfCnpj, a.Id as ArbitroId");
        $this->db->from('Pessoa p');
        $this->db->join('Arbitro a','p.Id = a.PessoaId');
        $this->db->where('a.Id', $id);
        
        $query = $this->db->get();

        if($query->num_rows() > 0)
            return $query->result_array();
        else
            return null;
    }

    function getByFiltro($filtro){
        $this->db->select("p.Id as PessoaId, p.Nome, p.CpfCnpj, p.Email, p.FoneFixo, p.Celular");
        if(strlen($filtro['Nome']) > 0){
            $this->db->like('p.Nome', $filtro['Nome']);
        }
        if(strlen($filtro['CpfCnpj']) > 0){
            $this->db->like('p.CpfCnpj', $filtro['CpfCnpj']);
        }
        if(strlen($filtro['Cidade']) > 0){
            $this->db->like('p.Cidade', $filtro['Cidade']);
        }
        if($filtro['UF'] != 'All'){
            $this->db->where('p.UF', $filtro['UF']);
        }
        $this->db->order_by('p.Nome');
        $this->db->limit($filtro['PerPage'], $filtro['Page']);
        $this->db->from('Pessoa p');

        $query = $this->db->get();

        if($query->num_rows() > 0)
            return $query->result_array();
        else
            return null;
    }

    function Insert_Pessoa($data){
        $this->db->insert('Pessoa', $data);
        return $this->db->insert_id();
    }


    function Update($data, $id){
        $this->db->where('Id', $id);
        $this->db->update('Pessoa', $data);
    }

    function UpdateLogin($data){
        $this->db->where('PessoaId', $data['PessoaId']);
        $this->db->from('Account');
        $query = $this->db->get();

        if($query->num_rows() > 0){
            $this->db->where('PessoaId', $data['PessoaId']);
            $this->db->update('Account', $data);
        }else
            $this->db->insert('Account', $data);
    }


    function AutenticarVisitante($data){
        $this->db->where('Username', $data['Username']);
        $this->db->where('Password', $data['Password']);
        $this->db->where('(EmailConfirmado', 1, false);
        $this->db->or_where('CodigoConfirmacao Is null)', null, false);
        $this->db->from('Account');
        $query = $this->db->get();
print_r($this->db->last_query());
        return $query->num_rows() > 0;
    }


    function RecuperacaSenha_Insert($data){
        $this->db->insert('AccountRecovery', $data);
        return $this->db->insert_id();
    }

    function CheckUsername($username){
        $this->db->where('Username', $username);
        $this->db->from('Account');
        $query = $this->db->get();

        return $query->num_rows() > 0;
    }

    function GetByHashdata($hashData){
        $this->db->select('p.Nome, a.Id as AccountId, p.Id as PessoaId');
        $this->db->from('AccountRecovery ar');
        $this->db->join('Account a', 'ar.AccountId = a.Id');
        $this->db->join('Pessoa p', 'a.PessoaId = p.Id');
        $this->db->where('HashData', $hashData);
        $this->db->where('DataAtendimento', null);

        $query = $this->db->get();

        if($query->num_rows() > 0)
            return $query->result_array();
        else
            return null;
    }

    function UpdatePassword($data){
        $this->db->where('Id', $data['Id']);
        $this->db->update('Account', $data);
    }

    function HasUpdate($id, $data){
        $updated = false;
        $entidade = $this->GetById($id);
        foreach ($entidade[0] as $key => $value) {
            if($data[$key] != $value){
                $updated = true;
                break;
            }
        }
        return $updated;
    }

    function getAccountByPessoaId($id){
        $this->db->where('PessoaId',$id);
        $this->db->from('Account');

        $query = $this->db->get();

        if($query->num_rows() > 0)
            return $query->row();
        else
            return null;
    }

    function confirmarEmail($hashData){
        $this->db->where('CodigoConfirmacao', $hashData);
        $this->db->from('Account a');

        $query = $this->db->get();

        if($query->num_rows() > 0){
            $conta = $query->row();
            $conta->EmailConfirmado = 1;
            $this->db->where('Id', $conta->Id);
            $this->db->update('Account', $conta);

            $pessoa = $this->GetById($conta->PessoaId);
            return $pessoa[0];
        }
        else{
            return false;
        }
    }

    function excluirPessoa($idPessoa){
        $this->db->where('Id', $idPessoa);
        $this->db->delete('Pessoa');
    }
}