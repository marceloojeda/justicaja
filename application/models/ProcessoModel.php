<?php

class ProcessoModel extends CI_Model {
	
	function __construct() {
        parent::__construct();
    }

    
    function logErro($message){
        $data = array("Data" => date("Y-m-d H:i:s"), 
            "Message" => $message);

        $this->db->insert('logErro', $data);
    }

    private function setFiltro(array $filtro){
        if(!empty($filtro['Autor']))
            $this->db->like("autor.Nome", $filtro['Autor']);
        if(!empty($filtro['Reu']))
            $this->db->like("reu.Nome", $filtro['Reu']);
        if(!empty($filtro['Cidade'])){
            $this->db->like("autor.Cidade", $filtro['Cidade']);
            $this->db->or_like("reu.Cidade", $filtro['Cidade']);
        }
        if(!empty($filtro['UF']) && $filtro['UF'] != "All"){
            $this->db->where("autor.UF", $filtro['UF']);
            $this->db->or_where("reu.UF", $filtro['UF']);
        }
    }

    function GetByFiltro($filtro){
    	extract($filtro);

    	$sentenca = preg_replace('/( )+/', ' ', $PalavraChave);
    	$keywords = explode(' ', $sentenca);

    	$this->db->select('p.*, pa.Razoes, autor.Nome as Autor, reu.Nome as Reu, pa.PromotorId, pa.PessoaId as AutorId, pa.ReuId');
        $this->db->from('Processo p');
        $this->db->join('PedidoAbertura pa', 'p.PedidoId = pa.Id');
        $this->db->join('Pessoa autor', 'pa.PessoaId = autor.Id');
        $this->db->join('Pessoa reu', 'pa.ReuId = reu.Id');
        if(is_array($filtro) && sizeof($filtro) > 0){
            $this->setFiltro($filtro);
        }
    	$this->db->limit($Limite, $Start);
    	for ($i=0; $i < sizeof($keywords); $i++) { 
   			$this->db->like('pa.Razoes', $keywords[$i], 'both');
    	}
        $this->db->order_by('DataAbertura', 'desc');
        $query = $this->db->get();

        if($query->num_rows() > 0){
            $entities = $query->result_array();
            $results = array();
            foreach ($entities as $key => $value) {
                $faseAtual = $this->GetFaseAtualByProcesso($value['Id']);

                if($faseAtual != null){
                    $prazo = date('Y-m-d', strtotime($faseAtual[0]['DataEntrada']
                        .' + '
                        .$faseAtual[0]['Prazo']
                        .' days'));

                    $item = array('Id' => $value['Id'],
                        'Numero' => $value['Numero'],
                        'Autor' => $value['Autor'],
                        'AutorId' => $value['AutorId'],
                        'Reu' => $value['Reu'],
                        'ReuId' => $value['ReuId'],
                        'PromotorId' => $value['PromotorId'],
                        'Sintese' => $value['Razoes'],
                        'DataAbertura' => $value['DataAbertura'],
                        'FaseAtual' => $faseAtual[0]['Nome'],
                        'Prazo' => $prazo,
                        'NumeroVotos' => $value['NumeroVotos'],
                        'StatusLoad' => $value['StatusLoad']
                    );

                    $results[$key] = $item;
                }else{
                    $item = array('Id' => $value['Id'],
                        'Numero' => $value['Numero'],
                        'Autor' => $value['Autor'],
                        'AutorId' => $value['AutorId'],
                        'Reu' => $value['Reu'],
                        'ReuId' => $value['ReuId'],
                        'PromotorId' => $value['PromotorId'],
                        'Sintese' => $value['Sintese'],
                        'DataAbertura' => $value['DataAbertura'],
                        'FaseAtual' => null,
                        'Prazo' => null,
                        'NumeroVotos' => $value['NumeroVotos'],
                        'StatusLoad' => $value['StatusLoad']
                    );
                    $results[$key] = $item;
                }
            }

            $response = array('numRows' => $query->num_rows(),
                'results' => $results);
            
            return $response;
        }
        else
        {
            $response = array('numRows' => 0,
                'results' => null);
            
            return $response;
        }
    }

    function GetNumRowsByFiltro($filtro){
    	extract($filtro);

    	$sentenca = preg_replace('/( )+/', ' ', $PalavraChave);
    	$keywords = explode(' ', $sentenca);

    	for ($i=0; $i < sizeof($keywords); $i++) { 
   			$this->db->like('Sintese', $keywords[$i], 'both');
    	}
		$this->db->from('Processo');

		$results = $this->db->count_all_results();

        return $results;
    }

    function GetById($id){
        $this->db->select('proc.*, fase.Nome as FaseAtual, faseProc.DataLimite as Prazo');
        $this->db->join('FaseProcessual fase', 'proc.FaseAtualId = fase.Id', 'Left');
        $this->db->join('ProcessoFases faseProc', 'proc.Id = faseProc.ProcessoId', 'Left');
        $this->db->where('proc.Id', $id);
        $this->db->where('faseProc.FaseId = proc.FaseAtualId');
        return $this->db->get('Processo proc')->row();
    }

    function AddPeticaoInicialByProcessoId($processoId, $fileLocation){
    	$fp = fopen($fileLocation, 'r');
		$content = fread($fp, filesize($fileLocation));
		$content = addslashes($content);
		fclose($fp);

		$this->db->from('ProcessoPecas');
    	$this->db->where('ProcessoId', $processoId);
    	$query = $this->db->get();

    	if($query->num_rows() > 0){
    		$this->db->set('PeticaoInicial', $content);
	        $this->db->where('ProcessoId', $processoId);
	        $this->db->update('ProcessoPecas');
    	}
    	else{
    		$data = array(
    			"ProcessoId" => $processoId,
    			"PeticaoInicial" => $content);

    		$this->db->insert('ProcessoPecas', $data);
    	}
    }

    function GetFaseAtualByProcesso($processoId){
        $this->db->select('f.Nome, f.Prazo, pf.DataEntrada, pf.Id as ProcessoFasesId');
        $this->db->from('ProcessoFases pf');
        $this->db->join('FaseProcessual f', 'pf.FaseId = f.Id');
        $this->db->where('pf.ProcessoId', $processoId);
        $this->db->where('pf.FaseAtual', 1);
        $this->db->order_by('pf.Id', 'desc');
        $this->db->limit(1);
        
        return $this->db->get()->result_array();
    }


    function GetFasesProcesso($processoId){
        $this->db->select('f.Nome as Fase, f.Prazo, pf.DataEntrada, pf.FaseAtual, pf.DataSaida');
        $this->db->from('ProcessoFases pf');
        $this->db->join('FaseProcessual f', 'pf.FaseId = f.Id');
        $this->db->where('pf.ProcessoId', $processoId);
        //$this->db->where('pf.FaseAtual', 1);
        $this->db->order_by('pf.Id', 'desc');
        //$this->db->limit(1);
        $query = $this->db->get();

        if($query->num_rows() > 0)
            return $query->result_array();
        else
            return null;
    }


    function GetFaseInicial(){
        $this->db->where('f.Codigo', 'STEP7');
        $this->db->where('f.Ativo', 1);
        
        return $this->db->get('FaseProcessual f')->row();
    }

    function getProximaFaseProcessual($step){
        $this->db->where('f.Codigo > ', $step);
        $this->db->where('f.Ativo', 1);
        $this->db->limit(1);
        
        return $this->db->get('FaseProcessual f')->row();
    }


    function GetSolucoesProcesso($processoId){
        $faseAtual = $this->GetFaseAtualByProcesso($processoId);

        $this->db->select('p.Id as ProcessoId, pe.Nome as Arbitro, ps.*');
        $this->db->from('ProcessoSolucoes ps');
        $this->db->join('Processo p', 'ps.ProcessoId = p.Id');

        $this->db->join('Arbitro ar', 'ps.ArbitroId = ar.Id');
        $this->db->join('Pessoa pe', 'ar.PessoaId = pe.Id');

        $this->db->where('ps.ProcessoId', $processoId);
        $this->db->order_by('ps.Id', 'asc');
        $query = $this->db->get();

        if($query->num_rows() > 0){
            $results = array();
            $contador = 0;
            foreach ($query->result_array() as $key => $value) {
                $prazo = date('Y-m-d', strtotime($faseAtual[0]['DataEntrada']. ' + '. $faseAtual[0]['Prazo']. ' days'));

                $item = array(
                    'ProcessoId' => $value['ProcessoId'],
                    'FaseAtual' => $faseAtual[0]['Nome'],
                    'Prazo' => $prazo,
                    'DataCadastro' => $value['DataCadastro'],
                    'SolucaoId' => $value['Id'],
                    'Arquivo' => $value['ArquivoProposta'],
                    'Arbitro' => $value['Arbitro'],
                    'Votos' => $value['NumeroVotos']
                );

                $results[$contador] = $item;
                $contador++;
            }
            return $results;
        }
        else
            return null;
    }


    function GetSolucaoById($id){
        $this->db->from('ProcessoSolucoes');
        $this->db->where('Id', $id);
        $query = $this->db->get();

        if($query->num_rows() > 0)
            return $query->result_array();
        else
            return null;
    }

    function jaEnviouSolucao($idArbitro, $idProcesso){
        $this->db->where('ArbitroId', $idArbitro);
        $this->db->where('ProcessoId', $idProcesso);

        $result = $this->db->get('ProcessoSolucoes')->result();

        return count($result) > 0;
    }

    function RegistrarVoto($data){
        $this->db->insert("ProcessoVotacao", $data);
    }


    function GetVotoByArbitro($processoId, $pessoaId){
        $this->db->where('ProcessoId', $processoId);
        $this->db->where('PessoaId', $pessoaId);
        return $this->db->get('ProcessoVotacao')->row();
    }


    function Insert_Sentenca($data){
        $this->db->insert('ProcessoSolucoes', $data);
    }

    public function cadastrarProcesso($processoEntidade){
        $this->db->insert('Processo', $processoEntidade);

        return $this->db->insert_id();
    }

    function cadastrarFaseProcessual($data){
        $this->db->insert('ProcessoFases', $data);
    }

    function atualizarFaseProcessual($dados){
        $this->db->where('Id', $dados['Id']);
        $this->db->update('ProcessoFases', $dados);
    }

    public function getControlePrazo($idProcesso){
        $this->db->where('ProcessoId', $idProcesso);
        return $this->db->get('ProcessoPrazo')->row();
    }

    public function setPrazoProcesso($idProcesso, $prazo, $dataAtualizacao, $percorrido = 0){
        $dados = array(
            'ProcessoId' => $idProcesso,
            'Prazo' => $prazo,
            'Percorrido' => $percorrido,
            'UltimaAtualizacao' => $dataAtualizacao
        );

        $this->db->where('ProcessoId', $idProcesso);
        $controlePrazo = $this->db->get('ProcessoPrazo')->row();

        if(!$controlePrazo){
            $this->db->insert('ProcessoPrazo', $dados);
        }else{
            $this->db->where('ProcessoId', $idProcesso);
            $this->db->update('ProcessoPrazo', $dados);
        }
    }

    function atualizarProcessoFase(array $dados){
        $this->db->where('Id', $dados['Id']);
        $this->db->update('ProcessoFases', $dados);
    }

    function getFasesProcessuais(){
        $steps = ['STEP7','STEP8','STEP9','STEP10'];
        
        $this->db->where_in('Codigo ', $steps);
        return $this->db->get('FaseProcessual')->result();
    }

    function getFaseProcessual($idFaseProcessual){
        $this->db->where('Id', $idFaseProcessual);
        return $this->db->get('FaseProcessual')->row();
    }

    function getProcessosPrazoVencido($dataReferencia){
		$this->db->join('Processo p', 'pf.ProcessoId = p.Id');
		$this->db->join('FaseProcessual fp', 'pf.FaseId = fp.Id');
		$this->db->where('pf.DataLimite < ', $dataReferencia);
		$this->db->where('pf.FaseAtual', 1);
		$this->db->where('p.Julgado', 0);
        $this->db->where('p.StatusLoad', PRAZO_CONTANDO);
		$this->db->where('fp.Codigo != ', "'STEP10'");

		return $this->db->get('ProcessoFases pf')->result();
	}

    function setStatusLoad($idProcesso, $idStatus){
        $processo = $this->GetById($idProcesso);
        $idStatusAnterior = $processo->StatusLoad;

        $this->db->set('StatusLoad', $idStatus);
        $this->db->where('Id', $idProcesso);
        $this->db->update('Processo');

        if($idStatus != PRAZO_CONTANDO || $idStatusAnterior === null){
            return;
        }

        // Reseta a contagem de prazos
        if($idStatusAnterior == PRAZO_PARADO){
            $this->resetarContagemPrazo($idProcesso);
            return;
        }

        // Re-start da contagem de prazos
        if($idStatusAnterior == PRAZO_SUSPENSO){
            $this->continuarContagemPrazo($idProcesso);
        }
    }

    private function resetarContagemPrazo($idProcesso){
        $faseAtual = $this->GetFaseAtualByProcesso($idProcesso);
        if(!$faseAtual){
            return;
        }

        //Atualizando data limite do prazo
        $dataAtual = date('Y-m-d 23:59:59');
        $dataLimite = date('Y-m-d', strtotime($dataAtual. ' + '.$faseAtual[0]['Prazo'].' days'));
        $entidade = array(
            'Id' => $faseAtual[0]['ProcessoFasesId'],
            'DataLimite' => $dataLimite
        );
        $this->atualizarFaseProcessual($entidade);

        //zerando a contagem de prazo
        $prazo = array('ProcessoId' => $idProcesso, 'Percorrido' => 0, 'UltimaAtualizacao' => $dataAtual);
        $this->db->where('ProcessoId', $prazo['ProcessoId']);
        $this->db->update('ProcessoPrazo', $prazo);
    }

    private function continuarContagemPrazo($idProcesso){
        $faseAtual = $this->GetFaseAtualByProcesso($idProcesso);
        if(!$faseAtual){
            return;
        }

        $this->db->where('ProcessoId', $idProcesso);
        $controlePrazo = $this->db->get('ProcessoPrazo')->row();
        if(!$controlePrazo){
            return;
        }

        //Atualizando data limite do prazo
        $prazoRestante = $controlePrazo->Prazo - $controlePrazo->Percorrido;
        $dataAtual = date('Y-m-d 23:59:59');
        $dataLimite = date('Y-m-d', strtotime($dataAtual. ' + '.$prazoRestante.' days'));
        $entidade = array(
            'Id' => $faseAtual[0]['ProcessoFasesId'],
            'DataLimite' => $dataLimite
        );
        $this->atualizarFaseProcessual($entidade);

        //atualizando data atualização
        $prazo = array('ProcessoId' => $idProcesso, 'UltimaAtualizacao' => $dataAtual);
        $this->db->where('ProcessoId', $prazo['ProcessoId']);
        $this->db->update('ProcessoPrazo', $prazo);
    }

    function contarPrazos(){
        $dataAtual = date('Y-m-d 00:00:00');

        $this->db->where('p.StatusLoad', PRAZO_CONTANDO);
        $this->db->where('pp.Prazo > pp.Percorrido');
        $this->db->where('pp.UltimaAtualizacao < ', $dataAtual);
        $this->db->join('Processo p', 'pp.ProcessoId = p.Id');

        $controles = $this->db->get('`ProcessoPrazo pp')->result();
        foreach ($controles as $controle) {
            $percorrido = $controle->Percorrido + 1;
            $this->setPrazoProcesso($controle->ProcessoId, $controle->Prazo, $dataAtual, $percorrido);
        }
    }
}