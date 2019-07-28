<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pedido extends Parte_Controller {

	function __construct() {
		parent::__construct();
		$this->load->Model('PessoaModel');
		$this->load->helper('upload');
	}

	function Requisicao(){
		$customStyles = '<link href="'.base_url().'assets/css/bootstrap.css" rel="stylesheet">';
		$this->setCustomStyle($customStyles);

		$customScript = "<script src='<?php echo base_url();?>assets/js/addSentenca.js' type='text/javascript'></script>";
		$this->setCustomScript($customScript);
		
		//$this->setDadosView($data);
		$this->render('Pedido/stepOne');
		//$this->load->view('pedido/stepOne');
	}

	function Create(){
		
		$isAutor = !empty($_GET['autor']) 
		? $this->input->get('autor') 
		: false;

		$promotorId = $isAutor == 'true'
			? null
			: $this->PessoaModel->GetDataUser('PessoaId');

		if($isAutor == 'true'){

			$this->load->Model('PessoaModel');

			$pessoaId = $this->PessoaModel->GetDataUser('PessoaId');

			$pessoaInfo = $this->PessoaModel->GetById($pessoaId);

			$data = array(
				"Pessoa" => $pessoaInfo[0],
				"Reu" => null,
				"RazoesInfo" => null,
				"PromotorId" => $promotorId
			);
		}else{
			$data = array(
				"Pessoa" => null,
				"Reu" => null,
				"RazoesInfo" => null,
				"PromotorId" => $promotorId
			);
		}

		$customScripts = '<script src="'.base_url().'assets/js/pedido_abertura.js" type="text/javascript"></script>';
		$this->setCustomScript($customScripts);
		
		$this->setDadosView($data);
		$this->render('Pedido/Create');
	}


	function ConfirmCreate(){
		
		$config = array(
			array(
				'field' => 'Nome',
				'label' => 'Nome do autor',
				'rules' => 'required'
				),
			array(
				'field' => 'CpfCnpj',
				'label' => 'Cpf/Cnpj do autor',
				'rules' => 'required'
				),
			array(
				'field' => 'Email',
				'label' => 'E-mail do autor',
				'rules' => 'required|valid_email'
				),
			// array(
			// 	'field' => 'Endereco',
			// 	'label' => 'Endereço do autor',
			// 	'rules' => 'required'
			// 	),
			// array(
			// 	'field' => 'Numero',
			// 	'label' => 'Numero/Lote do autor',
			// 	'rules' => 'required'
			// 	),
			// array(
			// 	'field' => 'Bairro',
			// 	'label' => 'Bairro/Setor do autor',
			// 	'rules' => 'required'
			// 	),
			// array(
			// 	'field' => 'Cidade',
			// 	'label' => 'Cidade do autor',
			// 	'rules' => 'required'
			// 	),
			// array(
			// 	'field' => 'UF',
			// 	'label' => 'UF do autor',
			// 	'rules' => 'required'
			// 	),
			array(
				'field' => 'NomeReu',
				'label' => 'Nome do réu',
				'rules' => 'required'
				)
			);
		
		$dataAutor = array(
			"Nome" => $this->input->post('Nome'),
			"Tipo" => $this->input->post('Tipo'),
			"CpfCnpj" => $this->input->post('CpfCnpj'),
			"DocumentoTipo" => $this->input->post('DocumentoTipo'),
			"DocumentoNumero" => $this->input->post('DocumentoNumero'),
			"Celular" => $this->input->post('Celular'),
			"FoneFixo" => $this->input->post('Telefone'),
			"Email" => $this->input->post('Email'),
			"Endereco" => $this->input->post('Endereco'),
			"Numero" => $this->input->post('Numero'),
			"ComplementoEndereco" => $this->input->post('ComplementoEndereco'),
			"Bairro" => $this->input->post('Bairro'),
			"Cidade" => $this->input->post('Cidade'),
			"UF" => $this->input->post('UF'),
			"CEP" => $this->input->post('CEP'),
			"DataCadastro" => date('Y-m-d H:i:s')
			);

		$dataReu = array(
			"Nome" => $this->input->post('NomeReu'),
			"Tipo" => $this->input->post('TipoReu'),
			"CpfCnpj" => $this->input->post('CpfCnpjReu'),
			"DocumentoTipo" => $this->input->post('DocumentoTipoReu'),
			"DocumentoNumero" => $this->input->post('DocumentoNumeroReu'),
			"Celular" => $this->input->post('CelularReu'),
			"FoneFixo" => $this->input->post('TelefoneReu'),
			"Email" => $this->input->post('EmailReu'),
			"Endereco" => $this->input->post('EnderecoReu'),
			"Numero" => $this->input->post('NumeroReu'),
			"ComplementoEndereco" => $this->input->post('ComplementoEnderecoReu'),
			"Bairro" => $this->input->post('BairroReu'),
			"Cidade" => $this->input->post('CidadeReu'),
			"UF" => $this->input->post('UFReu'),
			"CEP" => $this->input->post('CEPReu'),
			"DataCadastro" => date('Y-m-d H:i:s')
			);

		$dataRazoes = array(
			"Razoes" => trim($this->input->post('Razoes')),
			"RazoesFile" => $_FILES['RazoesFile']
		);
		
		$this->form_validation->set_rules($config);

		if($this->input->post('Razoes') == "" && $_FILES['RazoesFile']['name'] == "")
			$this->form_validation->set_rules('Razoes', 'Razões do pedido', 'required');

		$this->form_validation->set_error_delimiters('<div class="col-sm-10 alert alert-warning">', '</div>');

		if ($this->form_validation->run() == FALSE){
			$data = array(
				"Pessoa" => $dataAutor,
				"Reu" => $dataReu,
				"PromotorId" => $this->input->post('PromotorId'),
				"RazoesInfo" => $dataRazoes
			);

			$this->load->view('pedido/Create', $data);
		}else{
			$razoesArquivo = null;
			if ($_FILES['RazoesFile']['name'] !== "") {
				$razoesArquivo = uploadFile('RazoesFile','pedidos');
			}

			$this->load->model('PedidoAberturaModel');

			$clausula = isset($_POST['ClausulaArbitral']) ? 1 : 0;

			$autorId = $this->input->post('PromotorId') !== ''
				? $this->PessoaModel->Insert_Pessoa($dataAutor)
				: $this->PessoaModel->GetDataUser('PessoaId');

			$reuId = $this->PessoaModel->Insert_Pessoa($dataReu);

			$dataPedido = array(
				"PessoaId" => $autorId,
				"ReuId" => $reuId,
				"PromotorId" => $this->input->post('PromotorId') !== '' ? $this->input->post('PromotorId') : null,
				"TabelaPrecoId" => null,
				"Razoes" => $this->input->post('Razoes'),
				"RazoesArquivo" => $razoesArquivo,
				"ContemClausulaArbitral" => $clausula,
				"Data" => date('Y-m-d H:i:s')
				);

			$pedidoId = $this->PedidoAberturaModel->Insert_PedidoAbertura($dataPedido);

			redirect('../pedido/upload/'.$pedidoId);
		}
	}
	
	function uploadDoc(){
		$this->load->model('PedidoAberturaModel');
		if ($_FILES['FileDoc']['name'] !== "") {
			if(!$this->PedidoAberturaModel->DocumentExistByPedidoTipo($this->input->post('PedidoId'), $this->input->post('Tipo'))){
				$documento = uploadFile('FileDoc','pedidos');

				$dataDoc = array(
					"PedidoId" => $this->input->post('PedidoId'),
					"TipoDocumento" => $this->input->post('Tipo'),
					"Arquivo" => $documento,
					"Observacao" => $this->input->post('Observacao')
					);

				$this->PedidoAberturaModel->Insert_PedidoDoc($dataDoc);
			}
		}
		redirect('../pedido/upload/'.$this->input->post('PedidoId'));
	}

	function uploadProva(){
		$this->load->model('PedidoAberturaModel');
		if ($_FILES['FileDoc']['name'] !== "") {
			$documento = uploadFile('FileDoc','pedidos');

			$dataDoc = array(
				"PedidoId" => $this->input->post('PedidoId'),
				"TipoProva" => $this->input->post('Tipo'),
				"Arquivo" => $documento,
				"Observacao" => $this->input->post('Observacao')
				);

			$this->PedidoAberturaModel->Insert_PedidoProva($dataDoc);
		}
		redirect('../pedido/upload/'.$this->input->post('PedidoId'));
	}

	function upload($id){

		$this->load->model('PessoaModel');
		$this->load->model('PedidoAberturaModel');

		$dataPedido = $this->PedidoAberturaModel->GetById($id);
		$dataAutor = $this->PessoaModel->GetById($dataPedido[0]['PessoaId']);
		$dataReu = $this->PessoaModel->GetById($dataPedido[0]['ReuId']);
		$dataDocs = $this->PedidoAberturaModel->GetDocsByPedido($id);
		$dataProvas = $this->PedidoAberturaModel->GetProvasByPedido($id);

		$data = array("Autor" => $dataAutor[0],
			"Reu" => $dataReu[0],
			"Pedido" => $dataPedido[0],
			"Documentos" => $dataDocs,
			"Provas" => $dataProvas);

		$this->load->view('pedido/PedidoUploads', $data);
	}

	function stepFinal($id){
		$this->load->model('PedidoAberturaModel');
		$this->load->model('PessoaModel');

		$codigoPedido = $id;
		$pedido = $this->PedidoAberturaModel->GetById($codigoPedido);
		$documentos = $this->PedidoAberturaModel->GetDocsByPedido($codigoPedido);
		$provas = $this->PedidoAberturaModel->GetProvasByPedido($codigoPedido);
		$pessoa = $this->PessoaModel->GetById($pedido[0]['PessoaId']);
		$reu = $this->PessoaModel->GetById($pedido[0]['ReuId']);

		$data['dataPost'] = array(
			"Autor" => $pessoa[0],
			"Reu" => $reu[0],
			"Pedido" => $pedido[0],
			"Documentos" => $documentos,
			"Provas" => $provas
			);
		$this->load->view('pedido/stepFinal',$data);
	}

	function papsPendentes(){
		$idPessoaLogado = $this->PessoaModel->GetDataUser('PessoaId');
		$this->load->model('PedidoAberturaModel');

		$paps = array();
		$pedidos = $this->PedidoAberturaModel->getByAutorId($idPessoaLogado, true);
		if($pedidos){
			$paps = $pedidos;
		}
		$pedidos = $this->PedidoAberturaModel->getByReuId($idPessoaLogado, true);
		if($pedidos){
			if(!$paps){
				$paps = $pedidos;
			}else{
				array_merge($paps,$pedidos);
			}
		}
		$pedidos = $this->PedidoAberturaModel->getByPromotorId($idPessoaLogado, true);
		if($pedidos){
			if(!$paps){
				$paps = $pedidos;
			}else{
				array_merge($paps,$pedidos);
			}
		}

		$this->getPecasPendentes($paps, $idPessoaLogado);

		$this->setDadosView($paps);
		$this->render('Pedido/paps_pendentes');
	}

	private function getPecasPendentes(&$paps, $idPessoa){
		for($i = 0; $i < sizeof($paps); $i++) {
			$pap = $paps[$i];
			if($pap['ReuId'] == $idPessoa){
				$paps[$i]['PecasPendentes'] = $this->getPecasPendentesPorPedido('Reu', $idPessoa, $pap['Id']);
				continue;
			}
			$paps[$i]['PecasPendentes'] = $this->getPecasPendentesPorPedido('Autor', $idPessoa, $pap['Id']);
		}
	}

	private function getPecasPendentesPorPedido($parte, $idParte, $idPap){
		if($parte == 'Reu'){
			return $this->getPecasPendentesReu($idParte,$idPap);
		}
		return $this->getPecasPendentesAutor($idParte,$idPap);
	}

	private function getPecasPendentesReu($idReu, $idPap){
		$retorno = array(
			'Contestacao' => 0,
			'Treplica' => 0,
			'UrlContestacao' => base_url().'monitor/Pecas/contestacaoCreate/'.$idPap,
			'UrlTreplica' => base_url().'monitor/Pecas/treplicaCreate/'.$idPap
		);

		$this->load->model('ContestacaoModel');
		$contestacao = $this->ContestacaoModel->GetByPedido($idPap);

		if(!$contestacao || sizeof($contestacao) <= 0){
			return $retorno;
		}

		if($contestacao[0]['PessoaId'] != $idReu){
			return $retorno;
		}
		$retorno['Contestacao'] = $contestacao[0]['Id'];

		if(!$this->getPapPossuiReplica($idPap)){
			$retorno['Treplica'] = 'xxxx';
			return $retorno;
		}

		$this->load->model('TreplicaModel');
		$treplica = $this->TreplicaModel->GetByPedido($idPap);

		if(!$treplica || sizeof($treplica) <= 0){
			return $retorno;
		}
		if($treplica[0]['ReuId'] != $idReu){
			return $retorno;
		}
		$retorno['Treplica'] = $treplica[0]['Id'];
		return $retorno;
	}

	private function getPapPossuiReplica($idPap){
		$pap = $this->PedidoAberturaModel->GetById($idPap);
		if(!$pap){
			return false;
		}
		$peca = $this->getPecasPendentesAutor($pap[0]['PessoaId'], $idPap);
		if(!array_key_exists("Replica", $peca)){
			return false;
		}
		return $peca['Replica'] > 0;
	}

	private function getPecasPendentesAutor($idAutor, $idPap){
		$retorno = array(
			'Replica' => 0,
			'UrlReplica' => base_url().'monitor/Pecas/replicaCreate/'.$idPap
		);

		$this->load->model('ReplicaModel');
		$replica = $this->ReplicaModel->GetByPedido($idPap);

		if(!$replica || sizeof($replica) <= 0){
			return $retorno;
		}
		if($replica[0]['AutorId'] != $idAutor){
			return $retorno;
		}
		$retorno['Replica'] = $replica[0]['Id'];

		return $retorno;
	}


}