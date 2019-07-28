<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Admin_Controller
{

	function __construct() {
		parent::__construct();

		$this->load->Model('PessoaModel');

		$this->load->Model('LogErroModel');

		$this->load->Model('ContestacaoModel');

		$this->load->Model('ReplicaModel');

		$this->load->Model('TreplicaModel');

		if($this->PessoaModel->GetDataUser('UsuarioAutenticado') == null){
			redirect(base_url());
		}

		$this->load->helper('text');
	}

	function Index(){
		try {
			$this->load->view('admin/dashboard_view');	
		} catch (Exception $e) {
			
			$dataInsert = array("Data" => date('Y-m-d H:i:s'),
				"Message" => $e->getMessage());

			$this->LogErroModel->Insert($dataInsert);
		}
	}

	function pedidoList($target = null){
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

		if($target == "NotificacaoReu")
			$filtro["Status"] = 1;

		$pedidos = $this->PedidoAberturaModel->GetByFiltro($filtro);

		// pagination
		$config = array();
		$config['per_page'] = 5;
		$config['uri_segment'] = 4;
		$config["base_url"] = base_url() . "admin/dashboard/pedidoList";
		$config["total_rows"] = $pedidos['numRows'];
		$config['attributes'] = array('class' => 'page-link');
		$this->pagination->initialize($config);

		$filtro["TotalRegistros"] = $pedidos['numRows'];

		$data['dataPost'] = array(
			'Pedidos' => $pedidos["results"],
			'Filtro' => $filtro,
			'links' => $this->pagination->create_links()
		);

		$this->load->view('admin/analysi/pedidoList', $data);
	}

	function AnalisarPedidoAbertura($id){
		$this->load->model('PedidoAberturaModel');
		$this->load->model('PessoaModel');

		$codigoPedido = $id;
		$pedido = $this->PedidoAberturaModel->GetById($codigoPedido);
		$documentos = $this->PedidoAberturaModel->GetDocsByPedido($codigoPedido);
		$provas = $this->PedidoAberturaModel->GetProvasByPedido($codigoPedido);
		$autor = $this->PessoaModel->GetById($pedido[0]['PessoaId']);
		$reu = $this->PessoaModel->GetById($pedido[0]['ReuId']);
		$promotor = $pedido[0]['PromotorId'] == null
			? null
			: $this->PessoaModel->GetById($pedido[0]['PromotorId']);

		$data['dataPost'] = array(
			"Autor" => $autor[0],
			"Reu" => $reu[0],
			"Promotor" => $promotor,
			"Pedido" => $pedido[0],
			"Documentos" => $documentos,
			"Provas" => $provas,
			"Sintetico" => true
		);
		$this->load->view('admin/analysi/analisePedido',$data);
	}


	function SalvarAnalise(){
		$this->load->model('PedidoAberturaModel');
		$this->load->model('PessoaModel');
		$this->load->helper('user_session');

		try{
			$dataConclusao = $this->input->post('Status') == 4
			? date('Y-m-d H:i:s')
			: null;

			if(!isset($_POST["AnaliseId"])){
				$dataInsert = array(
					"PedidoId" => $this->input->post('PedidoId'),
					"DataInicio" => date('Y-m-d H:i:s'),
					"DataConclusao" => $dataConclusao,
					"Status" => $this->input->post('Status'),
					"Observacao" => $this->input->post('Analise')
				);

				$analiseId = $this->PedidoAberturaModel->Insert_PedidoAnalise($dataInsert);
			}else{
				$dataUpdate = array(
					"Id" => $this->input->post('AnaliseId'),
					"DataConclusao" => $dataConclusao,
					"Status" => $this->input->post('Status'),
					"Observacao" => $this->input->post('Analise')
				);

				$this->PedidoAberturaModel->Update_Analise($dataUpdate);
			}
			// SALVA O CODIGO DE RASTREAMENTO DO PEDIDO
			// PARA SER USADO EM URL DIRETA
			$hashData = '';
			if($this->input->post('Status') == 1){
				$hashData = GeraHash(40);

				$dataUpdate = array(
					"Id" => $this->input->post('PedidoId'),
					"CodigoAceite" => $hashData
				);

				$this->PedidoAberturaModel->SaveCodigoAceite($dataUpdate);

				redirect(base_url()."admin/Notification/Notificar/".$this->input->post('PedidoId'));
			} else {
				$data['dataView'] = array(
					"Title" => "Concluído!",
					"Subtitle" => "Análise do Pedido de Abertura de Processo realizada com sucesso."
				);
				$this->load->view('admin/shared/result', $data);
			}
		} catch (Exception $e) {
			
			$dataInsert = array("Data" => date('Y-m-d H:i:s'),
				"Message" => $e->getMessage());

			$this->LogErroModel->Insert($dataInsert);
		}
	}

	function ViewPedido($id){
		$this->load->model('PedidoAberturaModel');
		$this->load->model('PessoaModel');

		$pedido = $this->PedidoAberturaModel->GetById($id);
		$autor = $this->PessoaModel->GetById($pedido[0]['PessoaId']);
		$reu = $this->PessoaModel->GetById($pedido[0]['ReuId']);
		$promotor = $pedido[0]['PromotorId'] == null
			? null
			: $this->PessoaModel->GetById($pedido[0]['PromotorId']);
		$documentos = $this->PedidoAberturaModel->GetDocsByPedido($id);
		$provas = $this->PedidoAberturaModel->GetProvasByPedido($id);
		$analise = $this->PedidoAberturaModel->GetAnaliseByPedidoId($id);

		$data['dataPost'] = array(
			"Title" => "Acompanhamento de Pedido",
			"Subtitle" => "Meio de Comunicação",
			"Pedido" => $pedido[0],
			"Documentos" => $documentos,
			"Provas" => $provas,
			"Analise" => $analise[0],
			"Autor" => $autor[0],
			"Reu" => $reu[0]
		);

		$this->load->view("admin/analysi/ViewPedido", $data);
	}

	private function getFiltro($target){
		$start = $this->uri->segment(4) != null ? $this->uri->segment(4) : 0;

		$filtro = array(
			"Autor" => isset($_POST['Autor']) ? $this->input->post('Autor') : null,
			"Reu" => isset($_POST['Reu']) ? $this->input->post('Reu') : null,
			"Cidade" => isset($_POST['Cidade']) ? $this->input->post('Cidade') : null,
			"UF" => isset($_POST['UF']) ? $this->input->post('UF') : "All",
			"Status" => isset($_POST['Status']) ? $this->input->post('Status') : "All",
			"PalavraChave" => isset($_POST['PalavraChave']) ? $this->input->post('PalavraChave') : "",
			"Limite" => 5,
			"Start" => $start,
			"Target" => $target,
			"TotalRegistros" => 0
		);

		return $filtro;
	}

	private function setPaginacao($uriDestino, $totalRegistros){
		// pagination
		$config = array();
		$config['per_page'] = 5;
		$config['uri_segment'] = 4;
		$config["base_url"] = base_url() . $uriDestino;
		$config["total_rows"] = $totalRegistros;
		$config['attributes'] = array('class' => 'page-link');
		$this->pagination->initialize($config);
	}

	function listarProcessos($target = null){
		$this->load->Model('ProcessoModel');

		//somente pedidos 'Aceitos' podem ser convertidos
		$filtro = $this->getFiltro($target);
		$filtro["Status"] = 4;

		$processos = $this->ProcessoModel->GetByFiltro($filtro);

		$filtro["TotalRegistros"] = $processos['numRows'];

		$this->setPaginacao("admin/Dashboard/listarProcessos", $processos['numRows']);

		$data['dataPost'] = array(
			'Processos' => $processos["results"],
			'Filtro' => $filtro,
			'links' => $this->pagination->create_links()
		);

		$this->load->view('admin/processo/listarProcessos', $data);
	}

	function tramitar($target = null){
		$this->load->Model('ProcessoModel');

		if($this->input->post()){
			$faseAtualEntidade = $this->ProcessoModel->GetFaseAtualByProcesso($this->input->post('ProcessoId'));
			if($faseAtualEntidade){
				$faseAnterior = array(
					'Id' => $faseAtualEntidade[0]['ProcessoFasesId'],
					'DataSaida' => date('Y-m-d H:i:s'),
					'FaseAtual' => 0
				);
				$this->ProcessoModel->atualizarProcessoFase($faseAnterior);
			}

			$faseProcessualEntidade = $this->ProcessoModel->getFaseProcessual($this->input->post('Fase'));
			if($faseProcessualEntidade){
				$dataAtual = date('Y-m-d H:i:s');
				$dataLimite = date('Y-m-d H:i:s', strtotime($dataAtual. ' + '.$faseProcessualEntidade->Prazo.' days'));
				$proximaFase = array(
					'ProcessoId' => $this->input->post('ProcessoId'),
					'FaseId' => $this->input->post('Fase'),
					'DataEntrada' => $dataAtual,
					'DataLimite' => $dataLimite,
					'FaseAtual' => 1
				);

				$this->ProcessoModel->cadastrarFaseProcessual($proximaFase);
				$this->ProcessoModel->setPrazoProcesso($this->input->post('ProcessoId'), $faseProcessualEntidade->Prazo, $dataAtual);
			}
		}

		//somente pedidos 'Aceitos' podem ser convertidos
		$filtro = $this->getFiltro($target);
		$filtro["Status"] = 4;

		$processos = $this->ProcessoModel->GetByFiltro($filtro);

		$filtro["TotalRegistros"] = $processos['numRows'];

		$this->setPaginacao("admin/Dashboard/tramitar", $processos['numRows']);

		$data['dataPost'] = array(
			'Processos' => $processos["results"],
			'Filtro' => $filtro,
			'links' => $this->pagination->create_links()
		);

		$this->load->view('admin/processo/tramitar', $data);
	}

	function getPecaPedido(){
		if(!$this->input->post('pedidoId') || !$this->input->post('tipo')){
			return $this->output->set_content_type('application/json')->set_output(json_encode("false"));
		}

		$model = ucfirst($this->input->post('tipo')).'Model';
		$peca = $this->$model->GetByPedido($this->input->post('pedidoId'));

		if(!$peca){
			return $this->output->set_content_type('application/json')->set_output(json_encode("false"));
		}
		$retorno = [];
		foreach ($peca as $item) {
			$retorno[] = array(
				'Id' => $item['Id'],
				'Titulo' => ucfirst($this->input->post('tipo')),
				'Texto' => $item['Texto'],
				'TipoDocumento' => $item['TipoDocumento'],
				'Arquivo' => $item['Arquivo'],
				'Observacao' => $item['Observacao']
			);
		}
		return $this->output->set_content_type('application/json')->set_output(json_encode($retorno));
	}

	function excluirAnexao(){
		$retorno = array(
			'erro' => false,
			'mensagem' => 'Anexo excluído com sucesso!'
		);

		if(empty($this->input->post('tipo')) || empty($this->input->post('id'))){
			$retorno['erro'] = true;
			$retorno['mensagem'] = 'Parâmetros faltando';
		}else{
			try{
				$this->load->model('PedidoAberturaModel');
				$this->PedidoAberturaModel->excluirAnexo($this->input->post('id'),$this->input->post('tipo'));
			} catch(Exception $e){
				$retorno['erro'] = true;
				$retorno['mensagem'] = $e->getMessage();
			}
		}
		header('Content-Type: application/json');
		echo json_encode($retorno);
	}

	function getSintese($idProcesso){
		$this->load->Model('ProcessoModel');
		$processo = $this->ProcessoModel->GetById($idProcesso);

		echo !$processo ? '' : $processo->Sintese;
	}

	function getSolucoes($idProcesso){
		$this->load->Model('ProcessoModel');
		$solucoes = $this->ProcessoModel->GetSolucoesProcesso($idProcesso);
		
		return $this
			->output
			->set_content_type('application/json')
			->set_output(json_encode($solucoes));
	}

	function getTramitacao($idProcesso){
		$this->load->Model('ProcessoModel');
		$processo = $this->ProcessoModel->GetById($idProcesso);

		$fases = $this->ProcessoModel->getFasesProcessuais();

		$retorno = array(
			'FaseAtual' =>$processo->FaseAtual,
			'Fases' => $fases
		);

		return $this
			->output
			->set_content_type('application/json')
			->set_output(json_encode($retorno));
	}

	function setStatusLoad(){
		$retorno = array(
			'erro' => false,
			'mensagem' => ''
		);

		if(!$this->input->post() || empty($this->input->post('idProcesso')) || empty($this->input->post('idStatus'))){
			$retorno['erro'] = true;
			$retorno['mensagem'] = 'Parametros inválidos';

			return $this
				->output
				->set_content_type('application/json')
				->set_output(json_encode($retorno));
		}

		$this->load->Model('ProcessoModel');
		$this->ProcessoModel->setStatusLoad($this->input->post('idProcesso'), $this->input->post('idStatus'));

		$retorno['mensagem'] = 'Status do prazo processual atualizado com sucesso.';

		return $this
			->output
			->set_content_type('application/json')
			->set_output(json_encode($retorno));
	}

	function testeSetStatus(){
		$this->load->Model('ProcessoModel');
		$this->ProcessoModel->setStatusLoad(1, PRAZO_PARADO);
		$this->ProcessoModel->setStatusLoad(1, PRAZO_CONTANDO);
	}
}