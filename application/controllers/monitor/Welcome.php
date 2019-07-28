<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends Parte_Controller {
	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->Model('PessoaModel');
		if($this->PessoaModel->GetDataUser('UsuarioAutenticado')){
			$papsEnvolvidos = $this->getPapsSemManifestacao();
			$dadosView = array(
				'Visitante' => $this->PessoaModel->GetDataUser('Nome'),
				'PedidosSouReu' => $papsEnvolvidos['PedidosSouReu'],
				'MeusPedidos' => $papsEnvolvidos['PedidosSouAutor'],
				'PedidosSouPromotor' => $papsEnvolvidos['PedidosSouPromotor']
			);
			//print_r(json_encode($dadosView)); die;
	
			$this->setDadosView($dadosView);
			$this->render('monitor/welcome_message');
			return;
		}
		$hashTag = empty($this->input->get('hashTag')) ? '' : $this->input->get('hashTag');
		if(empty($hashTag)){
			$this->render('monitor/welcome_message');
			return;
		}
		$this->load->model('PedidoAberturaModel');
		$pedido = $this->PedidoAberturaModel->GetByCodigoAceite($hashTag);
		if(empty($pedido)){
			$this->render('monitor/welcome_message');
			return;
		}
		$idPedido = $pedido[0]['Id'];
		$idReu = $pedido[0]['ReuId'];

		$dadosView = array(
			'IdPedido' => $idPedido, 
			'IdReu' => $idReu
		);

		$this->setDadosView($dadosView);
		$this->render('monitor/welcome_message');
		
	}

	private function getPapsSemManifestacao(){
		$this->load->model('PessoaModel');
		$this->load->model('PedidoAberturaModel');
		$idPessoaLogado = $this->PessoaModel->GetDataUser('PessoaId');

		$papsReu = $this->PedidoAberturaModel->getByReuId($idPessoaLogado);
		$papsAutor = $this->PedidoAberturaModel->getByAutorId($idPessoaLogado);
		$papsPromotor = $this->PedidoAberturaModel->getByPromotorId($idPessoaLogado);

		return array(
			'PedidosSouReu' => $papsReu,
			'PedidosSouAutor' => $papsAutor,
			'PedidosSouPromotor' => $papsPromotor,
		);
	}

	public function login(){
		if(!$this->input->post()){
			$this->setMessageUser("Digite seu e-mail e senha.");
			redirect(base_url().'monitor');
		}

		$this->load->model('PessoaModel');

		$loginInfo = array('Username' => $this->input->post('username'),
			'Password' => $this->input->post('password'));

		if(!$this->PessoaModel->AutenticarVisitante($loginInfo)){
			//setInformacaoTela("Login ou senha inválidos.");
			redirect(base_url().'monitor');
		}

		$client = $this->PessoaModel->GetByLogin($loginInfo['Username']);
		$userData = array(
			'Nome' => $client[0]['Nome'],
			'PessoaId' => $client[0]['PessoaId'],
			//'ArbitroId' => $client[0]['ArbitroId'],
			'CpfCnpj' => $client[0]['CpfCnpj'],
			'UsuarioAutenticado' => true,
    		'TipoUsuario' => $client[0]['UserType']
		);
		$this->PessoaModel->SetDataUser($userData);
		  
		if(!empty($this->input->post('IdPedido')) && !empty($this->input->post('IdReu'))){
			$this->load->model('PedidoAberturaModel');
			$this->PedidoAberturaModel->atualizarReuPedido($this->input->post('IdPedido'), 
			$client[0]['PessoaId']);
			
			$this->PessoaModel->excluirPessoa($this->input->post('IdReu'));
		}

    	redirect(base_url()."monitor/Processos");
	}
}
