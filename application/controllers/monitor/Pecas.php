<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pecas extends Parte_Controller 
{

	public function contestacoesPendentes(){
		$this->load->model('ContestacaoModel');

		$constestacoesPendentes = $this->ContestacaoModel->getContestacoesPendentes($this->PessoaModel->GetDataUser('PessoaId'));

		$dadosView = array(
			'Titulo' => 'Contestações Pendentes',
			'Tipo' => 'contestacao',
			'ContestacoesPendentes' => $constestacoesPendentes
		);
		$this->setDadosView($dadosView);

		$this->render('monitor/contestacoesPendentes_view');
	}

	public function replicasPendentes(){
		$this->load->model('ReplicaModel');

		$constestacoesPendentes = $this->ReplicaModel->getReplicasPendentes($this->PessoaModel->GetDataUser('PessoaId'));

		$dadosView = array(
			'Titulo' => 'Réplicas Pendentes',
			'Tipo' => 'replica',
			'ContestacoesPendentes' => $constestacoesPendentes
		);
		$this->setDadosView($dadosView);

		$this->render('monitor/contestacoesPendentes_view');
	}

	public function treplicasPendentes(){
		$this->load->model('TreplicaModel');

		$constestacoesPendentes = $this->TreplicaModel->getTreplicasPendentes($this->PessoaModel->GetDataUser('PessoaId'));

		$dadosView = array(
			'Titulo' => 'Tréplicas Pendentes',
			'Tipo' => 'treplica',
			'ContestacoesPendentes' => $constestacoesPendentes
		);
		$this->setDadosView($dadosView);

		$this->render('monitor/contestacoesPendentes_view');
	}

	// CADASTRA CONTESTAÇÃO
	function contestacaoCreate($id){
		$this->load->model('PessoaModel');
		$this->load->model('PedidoAberturaModel');
		$this->load->model('ContestacaoModel');

		$pedido = $this->PedidoAberturaModel->GetById($id);

		if(!$pedido
			|| $this->PessoaModel->GetDataUser('PessoaId') != $pedido[0]['ReuId']){
			redirect(base_url());
		}

		$autor = $this->PessoaModel->GetById($pedido[0]['PessoaId']);
		$reu = $this->PessoaModel->GetById($pedido[0]['ReuId']);
		$contestacao = $this->ContestacaoModel->GetByPedido($id);

		$dadosView = array(
			"Autor" => $autor[0],
			"Reu" => $reu[0],
			"Pedido" => $pedido[0],
			"Contestacao" => $contestacao !== null ? $contestacao : null
		);
		$this->setDadosView($dadosView);

		$customStyles = '<link href="'.base_url().'assets/css/summernote.css" rel="stylesheet">';
		$customStyles .= '<link href="'.base_url().'assets/vendor/bootstrap-fileinput/css/fileinput.min.css" rel="stylesheet">';

		$customScripts = '<script src="'.base_url().'assets/vendor/summernote/summernote.js" type="text/javascript"></script>';
		$customScripts .= '<script src="'.base_url().'assets/vendor/summernote/lang/summernote-pt-BR.js" type="text/javascript"></script>';

		$customScripts = '<script src="'.base_url().'assets/vendor/bootstrap-fileinput/js/fileinput.min.js" type="text/javascript"></script>';
		$customScripts .= '<script src="'.base_url().'assets/vendor/bootstrap-fileinput/js/locales/pt-BR.js" type="text/javascript"></script>';

		$customScripts .= '<script src="'.base_url().'assets/js/contestacao.js" type="text/javascript"></script>';

		$this->setCustomStyle($customStyles);
		$this->setCustomScript($customScripts);

		$this->render('monitor/contestacaoCreate');
	}


	function ContestacaoConfirm(){
		$file = isset($_FILES['Contestacao']) ? $_FILES['Contestacao'] : null;
		$codigoPedido = $this->input->post('PedidoId');
		$codigoReu = $this->input->post('ReuId');

		$this->load->model('ContestacaoModel');

		$codigoContestacao = isset($_POST['ContestacaoId']) ? $_POST['ContestacaoId'] : null;

		if($codigoContestacao == null){
			$dataInsert = array(
				"PedidoId" => $codigoPedido,
				"PessoaId" => $codigoReu,
				"DataCadastro" => date('Y-m-d H:i:s')
			);

			$codigoContestacao = $this->ContestacaoModel->Insert_Contestacao($dataInsert);
		}


		$this->ContestacaoModel->atualizar($this->input->post('ContestacaoDigitada'), $codigoContestacao);

		if ($_FILES['Contestacao']['name'] !== "") {
			$documento = uploadFile('Contestacao','processos');
			$dataInsert = array(
				"ContestacaoId" => $codigoContestacao,
				"TipoDocumento" => $this->input->post('TipoDocumento'),
				"Arquivo" => $documento,
				"Observacao" => $this->input->post('Descricao')
			);

			$codContestacaoDoc = $this->ContestacaoModel->Insert_ContestacaoDoc($dataInsert);
		}

		redirect('monitor/Pecas/contestacaoCreate/'.$codigoContestacao);
	}

	// CADASTRA REPLICA
	function replicaCreate($id){
		$this->load->model('PessoaModel');
		$this->load->model('PedidoAberturaModel');
		$this->load->model('ReplicaModel');
		$this->load->model('ContestacaoModel');

		$pedido = $this->PedidoAberturaModel->GetById($id);
		$autor = $this->PessoaModel->GetById($pedido[0]['PessoaId']);
		$reu = $this->PessoaModel->GetById($pedido[0]['ReuId']);
		$replica = $this->ReplicaModel->GetByPedido($id);

		$contestacao = $this->ContestacaoModel->GetByPedido($id);
		$contestacaoDocs = null;
		if(!is_null($contestacao)){
			$contestacaoDocs = $this->ContestacaoModel->getDocsByContestacaoId(
				$contestacao[0]['Id']
			);
		}
		

		$dadosView = array(
			"Autor" => $autor[0],
			"Reu" => $reu[0],
			"Pedido" => $pedido[0],
			"Replica" => !is_null($replica) ? $replica : null,
			"ContestacaoDocs" => $contestacaoDocs,
			"Contestacao" => !is_null($contestacao) ? $contestacao[0] : null
		);
		$this->setDadosView($dadosView);

		$customStyles = '<link href="'.base_url().'assets/css/summernote.css" rel="stylesheet">';
		$customStyles .= '<link href="'.base_url().'assets/vendor/bootstrap-fileinput/css/fileinput.min.css" rel="stylesheet">';

		$customScripts = '<script src="'.base_url().'assets/vendor/summernote/summernote.js" type="text/javascript"></script>';
		$customScripts .= '<script src="'.base_url().'assets/vendor/summernote/lang/summernote-pt-BR.js" type="text/javascript"></script>';

		$customScripts = '<script src="'.base_url().'assets/vendor/bootstrap-fileinput/js/fileinput.min.js" type="text/javascript"></script>';
		$customScripts .= '<script src="'.base_url().'assets/vendor/bootstrap-fileinput/js/locales/pt-BR.js" type="text/javascript"></script>';

		$customScripts .= '<script src="'.base_url().'assets/js/contestacao.js" type="text/javascript"></script>';

		$this->setCustomStyle($customStyles);
		$this->setCustomScript($customScripts);

		$this->render('monitor/replicaCreate');
	}

	function ReplicaConfirm(){
		$file = isset($_FILES['Contestacao']) ? $_FILES['Contestacao'] : null;
		$codigoPedido = $this->input->post('PedidoId');
		$codigoAutor = $this->input->post('AutorId');

		$uploaddir = FCPATH."assets/uploads/processos/";

		$this->load->model('ReplicaModel');

		$codigoReplica = isset($_POST['ReplicaId']) ? $_POST['ReplicaId'] : null;
		if($codigoReplica == null){
			$dataInsert = array(
				"PedidoId" => $codigoPedido,
				"AutorId" => $codigoAutor,
				"DataCadastro" => date('Y-m-d H:i:s')
			);

			$codigoReplica = $this->ReplicaModel->Insert_Replica($dataInsert);
		}

		$this->ReplicaModel->atualizar($this->input->post('ReplicaDigitada'), $codigoReplica);

		if ($_FILES['Contestacao']['name'] !== "") {
			$documento = uploadFile('Contestacao','processos');
			$dataInsert = array(
				"ReplicaId" => $codigoReplica,
				"TipoDocumento" => $this->input->post('TipoDocumento'),
				"Arquivo" => $documento,
				"Observacao" => $this->input->post('Descricao')
			);

			$codContestacaoDoc = $this->ReplicaModel->Insert_ReplicaDoc($dataInsert);
		}

		redirect('monitor/Pecas/replicaCreate/'.$codigoPedido);
	}


	// CADASTRA TREPLICA
	function treplicaCreate($id){
		$this->load->model('PessoaModel');
		$this->load->model('PedidoAberturaModel');
		$this->load->model('ReplicaModel');
		$this->load->model('TreplicaModel');
		$this->load->model('ContestacaoModel');

		$pedido = $this->PedidoAberturaModel->GetById($id);
		$autor = $this->PessoaModel->GetById($pedido[0]['PessoaId']);
		$reu = $this->PessoaModel->GetById($pedido[0]['ReuId']);
		$replica = $this->ReplicaModel->GetByPedido($id);
		$treplica = $this->TreplicaModel->GetByPedido($id);

		$contestacao = $this->ContestacaoModel->GetByPedido($id);
		$contestacaoDocs = null;
		if(!is_null($contestacao)){
			$contestacaoDocs = $this->ContestacaoModel->getDocsByContestacaoId(
				$contestacao[0]['Id']
			);
		}

		$dadosView = array(
			"Autor" => $autor[0],
			"Reu" => $reu[0],
			"Pedido" => $pedido[0],
			"Replica" => !is_null($replica) ? $replica : null,
			"Treplica" => !is_null($treplica) ? $treplica : null,
			"ContestacaoDocs" => $contestacaoDocs,
			"Contestacao" => !is_null($contestacao) ? $contestacao[0] : null
		);
		$this->setDadosView($dadosView);

		$customStyles = '<link href="'.base_url().'assets/css/summernote.css" rel="stylesheet">';
		$customStyles .= '<link href="'.base_url().'assets/vendor/bootstrap-fileinput/css/fileinput.min.css" rel="stylesheet">';

		$customScripts = '<script src="'.base_url().'assets/vendor/summernote/summernote.js" type="text/javascript"></script>';
		$customScripts .= '<script src="'.base_url().'assets/vendor/summernote/lang/summernote-pt-BR.js" type="text/javascript"></script>';

		$customScripts = '<script src="'.base_url().'assets/vendor/bootstrap-fileinput/js/fileinput.min.js" type="text/javascript"></script>';
		$customScripts .= '<script src="'.base_url().'assets/vendor/bootstrap-fileinput/js/locales/pt-BR.js" type="text/javascript"></script>';

		$customScripts .= '<script src="'.base_url().'assets/js/contestacao.js" type="text/javascript"></script>';

		$this->setCustomStyle($customStyles);
		$this->setCustomScript($customScripts);

		$this->render('monitor/treplicaCreate');
	}

	function treplicaConfirm(){
		$file = isset($_FILES['Contestacao']) ? $_FILES['Contestacao'] : null;
		$codigoPedido = $this->input->post('PedidoId');
		$codigoReu = $this->input->post('ReuId');

		$uploaddir = FCPATH."assets/uploads/processos/";

		$this->load->model('TreplicaModel');

		$codigoTreplica = isset($_POST['TreplicaId']) ? $_POST['TreplicaId'] : null;
		if($codigoTreplica == null){
			$dataInsert = array(
				"PedidoId" => $codigoPedido,
				"ReuId" => $codigoReu,
				"DataCadastro" => date('Y-m-d H:i:s')
			);

			$codigoTreplica = $this->TreplicaModel->Insert_Treplica($dataInsert);
		}

		$this->TreplicaModel->atualizar($this->input->post('ContestacaoDigitada'), $codigoTreplica);

		if ($_FILES['Contestacao']['name'] !== "") {
			$documento = uploadFile('Contestacao','processos');
			$dataInsert = array(
				"TreplicaId" => $codigoTreplica,
				"TipoDocumento" => $this->input->post('TipoDocumento'),
				"Arquivo" => $documento,
				"Observacao" => $this->input->post('Descricao')
			);

			$codContestacaoDoc = $this->TreplicaModel->Insert_TreplicaDoc($dataInsert);
		}

		redirect('monitor/Pecas/treplicaCreate/'.$codigoPedido);
	}

	function viewPeca(){
		if(empty($this->input->get('idPedido')) || empty($this->input->get('tipo'))){
			echo "";
			return;
		}
		$idPedido = $this->input->get('idPedido'); 
		$tipo = $this->input->get('tipo');

		switch($tipo){
			case "contestacao":
				return $this->getContestacao($idPedido);
			case "replica":
				return $this->getReplica($idPedido);
		}
	}

	private function getContestacao($idPedido){
		$this->load->model('ContestacaoModel');
		$contestacao = $this->ContestacaoModel->GetByPedido($idPedido);
		$contestacaoDocs = array();
		if(!is_null($contestacao)){
			$contestacaoDocs = $this->ContestacaoModel->getDocsByContestacaoId(
				$contestacao[0]['Id']
			);
		}
		$data['Contestacao'] = $contestacao[0];
		$data['ContestacaoDocs'] = $contestacaoDocs;
		$data['Titulo'] = "Contestação";
		$view = $this->load->view('monitor/contestacaoView', $data, true);
		echo $view;
	}

	private function getReplica($idPedido){
		$this->load->model('ReplicaModel');
		$contestacao = $this->ReplicaModel->GetByPedido($idPedido);
		$contestacaoDocs = null;
		if(!is_null($contestacao)){
			$contestacaoDocs = $this->ReplicaModel->getDocsByPedido($idPedido);
		}
		$data['Contestacao'] = $contestacao[0];
		$data['ContestacaoDocs'] = $contestacaoDocs;
		$data['Titulo'] = "Réplica";
		$view = $this->load->view('monitor/contestacaoView', $data, true);
		echo $view;
	}
}