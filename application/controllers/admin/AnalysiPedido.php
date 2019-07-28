<?php defined('BASEPATH') OR exit('No direct script access allowed');

class AnalysiPedido extends Admin_Controller
{

	function __construct() {
		parent::__construct();

		setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
		date_default_timezone_set('America/Sao_Paulo');

		$this->load->model('PedidoAberturaModel');
		$this->load->model('PessoaModel');
		$this->load->model('ContestacaoModel');

		$this->load->Model('LogErroModel');

		if($this->PessoaModel->GetDataUser('UsuarioAutenticado') == null){
			redirect(base_url());
		}
	}

	function Index($target = null){
		$this->load->Model('PedidoAberturaModel');

		$start = $this->uri->segment(4) != null ? $this->uri->segment(4) : 0;

		$filtro = array(
			"Autor" => isset($_POST['Autor']) ? $this->input->post('Autor') : null,
			"Reu" => isset($_POST['Reu']) ? $this->input->post('Reu') : null,
			"Cidade" => isset($_POST['Cidade']) ? $this->input->post('Cidade') : null,
			"UF" => isset($_POST['UF']) ? $this->input->post('UF') : "All",
			"Status" => isset($_POST['Status']) ? $this->input->post('Status') : "All",
			"PerPage" => 5,
			"Page" => $start,
			"Target" => $target,
			"TotalRegistros" => 0
		);

		//somente pedidos 'Aceitos' podem ser convertidos
		$filtro["Status"] = 4;

		$pedidos = $this->PedidoAberturaModel->GetByFiltro($filtro);

		// pagination
		$config = array();
		$config['per_page'] = 5;
		$config['uri_segment'] = 4;
		$config["base_url"] = base_url() . "admin/AnalysiPedido";
		$config["total_rows"] = $pedidos['numRows'];
		$config['attributes'] = array('class' => 'page-link');
		$this->pagination->initialize($config);

		$filtro["TotalRegistros"] = $pedidos['numRows'];

		$data['dataPost'] = array(
			'Pedidos' => $pedidos["results"],
			'Filtro' => $filtro,
			'links' => $this->pagination->create_links()
		);

		$this->load->view('admin/analysi/list_for_confirm', $data);
	}


	function ConfirmaPedido($id){

		if($this->input->post()){
			$this->load->model('ProcessoModel');

			if($this->PessoaModel->HasUpdate($this->input->post('Autor[Id]'), $this->input->post('Autor'))){
				$this->PessoaModel->Update($this->input->post('Autor'), $this->input->post('Autor[Id]'));
			}
			if($this->PessoaModel->HasUpdate($this->input->post('Reu[Id]'), $this->input->post('Reu'))){
				$this->PessoaModel->Update($this->input->post('Reu'), $this->input->post('Reu[Id]'));
			}

			$faseInicial = $this->ProcessoModel->GetFaseInicial();

			$dataCadastro = date('Y-m-d H:i:s');
			$processoEntidade = array(
				'PedidoId' => $id,
				'FaseAtualId' => $faseInicial->Id,
				'DataAbertura' => $dataCadastro,
				'Julgado' => 0,
				'NumeroVotos' => 0,
				'Numero' => mt_rand(321, 9999),
				'StatusLoad' => PRAZO_CONTANDO,
				'Sintese' => $this->input->post('Sintese')
			);

			$processoId = $this->ProcessoModel->cadastrarProcesso($processoEntidade);
			$this->ProcessoModel->setPrazoProcesso($processoId, $faseInicial->Prazo, $dataCadastro);

			$processoFaseEntidade = array(
				'ProcessoId' => $processoId,
				'FaseId' => $faseInicial->Id,
				'DataEntrada' => date('Y-m-d H:i:s'),
				'DataLimite' => date_add($dataCadastro, date_interval_create_from_date_string($faseInicial->Prazo." days")),
				'FaseAtual' => 1
			);

			$this->ProcessoModel->cadastrarFaseProcessual($processoFaseEntidade);

			redirect(base_url().'admin/Dashboard/tramitar');
		}



		$pedido = $this->PedidoAberturaModel->GetById($id);
		$autor = $this->PessoaModel->GetById($pedido[0]['PessoaId']);
		$reu = $this->PessoaModel->GetById($pedido[0]['ReuId']);
		$promotor = $pedido[0]['PromotorId'] == null
		? null
		: $this->PessoaModel->GetById($pedido[0]['PromotorId']);
		$documentos = $this->PedidoAberturaModel->GetDocsByPedido($id);
		$provas = $this->PedidoAberturaModel->GetProvasByPedido($id);
		$analise = $this->PedidoAberturaModel->GetAnaliseByPedidoId($id);
		$notificacoes = $this->PedidoAberturaModel->GetNotificacoesByPedido($id);
		$contestacoes = $this->ContestacaoModel->GetByPedido($id);

		$data['dataPost'] = array(
			"Title" => "Envio de Notificacao",
			"Subtitle" => "Meio de Comunicação",
			"Pedido" => $pedido[0],
			"Autor" => $autor[0],
			"Reu" => $reu[0],
			"Documentos" => $documentos,
			"Provas" => $provas,
			"Promotor" => $promotor,
			"Analise" => $analise[0],
			"Contestacoes" => $contestacoes,
			"Notificacoes" => $notificacoes
		);

		$this->load->view("admin/analysi/ConfirmaPedido", $data);
	}

	function manifestacoesPedidos($target = null){
		$this->load->Model('PedidoAberturaModel');

		$start = $this->uri->segment(4) != null ? $this->uri->segment(4) : 0;

		$filtro = array(
			"Autor" => isset($_POST['Autor']) ? $this->input->post('Autor') : null,
			"Reu" => isset($_POST['Reu']) ? $this->input->post('Reu') : null,
			"Cidade" => isset($_POST['Cidade']) ? $this->input->post('Cidade') : null,
			"UF" => isset($_POST['UF']) ? $this->input->post('UF') : "All",
			"Status" => isset($_POST['Status']) ? $this->input->post('Status') : "All",
			"ManifestacaoReu" => 1,
			"PerPage" => 5,
			"Page" => $start,
			"Target" => $target,
			"TotalRegistros" => 0
		);

		if($target == "NotificacaoReu")
			$filtro["Status"] = 1;

		$pedidos = $this->PedidoAberturaModel->GetByFiltro($filtro);

		// pagination
		$config = array();
		$config['per_page'] = 5;
		$config['uri_segment'] = 4;
		$config["base_url"] = base_url() . "admin/AnalysiPedido/manifestacoesPedidos";
		$config["total_rows"] = $pedidos['numRows'];
		$config['attributes'] = array('class' => 'page-link');
		$this->pagination->initialize($config);

		$filtro["TotalRegistros"] = $pedidos['numRows'];

		$data['dataPost'] = array(
			'Pedidos' => $pedidos["results"],
			'Filtro' => $filtro,
			'links' => $this->pagination->create_links()
		);

		$this->load->view('admin/analysi/manifestacoes_pedidos', $data);
	}

	function getManifestacaoByAnliseId($id){
		try{
			if(!is_numeric($id)){
				$this->output->set_content_type('application/json')
				->set_output(json_encode("false"));
			}

			$manifestacao = $this->PedidoAberturaModel->getAnaliseById($id);

			if(!$manifestacao){
				$this->output->set_content_type('application/json')
				->set_output(json_encode("false"));
			}

			$this->output->set_content_type('application/json')
			->set_output(json_encode($manifestacao->ManifestacaoReu));
		}catch(Exception $ex){
			$this->output->set_content_type('application/json')
			->set_output(json_encode($ex->getMessage()));
		}
	}
}