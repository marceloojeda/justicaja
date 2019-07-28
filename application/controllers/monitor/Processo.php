<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Processo extends CI_Controller {

	public function __construct() {
		parent::__construct();

		setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
		date_default_timezone_set('America/Sao_Paulo');

		$this->load->Model('PessoaModel');
		if($this->PessoaModel->GetDataUser('UsuarioAutenticado') == null){
			redirect(base_url());
		}
	}

	public function index()
	{
		$this->load->Model('ProcessoModel');

		$palavraChave = isset($_POST['PalavraChave']) ? $_POST['PalavraChave'] : null;
		$start = $this->uri->segment(3) !== null ? $this->uri->segment(3) : 0;
		$filtro = array('PalavraChave' => $palavraChave,
			'Limite' => 3,
			'Start' => $start);

		$processos = $this->ProcessoModel->GetByFiltro($filtro);

		// pagination
		$config = array();
		$config['per_page'] = 3;
		$config["base_url"] = base_url() . "Processo/Index";
		$config["total_rows"] = $processos['numRows'];
		$config['attributes'] = array('class' => 'page-link');
		$this->pagination->initialize($config);

		$data['dataPost'] = array(
			"title" => 'processos em trâmite', 
			"subtitle" => "Para otimizar sua busca, utilize as palavras chaves",
			"results" => $processos['results'],
			"links" => $this->pagination->create_links(),
			"paginaAtual" => $start,
			"NomeRealUser" => $this->PessoaModel->GetDataUser('Nome'));

		$this->load->view('processo/dashboard', $data);
	}

	public function details($id){
		$this->load->Model('ProcessoModel');

		$results = $this->ProcessoModel->GetFasesProcesso($id);
		$propostas = $this->ProcessoModel->GetSolucoesProcesso($id);

		$data['dataPost'] = array(
			"title" => 'processos em trâmite', 
			"subtitle" => "Para otimizar sua busca, utilize as palavras chaves",
			"results" => $results != false ? $results : null,
			"propostas" => $propostas);

		$this->load->view('processo/details2', $data);
	}


	private function getArbitro(){
		$arbitro = $this->ArbitroModel->getById($this->PessoaModel->GetDataUser('ArbitroId'));
		if(!$arbitro){
			$dadosArbitro = array(
				'PessoaId' => $this->PessoaModel->GetDataUser('PessoaId'),
				'DataCadastro' => date('Y-m-d H:i:s'),
				'Ativo' => 1
			);

			$idArbitro = $this->ArbitroModel->cadastrar($dadosArbitro);
			$arbitro = $this->ArbitroModel->getById($idArbitro);
		}

		return $arbitro;
	}


	function addSentenca($id)
	{
		$this->load->Model('ProcessoModel');
		$this->load->Model('ArbitroModel');

		$arbitro = $this->getArbitro();

		$processo = $this->ProcessoModel->GetById($id);
		$faseAtual = $this->ProcessoModel->GetFaseAtualByProcesso($id);
		$file = isset($_FILES['Sentenca']) ? $_FILES['Sentenca'] : null;

		if($file !== null){
			$uploaddir = FCPATH.'assets/uploads/solucoes/';
			$temp = explode(".", $file["name"]);
			$newfilename = round(microtime(true)) . '.' . end($temp);
			$uploadfile = $uploaddir . $newfilename;
			move_uploaded_file($file['tmp_name'], $uploadfile);

			$dataInsert = array(
				"ArbitroId" => $arbitro->Id,
				"ProcessoId" => $id,
				"DataCadastro" => date("Y-m-d H:i:s"),
				"ArquivoProposta" => $newfilename,
				"NumeroVotos" => null,
				"Vencedor" => null
			);

			$this->ProcessoModel->Insert_Sentenca($dataInsert);
		}

		$solucoes = $this->ProcessoModel->GetSolucoesProcesso($id);

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($solucoes));
	}

	function Solucoes($id){
		$this->load->Model('ProcessoModel');
		try {

			$data['results'] = $this->ProcessoModel->GetSolucoesProcesso($id);
			$data['voto'] = $this->ProcessoModel->GetVotoByArbitro($id, 5);

			$this->load->view('processo/solucoes', $data);	
		} catch (Exception $e) {
			$this->ProcessoModel->logErro($e->getMessage());
		}
	}


	public function RegistrarVoto(){
		$solucaoId = isset($_POST['SolucaoId']) ? $_POST['SolucaoId'] : null;

		$retorno = array(
			'erro' => false,
			'mensagem' => 'Seu voto foi registrado com sucesso.'
		);

		try{
			if($solucaoId !== null) {
				$this->load->Model('ProcessoModel');
				$this->load->Model('PessoaModel');

				$solucao = $this->ProcessoModel->GetSolucaoById($solucaoId);

				$jaVotou = $this->ProcessoModel->GetVotoByArbitro($solucao[0]['ProcessoId'], $this->PessoaModel->GetDataUser('PessoaId'));
				if(!$jaVotou){
					if($solucao !== null) {
						$data = array(
							"ProcessoId" => $solucao[0]['ProcessoId'],
							"SolucaoId" => $solucao[0]['Id'],
							"PessoaId" => $this->PessoaModel->GetDataUser('PessoaId'),
							"Data" => date("Y-m-d H:i:s"));

						$this->ProcessoModel->RegistrarVoto($data);
					} else {
						$retorno['erro'] = true;
						$retorno['mensagem'] = 'Registro da solução não encontrada.';
					}
				} else{
					$retorno['erro'] = true;
					$retorno['mensagem'] = 'Você já possui um voto registrado.';
				}
			} else {
				$retorno['erro'] = true;
				$retorno['mensagem'] = 'Parâmetro inválido!';
			}
		}catch(Exception $e) {
			$retorno['erro'] = true;
			$retorno['mensagem'] = 'Erro: '.$e->getMessage();
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($retorno));
	}
}

