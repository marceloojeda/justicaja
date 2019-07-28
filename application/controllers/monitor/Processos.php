<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Processos extends Parte_Controller {

	private $idPessoaLogado;

	function __construct(){
		parent::__construct();

		$this->load->model('ProcessoModel');
		$this->load->model('PessoaModel');

		$this->idPessoaLogado = $this->PessoaModel->GetDataUser('PessoaId');
	}

	public function index($target = null)
	{
		$start = $this->uri->segment(4) != null ? $this->uri->segment(4) : 0;

		$filtro = array(
			"Autor" => isset($_POST['Autor']) ? $this->input->post('Autor') : null,
			"Reu" => isset($_POST['Reu']) ? $this->input->post('Reu') : null,
			"Cidade" => isset($_POST['Cidade']) ? $this->input->post('Cidade') : null,
			"UF" => isset($_POST['UF']) ? $this->input->post('UF') : "All",
			"Status" => isset($_POST['Status']) ? $this->input->post('Status') : "All",
			"PalavraChave" => isset($_POST['PalavraChave']) ? $this->input->post('PalavraChave') : "",
			"Limite" => 10,
			"Start" => $start,
			"Target" => $target,
			"TotalRegistros" => 0
		);

		//somente pedidos 'Aceitos' podem ser convertidos
		$filtro["Status"] = 4;

		$processos = $this->ProcessoModel->GetByFiltro($filtro);

		// pagination
		$config = array();
		$config['per_page'] = 5;
		$config['uri_segment'] = 4;
		$config["base_url"] = base_url() . "monitor/Processos";
		$config["total_rows"] = $processos['numRows'];
		$config['attributes'] = array('class' => 'page-link');
		$this->pagination->initialize($config);

		$filtro["TotalRegistros"] = $processos['numRows'];

		$data = array(
			'Processos' => $processos["results"],
			'Filtro' => $filtro,
			'links' => $this->pagination->create_links(),
			'idPessoaLogado' => $this->idPessoaLogado
		);

		$this->setDadosView($data);

		$customStyles = '<link href="'.base_url().'assets/css/w3.css" rel="stylesheet">';
		$customStyles .= '<link href="'.base_url().'assets/css/lista-processos.css" rel="stylesheet">';
		$this->setCustomStyle($customStyles);

		$customScripts = '<script src="'.base_url().'assets/js/admin/analysi/converter_pedido.js" type="text/javascript"></script>';
		$this->setCustomScript($customScripts);

		$this->render('monitor/Processos/index');
	}


	private function getArbitro(){
		$this->load->Model('ArbitroModel');
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

	public function verProcesso($id){
		$this->load->model('PedidoAberturaModel');
		$this->load->model('ContestacaoModel');
		$this->load->model('ReplicaModel');
		$this->load->model('TreplicaModel');

		$processo = $this->ProcessoModel->GetById($id);

		$razoes = $this->PedidoAberturaModel->GetById($processo->PedidoId);
		$razoesProvas = $this->PedidoAberturaModel->GetProvasByPedido($processo->PedidoId);

		$contestacao = $this->ContestacaoModel->GetByPedido($processo->PedidoId);
		$contestacaoDocs = $this->ContestacaoModel->getDocumentos($contestacao[0]['Id']);

		$replica = $this->ReplicaModel->GetByPedido($processo->PedidoId);
		$replicaDocs = $this->ReplicaModel->getDocsByPedido($processo->PedidoId);

		$treplica = $this->TreplicaModel->GetByPedido($processo->PedidoId);
		$treplicaDocs = $this->TreplicaModel->GetByPedido($processo->PedidoId);

		$solucoes = $this->ProcessoModel->GetSolucoesProcesso($processo->Id);

		$arbitro = $this->getArbitro();
		$podeEnviarSolucao = !$this->ProcessoModel->jaEnviouSolucao($arbitro->Id, $id);
		$podeVotar = false;
		if($podeEnviarSolucao){
			$voto = $this->ProcessoModel->GetVotoByArbitro($id, $this->idPessoaLogado);
			$podeVotar = !$voto ? true : false;
		}
		
		$dadosView = array(
			'Processo' => $processo,

			'Razoes' => $razoes[0],
			'RazoesProvas' => $razoesProvas,

			'Contestacao' => $contestacao ? $contestacao[0] : null,
			'ContestacaoDocs' => $contestacaoDocs ? $contestacaoDocs : null,

			'Replica' => $replica ? $replica[0] : null,
			'ReplicaDocs' => $replicaDocs ? $replicaDocs : null,

			'Treplica' => $treplica ? $treplica[0] : null,
			'TreplicaDocs' => $treplicaDocs ? $treplicaDocs : null,

			'Solucoes' => $solucoes,
			'UrlVotacao' => base_url().'monitor/Processo/RegistrarVoto',

			'PodeManifestar' => $podeEnviarSolucao && $podeVotar
		);

		$this->setDadosView($dadosView);

		$customStyles = "<link href='".base_url()."assets/css/w3.css' rel='stylesheet'>";
		$customStyles .= "<link href='".base_url()."assets/css/lista-processos.css' rel='stylesheet'>";
		$this->setCustomStyle($customStyles);

		$customScripts = "<script src='".base_url()."assets/js/monitor/verProcesso.js' type='text/javascript'></script>";
		$customScripts .= "<script src='".base_url()."assets/js/addSentenca.js' type='text/javascript'></script>";
		$this->setCustomScript($customScripts);
		$this->render('monitor/Processos/verProcesso');
	}

	public function verPedido($id){
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

		$dadosView = array(
			"Title" => "Acompanhamento de Pedido",
			"Subtitle" => "Meio de Comunicação",
			"Pedido" => $pedido[0],
			"Documentos" => $documentos,
			"Provas" => $provas,
			"Analise" => $analise[0],
			"Autor" => $autor[0],
			"Reu" => $reu[0]
		);
		
		$this->setDadosView($dadosView);
		$customScript = '<script src="'.base_url().'assets/js/monitor/pedido_view.js"></script>';
		$this->setCustomScript($customScript);
		$this->render('monitor/pedido_view');
	}

	public function manifestacaoReu(){
		switch ($this->input->post('ManifestacaoTipo')) {
			case 'Rejeicao':
				$this->rejeitarPedido();
				break;
			case 'Aceito':
				$this->aceitarPedido();
				break;
			case 'Prorrogar':
				$this->prorrogarDecisao();
				break;
		}
		
		$this->notificarAdministrador($this->input->post('PedidoId'));

		$this->render('monitor/manifestacao_reu');
	}

	private function rejeitarPedido(){
		$dataConclusao = date('Y-m-d H:i:s');
		$dataUpdate = array(
			"Id" => $this->input->post('AnaliseId'),
			"DataConclusao" => $dataConclusao,
			"Status" => ANALISEPEDIDO_REJEITADO,
			"ManifestacaoReu" => $this->input->post('Observacao')
		);
		$this->load->model('PedidoAberturaModel');
		$this->PedidoAberturaModel->Update_Analise($dataUpdate);

		$papNaoAceito = array(
			'Id' => $this->input->post('AnaliseId'),
			'Aceito' => 1
		);
		$this->PedidoAberturaModel->SaveCodigoAceite($papNaoAceito);
	}

	private function aceitarPedido(){
		$dataUpdate = array(
			"Id" => $this->input->post('AnaliseId'),
			"Status" => ANALISEPEDIDO_PAP_ACEITO,
			"ManifestacaoReu" => $this->input->post('Observacao')
		);
		$this->load->model('PedidoAberturaModel');
		$this->PedidoAberturaModel->Update_Analise($dataUpdate);

		$papAceito = array(
			'Id' => $this->input->post('AnaliseId'),
			'Aceito' => 1
		);
		$this->PedidoAberturaModel->SaveCodigoAceite($papAceito);
	}

	private function prorrogarDecisao(){
		$dataUpdate = array(
			"Id" => $this->input->post('AnaliseId'),
			"Status" => ANALISEPEDIDO_REU_INDECISO,
			"ManifestacaoReu" => $this->input->post('Observacao')
		);
		$this->load->model('PedidoAberturaModel');
		$this->PedidoAberturaModel->Update_Analise($dataUpdate);
	}

	private function notificarAdministrador($pedidoId){
		$this->load->model('PedidoAberturaModel');
		$this->load->model('PessoaModel');

		$pedido = $this->PedidoAberturaModel->GetById($pedidoId);
		$autor = $this->PessoaModel->GetById($pedido[0]['PessoaId']);
		$reu = $this->PessoaModel->GetById($pedido[0]['ReuId'])[0];

		//Inicia o processo de configuração para o envio do email
		$config = Array(
			'useragent' => SMTP_AGENT,
			'protocol'  => SMTP_PROTOCOL,
			'smtp_host' => SMTP_HOST,
			'smtp_port' => SMTP_PORT,
			'smtp_user' => SMTP_USER,
			'smtp_pass' => SMTP_PASS,
			'mailtype'  => SMTP_MAILTYPE, 
			'charset'   => SMTP_CHARSET
		);

      			// Inicializa a library Email, passando os parâmetros de configuração
		$this->email->initialize($config);

      			// Define remetente e destinatário
		$this->email->from(SMTP_FROM, SMTP_FROM_NAME);

      			// Destinatário
		$this->email->to($this->input->post('Destinatario'));

      			// Define o assunto do email
		$this->email->subject("Justica Ja - Notificacao");

		$corpoMensagem = <<<HEREDOC
		<p>Olá,</p>
		<p>O Sr(a). {$reu['Nome']}, que figura como réu no PAP $pedidoId, acaba de se manifestar a respeito desse pedido.</p>
		<p>Acesse o Painel Administrativo do Justiça Já para ver o que ele decidiu.</p>
HEREDOC;

		$this->email->message($corpoMensagem);

		$this->email->send();
	}
}
